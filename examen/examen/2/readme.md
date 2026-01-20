# Documentación de funciones del proyecto

Alumno: CorsoCoder

Este README documenta las funciones individuales implementadas, con sus parámetros, valores de retorno y notas de uso. El objetivo es ayudar a comprender cómo se valida, sanitiza y protege el formulario, sin centrarse en la descripción de las páginas.

## Archivo: `validaciones.php`

### sanitize($value)
- Descripción: Limpia datos de entrada.
  - Para strings: recorta espacios y elimina etiquetas HTML.
  - Para arrays: aplica la limpieza recursivamente a cada elemento.
- Parámetros:
  - `mixed $value`: string o array a limpiar.
- Retorno: `mixed` el mismo tipo, ya sanitizado.
- Notas:
  - La salida segura al renderizar se hace con `htmlspecialchars`.
- Ejemplo:
  ```php
  $nombre = sanitize($_POST['nombre'] ?? '');
  $preferencias = sanitize($_POST['preferencias'] ?? []);
  ```

### val($key, $default = '')
- Descripción: Recupera de `$form_data` un valor para mantenerlo en el formulario tras validar.
- Parámetros:
  - `string $key`: clave del dato.
  - `string $default`: valor por defecto si no está presente.
- Retorno: `string` valor escapado con `htmlspecialchars`.
- Notas:
  - Usa `global $form_data`.
- Ejemplo:
  ```php
  <input type="text" name="usuario" value="<?php echo val('usuario'); ?>">
  ```

### exists($array, $key)
- Descripción: Comprueba si un índice existe en un array.
- Parámetros:
  - `array $array`
  - `string|int $key`
- Retorno: `bool`
- Ejemplo:
  ```php
  if (!exists($_POST, 'email')) { /* ... */ }
  ```

### is_empty($value)
- Descripción: Indica si un valor está vacío (string vacío, null, o array sin elementos).
- Parámetros:
  - `mixed $value`
- Retorno: `bool`
- Ejemplo:
  ```php
  if (is_empty($data['nombre'])) { /* ... */ }
  ```

### min_length($value, $min)
- Descripción: Verifica longitud mínima de un string.
- Parámetros:
  - `string $value`
  - `int $min`
- Retorno: `bool`
- Ejemplo:
  ```php
  if (!min_length($data['password'], 6)) { /* ... */ }
  ```

### max_length($value, $max)
- Descripción: Verifica longitud máxima de un string.
- Parámetros:
  - `string $value`
  - `int $max`
- Retorno: `bool`

### only_numbers($value)
- Descripción: Comprueba que el valor contiene exclusivamente dígitos (0-9).
- Parámetros:
  - `string $value`
- Retorno: `bool`
- Notas:
  - Usa `ctype_digit`.
- Ejemplo:
  ```php
  if (!only_numbers($data['cp'])) { /* ... */ }
  ```

### only_letters($value)
- Descripción: Comprueba que el valor contiene solo letras (A-Z) y espacios.
- Parámetros:
  - `string $value`
- Retorno: `bool`
- Notas:
  - Quita espacios para evaluar con `ctype_alpha`.
- Ejemplo:
  ```php
  if (!only_letters($data['nombre'])) { /* ... */ }
  ```

### alphanumeric($value)
- Descripción: Comprueba que el valor es alfanumérico (A-Z, 0-9), permitiendo espacios.
- Parámetros:
  - `string $value`
- Retorno: `bool`
- Notas:
  - Quita espacios para evaluar con `ctype_alnum`.

### valid_email($value)
- Descripción: Valida email usando una función nativa de PHP.
- Parámetros:
  - `string $value`
- Retorno: `bool`
- Notas:
  - Usa `filter_var($value, FILTER_VALIDATE_EMAIL)`.

### cp_valid($value)
- Descripción: Valida que el código postal tiene exactamente 5 dígitos.
- Parámetros:
  - `string $value`
- Retorno: `bool`
- Notas:
  - Combina `mb_strlen` y `only_numbers`.

### token_valid($postedToken)
- Descripción: Comprueba que el token CSRF enviado coincide con el de sesión.
- Parámetros:
  - `string $postedToken`
- Retorno: `bool`
- Notas:
  - Requiere que `$_SESSION['csrf_token']` esté definido.

### generate_csrf_token()
- Descripción: Genera un token CSRF y lo guarda en sesión.
- Parámetros: ninguno.
- Retorno: `string` token generado.
- Notas:
  - Usa `random_bytes(16)` y `bin2hex`.

### validar_formulario($data, $files)
- Descripción: Función principal de validación. Devuelve un array de errores sin usar sesión.
- Parámetros:
  - `array $data`: datos de texto ya sanitizados (POST).
  - `array $files`: datos de archivos (FILES).
- Retorno: `array` lista de mensajes de error (strings). Vacío si no hay errores.
- Valida:
  - Token CSRF presente y válido.
  - Existencia de campos requeridos: `nombre`, `usuario`, `email`, `password`, `cp`, `direccion`, `tipo_alquiler`, `estado`.
  - Vacíos y longitudes mínimas/máximas.
  - Reglas de letras, números y alfanumérico.
  - Email con `filter_var`.
  - CP exactamente 5 dígitos.
  - Valores válidos para listas:
    - Dirección: `calle`, `avenida`, `plaza`.
    - Tipo de alquiler: `días`, `semanas`, `meses`.
    - Estado: `registrado` o `nuevo`.
    - Alojamiento (checkbox múltiple, al menos uno): `piso`, `chalet`, `cabaña`, `casa rural`, `apartamento`.
    - Preferencias (select múltiple, opcional): `zona comercial`, `piscina`, `parking`, `parque infantil`, `transporte público`, `amueblado`.
  - Imagen obligatoria:
    - Extensión permitida: `jpg`, `jpeg`, `png`, `gif`.
    - `tmp_name` debe existir.
- Ejemplo:
  ```php
  $errors = validar_formulario($data, $_FILES);
  if (!empty($errors)) {
      // Mostrar errores en alumnos.php
  }
  ```

### renombrar_archivo($nombre, $alumnoNombre)
- Descripción: Genera un nombre de archivo con el formato `dia_mes_nombre.extension`.
- Parámetros:
  - `string $nombre`: nombre original del archivo (para extraer extensión).
  - `string $alumnoNombre`: se usa como base del nombre.
- Retorno: `string` nuevo nombre de archivo (sin ruta).
- Notas:
  - En la versión actual se normaliza con `preg_replace` para sustituir caracteres no alfanuméricos por `_`.
  - Para evitar totalmente expresiones regulares, se puede reemplazar por un bucle con `ctype_alnum` por carácter.
- Ejemplo:
  ```php
  $nuevo = renombrar_archivo($_FILES['foto']['name'], $data['nombre']); // "13_01_CorsoCoder.jpg" (ejemplo)
  ```

## Convenciones de seguridad y salida
- Al pintar datos, usar `htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')`.
- No se guardan errores en sesión; se gestionan como variable local en el formulario y se muestran en `<ul>` con clase `.error`.
- Todas las acciones son por `POST`. El `logout` también se realiza por `POST`.
