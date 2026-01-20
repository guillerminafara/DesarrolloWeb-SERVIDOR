# Ejercicio de autenticación con roles, sesiones y tokens – Guía para el examen

Autor: **Álvaro Verdeguer**  
Asignatura: **PHP – Formularios, Sesiones y POO**

Esta guía NO es solo documentación: está pensada para que **tú mismo entiendas el flujo de datos** y puedas **reconstruir el ejercicio en el examen** aunque no lo tengas delante.

La idea:  
> “Usuario rellena formulario → servidor valida → guarda cosas en sesión → según el rol, le enseña unos datos u otros → protege todo con tokens”.

---

## 1. ¿Qué pasa desde que pulso “Enviar”? – Flujo general

1. El usuario abre `index.php` (formulario).
   - Se inicia la sesión.
   - Se genera un **token** y se guarda en `$_SESSION['token']`.
   - Ese token se mete como campo oculto en el formulario.

2. El usuario rellena:
   - `nombre`
   - `perfil` (Gerente / Sindicalista / Responsable de Nóminas)
   - `password`
   - y pulsa **Validar** o **Enviar** o **Eliminar**.

3. `index.php` recibe los datos por `POST` y:
   - Lee `$_POST['nombre']`, `$_POST['perfil']`, `$_POST['password']`, `$_POST['token']`, `$_POST['accion']`.
   - Primero **comprueba el token** con la función `tokenEsValido()`.
   - Luego llama a `validarFormularioLogin()` para comprobar nombre, perfil y contraseña.

4. Si hay errores:
   - Se guardan en un array `$errores`.
   - Se vuelven a pintar en HTML en rojo.
   - Los campos (salvo la contraseña) se vuelven a mostrar con lo que el usuario había puesto.

5. Si el usuario pulsa **Validar** y no hay errores:
   - No se hace login todavía.
   - Solo se muestra un mensaje “Formulario validado correctamente. Puedes enviarlo”.

6. Si pulsa **Enviar** y no hay errores:
   - Se guardan en la sesión los datos del formulario en `$_SESSION['post_temp']`.
   - Se hace `header('Location: process.php');` para ir a `process.php`.

7. En `process.php`:
   - Se recupera `$_SESSION['post_temp']` (nombre, perfil, password, token).
   - Se vuelve a comprobar el **token**.
   - Si el token es correcto, se comprueba el usuario con `autenticarUsuario()` usando `password_verify`.
   - Si todo va bien:
     - Se guarda el usuario en la sesión (`usuario_nombre`, `usuario_perfil`).
     - Se redirige según el perfil a `gerente.php`, `sindicalista.php` o `nominas.php`.

8. En cada página de rol:
   - Se comprueba que haya sesión y que el perfil coincida.
   - Se usan las funciones de la clase `Trabajador` para sacar salarios.
   - Hay un botón **Cambiar SID** (regenera sesión y token) y un enlace **Cerrar sesión** protegido con token.

9. En `logout.php`:
   - Se recibe un `token` por la URL.
   - Se comprueba que coincide con el guardado en sesión.
   - Si es correcto, se limpia la sesión y se vuelve al formulario.

---

## 2. Sesiones: qué son y cómo las usas aquí

### ¿Qué es una sesión?

Una **sesión** es una forma de que PHP recuerde datos de un usuario entre peticiones.  
Se identifica normalmente con una cookie `PHPSESSID`.

En todos los archivos que usan `$_SESSION` hacemos:

```php
session_start();
```

Eso:
- Crea la sesión si no existía.
- Recupera los datos de esa sesión si ya existía.

### ¿Qué cosas guardas en la sesión en este ejercicio?

1. **Token de formulario**:
   ```php
   $_SESSION['token'] = $token;
   ```

2. **Usuario autenticado**:
   ```php
   $_SESSION['usuario_nombre'] = $nombre;
   $_SESSION['usuario_perfil'] = $perfil;
   ```

3. **Datos temporales del formulario** (para pasarlos de `index.php` a `process.php`):
   ```php
   $_SESSION['post_temp'] = [
       'nombre'   => $nombre,
       'perfil'   => $perfil,
       'password' => $password,
       'token'    => $tokenPost,
   ];
   ```

### Funciones que manipulan la sesión

En `funciones.php` tienes funciones que **envuelven** el uso de `$_SESSION` para que el código quede limpio:

```php
function guardarSesionUsuario(string $nombre, string $perfil): void {
    $_SESSION['usuario_nombre'] = $nombre;
    $_SESSION['usuario_perfil'] = $perfil;
}

function limpiarSesionUsuario(): void {
    unset($_SESSION['usuario_nombre'], $_SESSION['usuario_perfil']);
}

function usuarioEstaLogueado(): bool {
    return isset($_SESSION['usuario_nombre'], $_SESSION['usuario_perfil']);
}
```

**Idea clave para el examen:**

> “Si quiero saber si un usuario está logueado y qué rol tiene, no miro el `POST`, miro la **sesión** (`$_SESSION['usuario_nombre']` y `$_SESSION['usuario_perfil']`).”

---

## 3. Token de formulario: para qué sirve y cómo lo usas

### ¿Qué es un token de formulario?

Es una cadena única que:
- El servidor genera y guarda en la sesión.
- Envía al cliente en un campo oculto.
- Al enviar el formulario, el servidor compara el token que viene en `POST` con el que hay en `$_SESSION`.

Sirve para evitar ataques **CSRF** (que otra página te envíe un formulario en tu nombre).

### Cómo lo generas

Función en `funciones.php`:

```php
function generarTokenFormulario(): string {
    // Versión simple sin openssl
    $token = bin2hex(random_bytes(24));
    $_SESSION['token'] = $token;
    return $token;
}
```

En `index.php`:

```php
if (!isset($_SESSION['token'])) {
    generarTokenFormulario();
}
$token = $_SESSION['token'];
```

Se envía en el formulario como campo oculto:

```php
<input type="hidden" name="token"
       value="<?php echo htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>">
```

### Cómo lo compruebas

Función:

```php
function tokenEsValido(string $tokenRecibido): bool {
    if (!isset($_SESSION['token'])) {
        return false;
    }
    return hash_equals($_SESSION['token'], $tokenRecibido);
}
```

En `index.php` y `process.php` haces:

```php
if (!isset($_POST['token'])) {
    $errores[] = "No se ha encontrado token en el formulario.";
} elseif (!tokenEsValido($tokenPost)) {
    $errores[] = "El token no coincide. Posible ataque CSRF o SID cambiada.";
}
```

### Token también en el logout

En cada página de rol, el enlace de cierre de sesión incluye el token:

```php
<a href="logout.php?token=<?php echo htmlspecialchars($_SESSION['token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
    Cerrar sesión
</a>
```

Y en `logout.php`:

```php
if (!isset($_GET['token'])) {
    print('No se ha encontrado token en la URL de logout');
    exit;
}

if (!tokenEsValido($_GET['token'])) {
    print('El token no coincide en logout!');
    exit;
}

// Token correcto → limpiar usuario y “cerrar sesión”
limpiarSesionUsuario();
```

**Frase para el examen:**

> “El token se guarda en la sesión y se mete en un campo oculto del formulario. Cuando proceso el formulario, comparo el token de `$_POST` con el de `$_SESSION`. Si no coinciden, paro el proceso.”

---

## 4. Validar un perfil, un nombre y una contraseña

En `funciones.php` preparaste **funciones pequeñas** y luego una función grande de validación.

### Funciones pequeñas

```php
function esVacio(string $valor): bool {
    return trim($valor) === '';
}

function tieneLongitudMinima(string $valor, int $min): bool {
    return strlen($valor) >= $min;
}

function esSoloLetras(string $valor): bool {
    return (bool) preg_match('/^[a-zA-Z\s]+$/', $valor);
}

function esAlfanumerico(string $valor): bool {
    return (bool) preg_match('/^[a-zA-Z0-9]+$/', $valor);
}

function perfilEsValido(string $perfil): bool {
    $perfilesValidos = ['Gerente', 'Sindicalista', 'Responsable de Nóminas'];
    return in_array($perfil, $perfilesValidos, true);
}
```

### Validación del **nombre de usuario**

Requisitos:
- No vacío.
- Solo letras (no números).

```php
function validarNombreUsuario(string $nombre): array {
    $errores = [];

    if (esVacio($nombre)) {
        $errores[] = "El nombre de usuario es obligatorio.";
        return $errores;
    }

    if (!esSoloLetras($nombre)) {
        $errores[] = "El nombre de usuario debe contener solo letras (sin números).";
    }

    return $errores;
}
```

### Validación del **perfil**

Requisitos:
- Obligatorio.
- Debe ser uno de los roles permitidos.

```php
function validarPerfil(string $perfil): array {
    $errores = [];

    if (esVacio($perfil)) {
        $errores[] = "Debes seleccionar un perfil.";
        return $errores;
    }

    if (!perfilEsValido($perfil)) {
        $errores[] = "El perfil seleccionado no es válido.";
    }

    return $errores;
}
```

### Validación de la **contraseña**

Requisitos:
- No vacía.
- Mínimo 6 caracteres.
- Alfanumérica (solo letras y números).

```php
function validarPasswordCampo(string $password): array {
    $errores = [];

    if (esVacio($password)) {
        $errores[] = "La contraseña es obligatoria.";
        return $errores;
    }

    if (!tieneLongitudMinima($password, 6)) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (!esAlfanumerico($password)) {
        $errores[] = "La contraseña debe ser alfanumérica (solo letras y números, sin símbolos).";
    }

    return $errores;
}
```

### Validación completa del formulario

```php
function validarFormularioLogin(string $nombre, string $perfil, string $password): array {
    $errores = [];

    $errores = array_merge($errores, validarNombreUsuario($nombre));
    $errores = array_merge($errores, validarPerfil($perfil));
    $errores = array_merge($errores, validarPasswordCampo($password));

    return $errores;
}
```

**Idea clave:**

> “Si quiero comprobar correctamente el formulario, llamo a `validarFormularioLogin`, que a su vez llama a validaciones más pequeñas por campo.”

---

## 5. Roles: cómo se guardan y cómo decides a qué página ir

### Qué es un rol aquí

Es simplemente el valor de `perfil`:

- `"Gerente"`
- `"Sindicalista"`
- `"Responsable de Nóminas"`

Define qué página verá el usuario y qué salarios se le mostrarán.

### Dónde se guarda el rol

Después de que `process.php` verifique token y contraseña:

```php
guardarSesionUsuario($nombre, $perfil);
```

Esta función:

```php
function guardarSesionUsuario(string $nombre, string $perfil): void {
    $_SESSION['usuario_nombre'] = $nombre;
    $_SESSION['usuario_perfil'] = $perfil;
}
```

### Cómo decides a qué página redirigir

```php
function redirigirPorPerfil(string $perfil): void {
    switch ($perfil) {
        case 'Gerente':
            header('Location: gerente.php');
            break;
        case 'Sindicalista':
            header('Location: sindicalista.php');
            break;
        case 'Responsable de Nóminas':
            header('Location: nominas.php');
            break;
        default:
            header('Location: index.php');
    }
    exit;
}
```

En `process.php`:

```php
if (!autenticarUsuario($nombre, $perfil, $password)) {
    // error...
} else {
    guardarSesionUsuario($nombre, $perfil);
    redirigirPorPerfil($perfil);
}
```

### Cómo compruebas el rol en la página correcta

Ejemplo en `gerente.php`:

```php
if (!usuarioEstaLogueado() || $_SESSION['usuario_perfil'] !== 'Gerente') {
    header('Location: index.php');
    exit;
}
```

Ejemplo en `nominas.php`:

```php
if (!usuarioEstaLogueado() || $_SESSION['usuario_perfil'] !== 'Responsable de Nóminas') {
    header('Location: index.php');
    exit;
}
```

**Frase para examen:**

> “Primero autentico al usuario y guardo su perfil en la sesión. Luego, según el perfil, lo mando a una página u otra, y en cada página vuelvo a comprobar que el perfil de la sesión coincide con el que toca.”

---

## 6. Contraseñas: por qué están y cómo se comprueban

### Usuarios simulados con `password_hash`

En `funciones.php`:

```php
function obtenerUsuariosSimulados(): array {
    return [
        [
            'nombre'        => 'gerente',
            'perfil'        => 'Gerente',
            'password_hash' => password_hash('clavegerente', PASSWORD_DEFAULT),
        ],
        [
            'nombre'        => 'sindical',
            'perfil'        => 'Sindicalista',
            'password_hash' => password_hash('clavesindical', PASSWORD_DEFAULT),
        ],
        [
            'nombre'        => 'nominas',
            'perfil'        => 'Responsable de Nóminas',
            'password_hash' => password_hash('clavenominas', PASSWORD_DEFAULT),
        ],
    ];
}
```

Esto simula una “base de datos” en un array.

### Autenticación con `password_verify`

```php
function autenticarUsuario(string $nombre, string $perfil, string $password): bool {
    $usuarios = obtenerUsuariosSimulados();

    foreach ($usuarios as $user) {
        if (
            $user['nombre'] === $nombre &&
            $user['perfil'] === $perfil &&
            password_verify($password, $user['password_hash'])
        ) {
            return true;
        }
    }
    return false;
}
```

En `process.php`:

```php
if (!autenticarUsuario($nombre, $perfil, $password)) {
    $errores[] = 'Nombre, perfil o contraseña incorrectos.';
} else {
    guardarSesionUsuario($nombre, $perfil);
    redirigirPorPerfil($perfil);
}
```

**Mensaje clave:**

> “Las contraseñas están aquí para demostrar que uso `password_hash` y `password_verify`. No guardo la contraseña en texto plano, sino su hash, y la compruebo al hacer login.”

---

## 7. Preguntas típicas que te puede hacer tu profesora (y cómo responder)

**1. ¿Qué es una sesión y para qué la usas?**

> Es un mecanismo de PHP para guardar información entre peticiones.  
> Uso `session_start()` y guardo en `$_SESSION` el nombre de usuario, su perfil (rol) y un token de formulario.  
> Gracias a la sesión sé quién está logueado y qué permisos tiene.

**2. ¿Qué es un token de formulario?**

> Es un valor único que genero en el servidor y guardo en la sesión, y además envío como campo oculto en el formulario.  
> Cuando proceso el formulario, comparo el token de `$_POST` con el de `$_SESSION`.  
> Si no coinciden, corto la ejecución y no proceso la petición para evitar ataques CSRF.

**3. ¿Cómo decides qué ve cada usuario?**

> Una vez que el usuario está autenticado, guardo su perfil en `$_SESSION['usuario_perfil']`.  
> Luego, en `process.php` lo redirijo según el perfil a `gerente.php`, `sindicalista.php` o `nominas.php`.  
> En cada una de esas páginas, vuelvo a comprobar que la sesión tenga el perfil correcto antes de mostrar datos.

**4. ¿Cómo validas el formulario?**

> Tengo funciones pequeñas (`esVacio`, `esSoloLetras`, `esAlfanumerico`, etc.) y luego funciones más grandes como `validarNombreUsuario`, `validarPasswordCampo` y `validarFormularioLogin` que las combinan.  
> Así el código es modular y puedo reutilizar las validaciones fácilmente.

**5. ¿Para qué usas `password_hash` y `password_verify`?**

> Para simular una base de datos de usuarios segura.  
> Guardo el hash de la contraseña con `password_hash` y, cuando el usuario se loguea, uso `password_verify` para comprobar que la contraseña que ha escrito coincide con el hash guardado.

---

Con este README deberías ser capaz de:

- Recordar el **flujo de datos** (formulario → sesión → process → página de rol).
- Saber **qué hace cada parte** (token, sesión, validaciones, roles).
- Explicar el ejercicio en voz alta durante el examen como si lo hubieras diseñado tú.
