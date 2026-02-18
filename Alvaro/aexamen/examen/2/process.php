<?php
// Alumno: CorsoCoder
// Procesamiento del formulario. Recibe datos únicamente por POST.
// Acciones: limpiar, validar, enviar, regenerar_token

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/validaciones.php';

// Solo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Mostrar formulario sin procesar (sin GET funcional)
    $form_data = [];
    $errors = ['Solicitud inválida: use el formulario (POST).'];
    include __DIR__ . '/alumnos.php';
    exit;
}

// Determinar acción
$accion = isset($_POST['accion']) ? $_POST['accion'] : 'validar';

// Sanitizar datos de texto (excepto archivo)
$data = [];
foreach ($_POST as $k => $v) {
    // csrf_token también se sanitiza
    if ($k === 'preferencias' || $k === 'alojamiento') {
        $data[$k] = [];
        if (is_array($v)) {
            foreach ($v as $item) {
                $data[$k][] = sanitize($item);
            }
        }
    } else {
        $data[$k] = sanitize($v);
    }
}

// Archivos (no se sanitiza contenido, solo nombres)
$files = $_FILES;

switch ($accion) {
    case 'limpiar':
        // Limpiar sesión y formulario
        $_SESSION = [];
        session_unset();
        // Regenerar token para nueva sesión limpia
        if (session_status() === PHP_SESSION_ACTIVE) {
            generate_csrf_token();
        }
        $errors = [];
        $form_data = [
            'nombre' => '',
            'usuario' => '',
            'email' => '',
            'password' => '',
            'cp' => '',
            'direccion' => '',
            'alojamiento' => [],
            'preferencias' => [],
            'tipo_alquiler' => '',
            'estado' => '',
            'csrf_token' => $_SESSION['csrf_token'] ?? ''
        ];
        include __DIR__ . '/alumnos.php';
        exit;

    case 'regenerar_token':
        // Regenerar token CSRF
        generate_csrf_token();
        // Mantener datos actuales del formulario (importados si estaban en sesión)
        // No mostramos mensajes generales, solo re-render del formulario con nuevo token
        $errors = [];
        // Conservar $form_data: si había datos, los reusamos; sino, vacíos
        if (isset($_SESSION['alumno_data'])) {
            $form_data = $_SESSION['alumno_data'];
        } else {
            $form_data = [
                'nombre' => '',
                'usuario' => '',
                'email' => '',
                'password' => '',
                'cp' => '',
                'direccion' => '',
                'alojamiento' => [],
                'preferencias' => [],
                'tipo_alquiler' => '',
                'estado' => '',
                'csrf_token' => $_SESSION['csrf_token']
            ];
        }
        include __DIR__ . '/alumnos.php';
        exit;

    case 'validar':
        // Validar datos, no enviar a página final
        $form_data = $data; // para mantener valores en el formulario
        $errors = validar_formulario($data, $files);
        include __DIR__ . '/alumnos.php';
        exit;

    case 'enviar':
        // Validar y si OK, guardar en sesión y redirigir a alumnos_ok.php
        $form_data = $data;
        $errors = validar_formulario($data, $files);

        if (!empty($errors)) {
            include __DIR__ . '/alumnos.php';
            exit;
        }

        // Imagen: mover a uploads/
        $nombreOriginal = $files['foto']['name'];
        $tmp = $files['foto']['tmp_name'];
        $nombreRenombrado = renombrar_archivo($nombreOriginal, $data['nombre']);
        $rutaDestino = __DIR__ . '/uploads/' . $nombreRenombrado;

        // Nota: se asume carpeta uploads/ existe y es escribible
        if (!move_uploaded_file($tmp, $rutaDestino)) {
            $errors[] = 'No se pudo guardar la imagen en la carpeta uploads/.';
            include __DIR__ . '/alumnos.php';
            exit;
        }

        // Guardar datos en sesión (sanitizados)
        $_SESSION['alumno_data'] = [
            'nombre' => $data['nombre'],
            'usuario' => $data['usuario'],
            'email' => $data['email'],
            'password' => $data['password'],
            'cp' => $data['cp'],
            'direccion' => $data['direccion'],
            'alojamiento' => isset($data['alojamiento']) ? $data['alojamiento'] : [],
            'preferencias' => isset($data['preferencias']) ? $data['preferencias'] : [],
            'tipo_alquiler' => $data['tipo_alquiler'],
            'estado' => $data['estado'],
            'csrf_token' => $_SESSION['csrf_token'], // guardamos el token vigente
            'ruta_imagen' => 'uploads/' . $nombreRenombrado
        ];

        // Rol en sesión y fecha si es nuevo
        $_SESSION['rol'] = $data['estado'];
        if ($_SESSION['rol'] === 'nuevo' && !isset($_SESSION['fecha_registro'])) {
            $_SESSION['fecha_registro'] = date('Y-m-d H:i:s');
        }

        // Redirigir a página final
        header('Location: alumnos_ok.php');
        exit;

    default:
        // Acción desconocida -> validar por defecto
        $form_data = $data;
        $errors = validar_formulario($data, $files);
        include __DIR__ . '/alumnos.php';
        exit;
}