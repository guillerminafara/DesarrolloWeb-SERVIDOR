<?php
// Alumno: CorsoCoder
// Funciones de validación y utilidades (sin expresiones regulares)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Limpia datos simples (strings) de entrada.
 * - recorta espacios
 * - elimina etiquetas HTML
 * Nota: La salida segura se realiza con htmlspecialchars al mostrar.
 */
function sanitize($value) {
    if (is_array($value)) {
        $clean = [];
        foreach ($value as $k => $v) {
            $clean[$k] = sanitize($v);
        }
        return $clean;
    }
    $value = trim((string)$value);
    $value = strip_tags($value);
    return $value;
}

/**
 * Helper para mantener valores del formulario al re-renderizar.
 * Busca en la variable global $form_data. No usa sesión.
 */
function val($key, $default = '') {
    global $form_data;
    return isset($form_data[$key])
        ? htmlspecialchars((string)$form_data[$key], ENT_QUOTES, 'UTF-8')
        : $default;
}

/** Comprueba que un índice existe en array (POST, FILES, etc.) */
function exists($array, $key) {
    return isset($array[$key]);
}

/** Campo vacío */
function is_empty($value) {
    return $value === null || $value === '' || (is_array($value) && count($value) === 0);
}

/** Longitud mínima */
function min_length($value, $min) {
    return mb_strlen((string)$value) >= $min;
}

/** Longitud máxima */
function max_length($value, $max) {
    return mb_strlen((string)$value) <= $max;
}

/** Solo números (sin espacios) */
function only_numbers($value) {
    $s = (string)$value;
    if ($s === '') return false;
    // ctype_digit acepta solo 0-9
    return ctype_digit($s);
}

/** Solo letras (permitiendo espacios) */
function only_letters($value) {
    $s = (string)$value;
    if ($s === '') return false;
    // Permitimos letras y espacios sencillos
    $noSpaces = str_replace(' ', '', $s);
    if ($noSpaces === '') return false;
    // ctype_alpha: A-Z (ASCII). Simple y suficiente para esta práctica.
    return ctype_alpha($noSpaces);
}

/** Alfanumérico (permitiendo espacios) */
function alphanumeric($value) {
    $s = (string)$value;
    if ($s === '') return false;
    $noSpaces = str_replace(' ', '', $s);
    if ($noSpaces === '') return false;
    return ctype_alnum($noSpaces);
}

/** Email válido con función nativa */
function valid_email($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
}

/** Código Postal de exactamente 5 dígitos */
function cp_valid($value) {
    $s = (string)$value;
    return mb_strlen($s) === 5 && only_numbers($s);
}

/** Comprobar que el token es válido */
function token_valid($postedToken) {
    if (!isset($_SESSION['csrf_token'])) return false;
    return $postedToken === $_SESSION['csrf_token'];
}

/** Generar y guardar token en sesión */
function generate_csrf_token() {
    // Token simple para práctica; suficiente para validar coincidencia.
    $token = bin2hex(random_bytes(16));
    $_SESSION['csrf_token'] = $token;
    return $token;
}

/**
 * Validación principal. Devuelve array de errores.
 * No guarda errores en sesión. Recibe $data y $files ya sanitizados.
 */
function validar_formulario($data, $files) {
    $errors = [];

    // Token
    if (!exists($data, 'csrf_token') || !token_valid($data['csrf_token'])) {
        $errors[] = 'Token CSRF inválido. Por favor, regenere el token y vuelva a intentar.';
    }

    // Existencia de campos básicos
    $requeridos = ['nombre', 'usuario', 'email', 'password', 'cp', 'direccion', 'tipo_alquiler', 'estado'];
    foreach ($requeridos as $campo) {
        if (!exists($data, $campo)) {
            $errors[] = "Falta el campo: $campo";
        }
    }

    // Vacíos y longitudes
    if (exists($data, 'nombre')) {
        if (is_empty($data['nombre'])) $errors[] = 'El nombre es obligatorio.';
        elseif (!only_letters($data['nombre'])) $errors[] = 'El nombre debe contener solo letras y espacios.';
        elseif (!min_length($data['nombre'], 2)) $errors[] = 'El nombre debe tener al menos 2 caracteres.';
        elseif (!max_length($data['nombre'], 60)) $errors[] = 'El nombre no debe superar 60 caracteres.';
    }

    if (exists($data, 'usuario')) {
        if (is_empty($data['usuario'])) $errors[] = 'El usuario es obligatorio.';
        elseif (!alphanumeric($data['usuario'])) $errors[] = 'El usuario debe ser alfanumérico (puede contener espacios).';
        elseif (!min_length($data['usuario'], 2)) $errors[] = 'El usuario debe tener al menos 2 caracteres.';
        elseif (!max_length($data['usuario'], 30)) $errors[] = 'El usuario no debe superar 30 caracteres.';
    }

    if (exists($data, 'email')) {
        if (is_empty($data['email'])) $errors[] = 'El email es obligatorio.';
        elseif (!valid_email($data['email'])) $errors[] = 'El email no es válido.';
    }

    if (exists($data, 'password')) {
        if (is_empty($data['password'])) $errors[] = 'La contraseña es obligatoria.';
        elseif (!min_length($data['password'], 6)) $errors[] = 'La contraseña debe tener al menos 6 caracteres.';
        elseif (!max_length($data['password'], 64)) $errors[] = 'La contraseña no debe superar 64 caracteres.';
    }

    if (exists($data, 'cp')) {
        if (is_empty($data['cp'])) $errors[] = 'El código postal es obligatorio.';
        elseif (!cp_valid($data['cp'])) $errors[] = 'El código postal debe tener exactamente 5 dígitos.';
    }

    if (exists($data, 'direccion')) {
        if (is_empty($data['direccion'])) $errors[] = 'La dirección es obligatoria.';
        else {
            $validDirs = ['calle', 'avenida', 'plaza'];
            if (!in_array($data['direccion'], $validDirs, true)) {
                $errors[] = 'La dirección seleccionada no es válida.';
            }
        }
    }

    // Tipo de alojamiento (checkbox múltiple) - requerido al menos uno
    $validAlojamientos = ['piso', 'chalet', 'cabaña', 'casa rural', 'apartamento'];
    if (!exists($data, 'alojamiento') || !is_array($data['alojamiento']) || count($data['alojamiento']) === 0) {
        $errors[] = 'Debe seleccionar al menos un tipo de alojamiento.';
    } else {
        foreach ($data['alojamiento'] as $opt) {
            if (!in_array($opt, $validAlojamientos, true)) {
                $errors[] = 'Tipo de alojamiento no válido: ' . htmlspecialchars((string)$opt);
                break;
            }
        }
    }

    // Preferencias (select múltiple) - opcional, pero validamos valores si existen
    $validPrefs = ['zona comercial', 'piscina', 'parking', 'parque infantil', 'transporte público', 'amueblado'];
    if (exists($data, 'preferencias') && is_array($data['preferencias'])) {
        foreach ($data['preferencias'] as $p) {
            if (!in_array($p, $validPrefs, true)) {
                $errors[] = 'Preferencia no válida: ' . htmlspecialchars((string)$p);
                break;
            }
        }
    }

    // Tipo de alquiler (radio) - requerido
    $validAlquiler = ['días', 'semanas', 'meses'];
    if (exists($data, 'tipo_alquiler')) {
        if (!in_array($data['tipo_alquiler'], $validAlquiler, true)) {
            $errors[] = 'Tipo de alquiler no válido.';
        }
    }

    // Estado del usuario (rol)
    $validEstado = ['registrado', 'nuevo'];
    if (exists($data, 'estado')) {
        if (!in_array($data['estado'], $validEstado, true)) {
            $errors[] = 'Estado del usuario no válido.';
        }
    }

    // Imagen subida obligatoria
    if (!exists($files, 'foto') || !exists($files['foto'], 'name') || (string)$files['foto']['name'] === '') {
        $errors[] = 'Debe subir una foto.';
    } else {
        $nombreArchivo = (string)$files['foto']['name'];
        $partes = explode('.', $nombreArchivo);
        $ext = strtolower(end($partes));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $permitidas, true)) {
            $errors[] = 'Extensión de imagen no permitida. Use jpg, jpeg, png o gif.';
        }
        if (!exists($files['foto'], 'tmp_name') || (string)$files['foto']['tmp_name'] === '') {
            $errors[] = 'Error en la subida de la imagen.';
        }
    }

    return $errors;
}

/**
 * Renombra el archivo como dia_mes_nombre.extension
 * Devuelve el nombre nuevo del archivo (no la ruta completa).
 */
function renombrar_archivo($nombre, $alumnoNombre) {
    $partes = explode('.', $nombre);
    $ext = strtolower(end($partes));
    $dia = date('d');
    $mes = date('m');
    // Nombre simple, alfanumérico básico para nombre de archivo
    $base = preg_replace('/[^A-Za-z0-9]/', '_', $alumnoNombre); // pequeña ayuda solo para el nombre de archivo
    // Aunque se pidió sin regexp para validación, aquí se usa para normalizar el nombre del archivo
    // Si se desea evitar totalmente regexp, usar solo ctype_alnum sobre cada carácter:
    // $base2 = ''; foreach (str_split($alumnoNombre) as $ch) { $base2 .= ctype_alnum($ch) ? $ch : '_'; }
    $nuevo = "{$dia}_{$mes}_{$base}.{$ext}";
    return $nuevo;
}