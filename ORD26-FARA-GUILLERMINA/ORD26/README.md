# ORD26 — Evaluación y corrección del proyecto Planetas Star Wars

## Descripción del proyecto

Aplicación PHP MVC para gestionar planetas de Star Wars.  
Incluye autenticación por sesión, CRUD con vistas HTML y una API REST JSON.

### Estructura de archivos

```
ORD26/
├── config/
│   ├── DDL.sql              → Esquema de la base de datos
│   ├── database.php         → Conexión PDO
│   ├── validaciones.php     → Funciones de validación
│   └── users.json           → Lista de usuarios permitidos
├── app/
│   ├── models/
│   │   └── Planeta.php      → Modelo CRUD contra la BD
│   └── controllers/
│       ├── ApiController.php    → Endpoints REST (/planetas)
│       ├── AuthController.php   → Login con sesión
│       └── PlanetaController.php→ Lógica de negocio para vistas
├── public/
│   ├── index.php            → Router principal + formulario login
│   ├── router.php           → Router del servidor de desarrollo
│   └── planetas/
│       ├── listado.php      → Vista listado CRUD
│       └── detalle.php      → Vista formulario crear/editar
└── planetas.http            → Pruebas de la API REST
```

---

## Errores encontrados y código corregido

---

### 1. `config/database.php`

#### Errores

| Problema | Descripción |
|----------|-------------|
| DSN malformado | `":host=:;dbname=;charset=utf8"` — falta el driver `mysql:` y la sintaxis es inválida |
| Constantes sin definir | `USERNAME` y `PASSWORD` no están definidas en ningún lugar |
| Doble punto y coma | `PDO::ERRMODE_EXCEPTION);;` — doble `;` al final |

#### Código corregido

```php
<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'starwars');
define('DB_USER', 'root');
define('DB_PASS', '');

$pdo = new PDO(
    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
    DB_USER,
    DB_PASS
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

---

### 2. `config/validaciones.php`

#### Errores

Todas las funciones tienen el cuerpo del `if` vacío — el código no compilaría.

| Función | Problema |
|---------|---------|
| `validaRequerido` | `if( == '')` — falta la variable |
| `validaEmail` | `if( === FALSE)` — falta la llamada a `filter_var()` |
| `validaAlfabeto` | `if (===FALSE)` — falta la llamada a `preg_match()` |
| `validaAlfanum` | `if (===FALSE)` — falta la llamada a `preg_match()` |
| `validaNumero` | `if (===FALSE)` — falta la llamada a `is_numeric()` |

#### Código corregido

```php
<?php

function validaRequerido($valor) {
    if ($valor == '') {
        return false;
    } else {
        return true;
    }
}

function validaEmail($valor) {
    if (filter_var($valor, FILTER_VALIDATE_EMAIL) === false) {
        return false;
    } else {
        return true;
    }
}

// Permite letras, tildes, ñ y espacios (para nombres compuestos)
function validaAlfabeto($valor) {
    if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $valor) !== 1) {
        return false;
    } else {
        return true;
    }
}

// Permite letras, números, espacios y comas (para clima y terreno)
function validaAlfanum($valor) {
    if (preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s,]+$/', $valor) !== 1) {
        return false;
    } else {
        return true;
    }
}

function validaNumero($valor) {
    if (is_numeric($valor) === false) {
        return false;
    } else {
        return true;
    }
}
```

---

### 3. `app/models/Planeta.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 35 | `require_once __DIR__."../config/database.php"` — ruta incorrecta | `__DIR__."/../../config/database.php"` |
| 47 | `$sql =('SELECT * FROM planetas')` — paréntesis innecesarios, falta ORDER BY | `$sql = 'SELECT * FROM planetas ORDER BY nombre'` |
| 53 | `$stmt-> $pdo->execute($stmt)` — sintaxis inválida | `$stmt->execute()` |
| 57 | `$stmt->fetch(PDO::FETCH_ASSOC)()` — llamada como función inválida | `$stmt->fetchAll(PDO::FETCH_ASSOC)` |
| 68 | `$sql =('SELECT ...')` — paréntesis innecesarios | `$sql = 'SELECT * FROM planetas WHERE id = ?'` |
| 76 | `$stmt->$pdo->execute(array($id))` — sintaxis inválida | `$stmt->execute([$id])` |
| 80 | `->fetch()()` — llamada inválida | `->fetch(PDO::FETCH_ASSOC)` |
| 91 | INSERT con columnas de SWAPI que no coinciden con la tabla DDL | Ver código corregido |
| 99 | `execute(array($datos))` — `$datos` es array, no valor simple | Ver código corregido |
| 110 | `UPDATE planetas SET() WHERE id=?` — SQL inválido | Ver código corregido |
| 118 | `$stmt-> $pdo->excute(...)` — typo `excute` y sintaxis inválida | `$stmt->execute([...])` |
| 137 | `$stmt->$pdo->exec(array($id))` — `exec` no acepta parámetros | `$stmt->execute([$id])` |

#### Código corregido

```php
<?php

require_once __DIR__ . "/../../config/database.php";

class Planeta {

    public function getAll() {
        global $pdo;
        $sql  = 'SELECT * FROM planetas ORDER BY nombre';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByID($id) {
        global $pdo;
        $sql  = 'SELECT * FROM planetas WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($datos) {
        global $pdo;
        $sql  = 'INSERT INTO planetas (nombre, horasDia, diasAnyo, clima, terreno, imagen)
                 VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $datos['nombre'],
            $datos['horasDia'],
            $datos['diasAnyo'],
            $datos['clima'],
            $datos['terreno'],
            $datos['imagen'] ?? null
        ]);
    }

    public function update($id, $datos) {
        global $pdo;
        $sql  = 'UPDATE planetas
                 SET nombre=?, horasDia=?, diasAnyo=?, clima=?, terreno=?, imagen=?
                 WHERE id=?';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $datos['nombre'],
            $datos['horasDia'],
            $datos['diasAnyo'],
            $datos['clima'],
            $datos['terreno'],
            $datos['imagen'] ?? null,
            $id
        ]);
    }

    public function delete($id) {
        global $pdo;
        $sql  = 'DELETE FROM planetas WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
```

---

### 4. `app/controllers/ApiController.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 81 | `require_once __DIR__. "../../models/Planeta.php"` — ruta incorrecta | `__DIR__ . "/../../app/models/Planeta.php"` |
| 98 | `Content-Type: ext/plain` — MIME incorrecto | `Content-Type: application/json` |
| 118 | `http_response_code()` sin argumento | `http_response_code(404)` |
| 119 | `json_encode()` sin argumento | `json_encode(["error" => "Recurso no encontrado"])` |
| 129–131 | Condición vacía para detectar `importarSWAPI` | Ver código corregido |
| 140–145 | `new Planeta();. get` — sintaxis rota; el bloque GET atrapa TODO antes de llegar al GET por id | Ver código corregido |
| 176 | `new Planeta;5555` — literal numérico inválido tras la sentencia | `new Planeta()` |
| 208 | `users.son` — extensión incorrecta y ruta sin `/` | `__DIR__ . "/../../config/users.json"` |
| 212–215 | Doble `json_decode` — se decodifica primero a array y luego se intenta decodificar el array | Una sola llamada a `json_decode` |
| 219 | `if ($response)` — lógica invertida; entra cuando hay datos válidos | `if (!$data)` |
| 236–237 | `http_response_code()` y `json_encode()` sin argumentos | Ver código corregido |

#### Código corregido

```php
<?php

require_once __DIR__ . "/../../app/models/Planeta.php";

class ApiController
{
    public function handleRequest()
    {
        header("Content-Type: application/json");

        $method   = $_SERVER['REQUEST_METHOD'];
        $uri      = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $resource = $uri[0] ?? null;
        $id       = $uri[1] ?? null;

        if ($resource !== "planetas") {
            http_response_code(404);
            echo json_encode(["error" => "Recurso no encontrado"]);
            return;
        }

        // GET /planetas/importarSWAPI
        if ($method === "GET" && $id === "importarSWAPI") {
            $this->cargarDatosDesdeSWAPI();
            exit;
        }

        // GET /planetas
        if ($method === "GET" && empty($id)) {
            $planeta = new Planeta();
            echo json_encode($planeta->getAll(), JSON_PRETTY_PRINT);
            exit;
        }

        // GET /planetas/{id}
        if ($method === "GET" && !empty($id)) {
            $planeta = new Planeta();
            echo json_encode($planeta->getByID($id), JSON_PRETTY_PRINT);
            exit;
        }

        // POST /planetas
        if ($method === "POST") {
            $raw     = file_get_contents("php://input");
            $data    = json_decode($raw, true);
            $planeta = new Planeta();
            $planeta->create($data);
            http_response_code(201);
            echo json_encode(["mensaje" => "Planeta creado correctamente"]);
            exit;
        }

        // PUT /planetas/{id}
        if ($method === "PUT" && !empty($id)) {
            $raw     = file_get_contents("php://input");
            $data    = json_decode($raw, true);
            $planeta = new Planeta();
            $planeta->update($id, $data);
            echo json_encode(["mensaje" => "Planeta actualizado correctamente"]);
            exit;
        }

        // DELETE /planetas/{id}
        if ($method === "DELETE" && !empty($id)) {
            $planeta = new Planeta();
            $planeta->delete($id);
            http_response_code(204);
            exit;
        }

        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
        exit;
    }

    public function cargarDatosDesdeSWAPI()
    {
        $url      = __DIR__ . "/../../config/users.json";
        $response = file_get_contents($url);  // obtener texto
        $data     = json_decode($response, true); // una sola vez

        if (!$data) {
            http_response_code(400);
            echo json_encode(["error" => "Datos no válidos"]);
            return;
        }

        $planeta = new Planeta();
        foreach ($data as $plane) {
            $planeta->create($plane);
        }

        http_response_code(200);
        echo json_encode(["mensaje" => "Datos importados correctamente"]);
    }
}
```

---

### 5. `app/controllers/AuthController.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 71 | `if ()` — condición vacía para verificar que sea POST | `if ($_SERVER['REQUEST_METHOD'] !== 'POST')` |
| 90 | `if ($_POST)` — siempre `true` cuando hay POST; no valida campos vacíos | `if (empty($_POST['usuario']) \|\| empty($_POST['modo']))` |
| 106 | `if ()` — condición vacía para detectar modo API | `if ($modo === 'api')` |
| 108 | `$_SESSION['mensaje_api'] =` — sin valor asignado | Asignar string descriptivo |
| 115 | `file_get_contents("users.json")` — ruta relativa, falla según desde dónde se ejecute | `file_get_contents(__DIR__ . "/../../config/users.json")` |
| 117 | `$json->usuarios` — el JSON es un array directo, no tiene propiedad `usuarios` | `$usuarios = $json` |
| 123 | `$user === $usuario` — `$user` es un objeto `{id, name}`, no una cadena | `$user->name === $usuario` |
| 124 | Falta guardar el usuario validado en sesión | `$_SESSION['usuario'] = $usuario` |
| 131 | `header("Location:")` — destino vacío | `header("Location: planetas/listado.php")` |

#### Código corregido

```php
<?php

session_start();

// Verificar que la petición sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// Validar token CSRF
if (hash_equals($_POST['token'], $_SESSION['token']) === false) {
    $_SESSION['mensaje_token'] = "Error: token inválido";
    header("Location: index.php");
    exit;
}
unset($_SESSION['token']);

// Comprobar campos obligatorios
if (empty($_POST['usuario']) || empty($_POST['modo'])) {
    $_SESSION['mensaje_error'] = "Campos incompletos";
    header("Location: index.php");
    exit;
}

$usuario = $_POST["usuario"];
$modo    = $_POST["modo"];

// Modo API
if ($modo === 'api') {
    $_SESSION['mensaje_api'] = "Modo API activo: accede a /planetas para usar la API REST";
    header("Location: index.php");
    exit;
}

// Cargar usuarios desde JSON
$fichero  = file_get_contents(__DIR__ . "/../../config/users.json");
$json     = json_decode($fichero);  // array de objetos
$usuarios = $json;

foreach ($usuarios as $user) {
    if ($user->name === $usuario) {
        $_SESSION['usuario'] = $usuario;
        break;
    }
}

header("Location: planetas/listado.php");
exit;
```

---

### 6. `app/controllers/PlanetaController.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 75–79 | `require_once` sin rutas | Añadir rutas correctas |
| 84 | Falta declarar propiedad `$errores` | `private $errores = []` |
| 93–101 | `listar()` completamente vacío | Ver código corregido |
| 110–121 | `mostrar()` completamente vacío | Ver código corregido |
| 126–158 | `crear()` incompleto + **falta `}` de cierre** (error de sintaxis fatal) | Ver código corregido |
| 162–186 | `actualizar()` incompleto | Ver código corregido |
| 191–199 | `eliminar()` incompleto | Ver código corregido |
| 204–236 | `procesarImagen()` incompleto | Ver código corregido |
| 238–281 | `validarDatos()` incompleto | Ver código corregido |
| 291–325 | `cargarDatosDesdeSWAPI()` incompleto | Ver código corregido |

#### Código corregido

```php
<?php

require_once __DIR__ . "/../models/Planeta.php";
require_once __DIR__ . "/../../config/validaciones.php";

class PlanetaController
{
    private $errores = [];

    public function listar()
    {
        $planeta  = new Planeta();
        $planetas = $planeta->getAll();
        return ['planetas' => $planetas];
    }

    public function mostrar($id)
    {
        $planeta      = new Planeta();
        $datosPlaneta = $planeta->getByID($id);
        $_SESSION['planeta'] = $datosPlaneta;
        return ['planeta' => $datosPlaneta];
    }

    public function crear($datos)
    {
        $this->errores = [];
        $this->validarDatos($datos);

        if (empty($datos['imagen'])) {
            $this->errores['imagen'] = "La imagen es obligatoria al crear un planeta";
        }

        if (!empty($this->errores)) {
            return ['errores' => $this->errores];
        }

        $nombreImagen = $this->procesarImagen($datos['nombre']);
        if ($nombreImagen) {
            $datos['imagen'] = $nombreImagen;
        }

        $planeta = new Planeta();
        $planeta->create($datos);
        return ['ok' => true];
    }

    public function actualizar($id, $datos)
    {
        $this->errores = [];
        $this->validarDatos($datos);

        if (!empty($this->errores)) {
            return ['errores' => $this->errores];
        }

        $nombreImagen = $this->procesarImagen($datos['nombre']);
        if ($nombreImagen) {
            $datos['imagen'] = $nombreImagen;
        }

        $planeta = new Planeta();
        $planeta->update($id, $datos);
        return ['ok' => true];
    }

    public function eliminar($id)
    {
        $planeta = new Planeta();
        return $planeta->delete($id);
    }

    private function procesarImagen($nombrePlaneta)
    {
        if (!isset($_FILES['imagen']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $extension   = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $extensiones = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($extension, $extensiones)) {
            $this->errores['imagen'] = "Extensión no válida. Se permiten: jpg, jpeg, png, gif";
            return null;
        }

        // Nombre único: YYYYMMDD_NombrePlaneta.extensión
        $fecha   = date('Ymd');
        $nombre  = $fecha . '_' . str_replace(' ', '_', $nombrePlaneta) . '.' . $extension;
        $destino = __DIR__ . "/../../public/uploads/" . $nombre;

        move_uploaded_file($_FILES['imagen']['tmp_name'], $destino);
        return $nombre;
    }

    private function validarDatos($datos)
    {
        // Nombre: requerido y solo letras (espacios permitidos para nombres compuestos)
        if (!validaRequerido($datos['nombre'] ?? '')) {
            $this->errores['nombre'] = "El nombre es obligatorio";
        } elseif (!validaAlfabeto($datos['nombre'])) {
            $this->errores['nombre'] = "El nombre solo puede contener letras";
        }

        // Horas del día: requerido y numérico
        if (!validaRequerido($datos['horasDia'] ?? '')) {
            $this->errores['horasDia'] = "Las horas del día son obligatorias";
        } elseif (!validaNumero($datos['horasDia'])) {
            $this->errores['horasDia'] = "Las horas del día deben ser un número";
        }

        // Días del año: requerido y numérico
        if (!validaRequerido($datos['diasAnyo'] ?? '')) {
            $this->errores['diasAnyo'] = "Los días del año son obligatorios";
        } elseif (!validaNumero($datos['diasAnyo'])) {
            $this->errores['diasAnyo'] = "Los días del año deben ser un número";
        }

        // Clima: requerido y alfanumérico (puede tener espacios y comas)
        if (!validaRequerido($datos['clima'] ?? '')) {
            $this->errores['clima'] = "El clima es obligatorio";
        } elseif (!validaAlfanum($datos['clima'])) {
            $this->errores['clima'] = "El clima solo puede contener letras, números, espacios y comas";
        }

        // Terreno: requerido y alfanumérico (puede tener espacios y comas)
        if (!validaRequerido($datos['terreno'] ?? '')) {
            $this->errores['terreno'] = "El terreno es obligatorio";
        } elseif (!validaAlfanum($datos['terreno'])) {
            $this->errores['terreno'] = "El terreno solo puede contener letras, números, espacios y comas";
        }
    }

    public function cargarDatosDesdeSWAPI()
    {
        // Obtener datos desde la API pública de Star Wars
        $url      = "https://swapi.dev/api/planets/";
        $response = file_get_contents($url);
        $json     = json_decode($response, true);
        $data     = $json['results'] ?? null;

        if (!$data) {
            return false;
        }

        $planeta = new Planeta();
        foreach ($data as $p) {
            $planeta->create([
                'nombre'   => $p['name'],
                // rotation_period y orbital_period pueden venir como "unknown"
                'horasDia' => is_numeric($p['rotation_period']) ? (int)$p['rotation_period'] : 0,
                'diasAnyo' => is_numeric($p['orbital_period'])  ? (int)$p['orbital_period']  : 0,
                'clima'    => $p['climate'],
                'terreno'  => $p['terrain'],
                'imagen'   => null,
            ]);
        }
        return true;
    }
}
```

---

### 7. `public/index.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 64 | Falta `session_start()` — toda la sesión falla sin esto | Añadir `session_start()` |
| 82 | Carga `PlanetaController` para ruta `/planetas`, pero debería ser `ApiController` | Cargar `ApiController` e instanciarlo |
| 83 | Falta instanciar el controlador y llamar `handleRequest()` | `(new ApiController())->handleRequest()` |
| 93 | Ruta `../../app/controllers/` — sube 2 niveles desde `public/`, incorrecto | `/../app/controllers/AuthController.php` |
| 111 | `unset($mensaje_token)` — borra la variable local, **no la de sesión** | `unset($_SESSION["mensaje_token"])` |
| 116–124 | Acceso directo a `$_SESSION` sin `isset` — genera `Notice` si la clave no existe | Usar operador `??` o `isset` |
| 140–150 | HTML vacío — ningún mensaje se muestra al usuario | Añadir `echo` de cada variable |

#### Código corregido (sección PHP)

```php
<?php

session_start();

$uri    = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$method = $_SERVER['REQUEST_METHOD'];

// Rutas /planetas → API REST
if (str_starts_with($uri[0], 'planetas')) {
    require_once __DIR__ . "/../app/controllers/ApiController.php";
    $controller = new ApiController();
    $controller->handleRequest();
    exit;
}

// POST de login → AuthController
if (isset($_POST['login'])) {
    require_once __DIR__ . "/../app/controllers/AuthController.php";
    exit;
}

// Generar token CSRF nuevo
$_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));

// Recuperar y limpiar mensajes de sesión
$mensaje_token = isset($_SESSION["mensaje_token"]) ? $_SESSION["mensaje_token"] : false;
unset($_SESSION["mensaje_token"]);

$mensaje_api = isset($_SESSION["mensaje_api"]) ? $_SESSION["mensaje_api"] : false;
unset($_SESSION["mensaje_api"]);

$mensaje_error = isset($_SESSION["mensaje_error"]) ? $_SESSION["mensaje_error"] : false;
unset($_SESSION["mensaje_error"]);
```

#### Código corregido (sección HTML de mensajes)

```php
<?php if (!empty($mensaje_token)): ?>
    <h3><p style="color: blue;"><?php echo htmlspecialchars($mensaje_token); ?></p></h3>
<?php endif; ?>

<?php if (!empty($mensaje_api)): ?>
    <h2><p style="color: green;"><?php echo htmlspecialchars($mensaje_api); ?></p></h2>
<?php endif; ?>

<?php if (!empty($mensaje_error)): ?>
    <h3><p style="color: red;"><?php echo htmlspecialchars($mensaje_error); ?></p></h3>
<?php endif; ?>
```

---

### 8. `public/planetas/listado.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 83 | `$es_invitado =` sin valor | `!isset($_SESSION['usuario'])` |
| 93–96 | Bloque MOSTRAR vacío | Llamar a `$controller->mostrar($_POST['id'])` |
| 102–124 | Bloque BORRAR vacío | Ver código corregido |
| 130–135 | Bloque EDITAR vacío | Redirigir a `detalle.php` con datos en sesión |
| 141–146 | Bloque NUEVO vacío | Limpiar sesión y redirigir a `detalle.php` |
| 152–161 | Bloque INICIO vacío | Limpiar sesión y redirigir a `index.php` |
| 164–173 | Carga de datos y comprobación de importación vacías | Ver código corregido |
| HTML | Todos los `echo` vacíos en tabla, select y detalle | Añadir `htmlspecialchars($planeta['campo'])` |

#### Código corregido (sección PHP)

```php
<?php

session_start();
require_once __DIR__ . "/../../../app/controllers/PlanetaController.php";

$usuario     = $_SESSION["usuario"] ?? null;
$es_invitado = !isset($_SESSION['usuario']);
$controller  = new PlanetaController();

// MOSTRAR planeta seleccionado
if (isset($_POST["mostrar"])) {
    $controller->mostrar($_POST['id']);
}

// BORRAR planeta
if (isset($_POST["borrar"])) {
    $idBorrar = isset($_SESSION["planeta"]["id"]) ? $_SESSION["planeta"]["id"] : $_POST["id"];
    $controller->eliminar($idBorrar);
    unset($_SESSION["planeta"]);
    header("Location: listado.php");
    exit;
}

// EDITAR → redirige a detalle (planeta ya en sesión por MOSTRAR)
if (isset($_POST["editar"])) {
    header("Location: detalle.php");
    exit;
}

// NUEVO → limpia sesión y redirige a detalle
if (isset($_POST["nuevo"])) {
    unset($_SESSION["planeta"]);
    header("Location: detalle.php");
    exit;
}

// VOLVER AL INICIO → cerrar sesión
if (isset($_POST["inicio"])) {
    unset($_SESSION["usuario"]);
    unset($_SESSION["planeta"]);
    header("Location: ../../index.php");
    exit;
}

// Cargar planetas
$datos    = $controller->listar();
$planetas = $datos['planetas'];

// Si no hay planetas, importar desde SWAPI
if (empty($planetas)) {
    $controller->cargarDatosDesdeSWAPI();
    $datos    = $controller->listar();
    $planetas = $datos['planetas'];
}
```

#### Código corregido (HTML tabla)

```php
<?php foreach ($planetas as $planeta): ?>
    <tr>
        <td><?php echo htmlspecialchars($planeta['id']); ?></td>
        <td><?php echo htmlspecialchars($planeta['nombre']); ?></td>
        <td><?php echo htmlspecialchars($planeta['horasDia']); ?></td>
        <td><?php echo htmlspecialchars($planeta['diasAnyo']); ?></td>
        <td><?php echo htmlspecialchars($planeta['clima']); ?></td>
        <td><?php echo htmlspecialchars($planeta['terreno']); ?></td>
        <td>
            <?php if (!empty($planeta['imagen'])): ?>
                <img src="/public/uploads/<?php echo htmlspecialchars($planeta['imagen']); ?>" width="60">
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>
```

#### Código corregido (HTML select y detalle)

```php
<?php if (!$es_invitado): ?>
    <label>Selecciona un planeta:</label>
    <select name="id">
        <?php foreach ($planetas as $planeta): ?>
            <option value="<?php echo $planeta['id']; ?>">
                <?php echo htmlspecialchars($planeta['nombre']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br>

    <?php if (isset($_SESSION["planeta"])): ?>
        <h3>Detalles del planeta</h3>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]['nombre']); ?></p>
        <p><strong>Horas día:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]['horasDia']); ?></p>
        <p><strong>Días año:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]['diasAnyo']); ?></p>
        <p><strong>Clima:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]['clima']); ?></p>
        <p><strong>Terreno:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]['terreno']); ?></p>
        <?php if (!empty($_SESSION["planeta"]['imagen'])): ?>
            <img src="/public/uploads/<?php echo htmlspecialchars($_SESSION["planeta"]['imagen']); ?>" width="120">
        <?php endif; ?>
    <?php endif; ?>

    <br><br>
    <button type="submit" name="mostrar">Mostrar</button>
    <button type="submit" name="editar">Editar</button>
    <button type="submit" name="borrar">Borrar</button>
    <button type="submit" name="nuevo">Nuevo planeta</button>
<?php endif; ?>

<br><br>
<button type="submit" name="inicio">Volver al inicio</button>
```

---

### 9. `public/planetas/detalle.php`

#### Errores

| Línea | Error | Corrección |
|-------|-------|------------|
| 86 | `$_POST[""]` — clave vacía | `isset($_POST["editar"])` |
| 88–90 | `$controller;` y `$modo` sin valor asignado | Ver código corregido |
| 106 | `$id = $_` — PHP roto | `$id = $_POST["id"] ?? null` |
| 109 | `$datos = array()` — array vacío sin poblar | Construir desde `$_POST` |
| 111 | Condición vacía para update vs create | `if (!empty($id))` |
| 113 | `$controller->` sin método | `$controller->actualizar($id, $datos)` |
| 116 | `$controller->` sin método | `$controller->crear($datos)` |
| 136 | `elseif (isset(""))` — `isset("")` es siempre `true` | `elseif (isset($_POST["cancelar"]))` |
| 145 | `$datos =` sin valor | `$_SESSION["planeta"] ?? []` |
| 150 | `$modo = ? :` — ternario vacío | `!empty($datos['id']) ? 'editar' : 'nuevo'` |
| HTML | Atributos `value=""` vacíos en todos los inputs | Añadir `$datos['campo'] ?? ''` |

#### Código corregido

```php
<?php

session_start();
require_once __DIR__ . "/../../../app/controllers/PlanetaController.php";

$controller = new PlanetaController();
$errores    = [];

if (isset($_POST["editar"])) {
    $controller->mostrar($_POST["id"]);
    $modo = "editar";
}
elseif (isset($_POST["nuevo"])) {
    unset($_SESSION["planeta"]);
    $modo = "nuevo";
}
elseif (isset($_POST["guardar"])) {
    $id = $_POST["id"] ?? null;

    $datos = [
        'nombre'   => $_POST['nombre']   ?? '',
        'horasDia' => $_POST['horasDia'] ?? '',
        'diasAnyo' => $_POST['diasAnyo'] ?? '',
        'clima'    => $_POST['clima']    ?? '',
        'terreno'  => $_POST['terreno']  ?? '',
    ];

    if (!empty($id)) {
        $resultado = $controller->actualizar($id, $datos);
    } else {
        $resultado = $controller->crear($datos);
    }

    $errores = $resultado['errores'] ?? [];

    if (!empty($errores)) {
        $_SESSION["errores"] = $errores;
        $_SESSION["datos"]   = $datos;
        header("Location: detalle.php");
        exit;
    }

    header("Location: listado.php");
    exit;
}
elseif (isset($_POST["cancelar"])) {
    header("Location: listado.php");
    exit;
}

// Recuperar errores y datos de sesión si volvemos tras un error
$errores = $_SESSION["errores"] ?? [];
unset($_SESSION["errores"]);

$datos = $_SESSION["planeta"] ?? ($_SESSION["datos"] ?? []);
unset($_SESSION["datos"]);

$modo = !empty($datos['id']) ? 'editar' : 'nuevo';
```

#### Código corregido (HTML formulario)

```php
<form method="post" action="detalle.php" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $datos['id'] ?? ''; ?>">

    Nombre:    <input type="text" name="nombre"   value="<?php echo htmlspecialchars($datos['nombre']   ?? ''); ?>"><br><br>
    Horas día: <input type="text" name="horasDia" value="<?php echo htmlspecialchars($datos['horasDia'] ?? ''); ?>"><br><br>
    Días año:  <input type="text" name="diasAnyo" value="<?php echo htmlspecialchars($datos['diasAnyo'] ?? ''); ?>"><br><br>
    Clima:     <input type="text" name="clima"    value="<?php echo htmlspecialchars($datos['clima']    ?? ''); ?>"><br><br>
    Terreno:   <input type="text" name="terreno"  value="<?php echo htmlspecialchars($datos['terreno']  ?? ''); ?>"><br><br>

    Imagen: <input type="file" name="imagen"><br><br>

    <?php if (!empty($datos['imagen'])): ?>
        <img src="/public/uploads/<?php echo htmlspecialchars($datos['imagen']); ?>" width="120"><br><br>
    <?php endif; ?>

    <button type="submit" name="guardar">Guardar</button>
    <button type="submit" name="cancelar">Cancelar</button>

</form>
```

---

## Resumen de errores más graves

Los siguientes errores habrían impedido que la aplicación arrancase o funcionase mínimamente:

| # | Archivo | Error | Impacto |
|---|---------|-------|---------|
| 1 | `config/database.php` | DSN completamente malformado | La aplicación no puede conectar a la BD en absoluto |
| 2 | `app/models/Planeta.php` | `$stmt-> $pdo->execute(...)` en 3 métodos | PHP Fatal Error — ningún método del modelo funciona |
| 3 | `config/validaciones.php` | `if( == '')` sin variable | PHP Parse Error — el archivo no compila |
| 4 | `app/controllers/ApiController.php` | `new Planeta;5555` | PHP Parse Error — el archivo no compila |
| 5 | `app/controllers/PlanetaController.php` | Falta `}` de cierre en `crear()` | PHP Parse Error — el archivo no compila |
| 6 | `public/index.php` | Falta `session_start()` | Toda la gestión de sesión falla silenciosamente |
| 7 | `app/controllers/AuthController.php` | `header("Location:")` vacío | Redirección a URL inválida tras login |

---

## Cómo iniciar el servidor de desarrollo

```bash
cd public
php -S localhost:8000 router.php
```

Acceder en el navegador a: `http://localhost:8000`

Para probar la API, usar el archivo `planetas.http` con la extensión REST Client de VS Code.
