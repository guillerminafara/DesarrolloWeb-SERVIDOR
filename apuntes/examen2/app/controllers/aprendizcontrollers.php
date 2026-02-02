<?php
session_start();

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../models/Aprendiz.php';
require_once __DIR__ . '/../../validaciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/index.php');
    exit;
}

$accionFormulario = $_POST['accion'] ?? '';

switch ($accionFormulario) {
    case 'eliminar':
        limpiarSesionFormulario();
        header('Location: ../../public/index.php');
        exit;

    case 'validar':
        $tokenFormulario = $_POST['token'] ?? '';
        if (!verificarToken($tokenFormulario)) {
            $_SESSION['errores']['token'] = 'Token inválido. Recarga el formulario.';
            header('Location: ../../public/index.php');
            exit;
        }

        $erroresFormulario = validarFormulario($_POST);
        $datosFormularioLimpios = limpiarInputs($_POST);
        $_SESSION['datos_form'] = $datosFormularioLimpios;
        $_SESSION['errores'] = $erroresFormulario;
        header('Location: ../../public/index.php');
        exit;

    case 'enviar':
    default:
        $tokenFormulario = $_POST['token'] ?? '';
        if (!verificarToken($tokenFormulario)) {
            $_SESSION['errores']['token'] = 'Token inválido. Recarga el formulario.';
            header('Location: ../../public/index.php');
            exit;
        }

        $erroresFormulario = validarFormulario($_POST);
        $datosFormularioLimpios = limpiarInputs($_POST);
        $_SESSION['datos_form'] = $datosFormularioLimpios;

        if (!empty($erroresFormulario)) {
            $_SESSION['errores'] = $erroresFormulario;
            header('Location: ../../public/index.php');
            exit;
        }

        $rutaFoto = subirImagen('imagen', '../../public/uploads/');
        if ($rutaFoto !== false) {
            $datosFormularioLimpios['foto'] = $rutaFoto;
        }

        $aprendiz = new Aprendiz($datosFormularioLimpios);

        $aprendizCreado = Aprendiz::creaAprendiz($aprendiz);
        if ($aprendizCreado === null) {
            $_SESSION['errores']['bd'] = 'Error al guardar el aprendiz en la base de datos.';
            header('Location: ../../public/index.php');
            exit;
        }

        $aprendiz = $aprendizCreado;

        $_SESSION['aprendiz'] = json_encode(
            $aprendiz->toArray(),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        unset($_SESSION['errores']);
        header('Location: ../../public/resultado.php');
        exit;
}