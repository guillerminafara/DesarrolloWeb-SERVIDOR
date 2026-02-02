<?php
// formController.php - Controlador del Formulario
session_start();

// 1. IMPORTACIÓN DE RECURSOS
require_once '../config/BDConfig.php';
require_once '../models/Database.php';
require_once '../models/EmpresaModel.php';
require_once '../utils/funciones.php';

// 2. VERIFICACIÓN DE PETICIÓN POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger y sanear datos del formulario
    $datos_para_sesion = [
        'token' => $_POST['token'] ?? '',
        'MAX_FILE_SIZE' => $_POST['MAX_FILE_SIZE'] ?? '',
        'nombre' => $_POST['nombre'] ?? '',
        'terminos' => $_POST['terminos'] ?? '',
        'imagen' => $_FILES['imagen'] ?? '',
        'accion' => $_POST['accion'] ?? '',
        'email' => trim($_POST['email'] ?? ''),
        'rol'   => $_POST['rol'] ?? ''
    ];

    // Usar el array ya saneado para la acción
    $accion = $datos_para_sesion['accion'] ?? '';

    switch ($accion) {

        case 'limpiar':
            // Borrar datos previos y errores
            unset($_SESSION['datos_previos'], $_SESSION['errores']);
            header('Location: index.php');
            exit;

        case 'validar':
            // Solo validamos y devolvemos errores si existen
            $errores = validarFormulario($datos_para_sesion);

            $_SESSION['errores'] = $errores;
            $_SESSION['datos_previos'] = $datos_para_sesion;

            header('Location: index.php');
            exit;

        case 'enviar':
            // Verificar token CSRF
            verificarTokenFormulario($datos_para_sesion['token']);

            // Validación completa
            $errores = validarFormulario($datos_para_sesion);

            // Subida de imagen si no hay errores de validación
            if (empty($errores) && !empty($datos_para_sesion['imagen']['name'])) {
                $subida = subirImagen($datos_para_sesion['imagen'], 'uploads/');
                if ($subida !== true) {
                    $errores[] = $subida; // subirImagen devuelve mensaje de error si falla
                }
            }

            // Si hay errores, guardarlos y volver a index
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $_SESSION['datos_previos'] = $datos_para_sesion;
                header('Location: index.php');
                exit;
            }

            // Si todo está bien, ejecutar consulta según rol
            try {
                $db = new Database();
                $modelo = new EmpresaModel($db->getConnection());

                $rol = $datos_para_sesion['rol'];
                $resultados = [];

            switch ($rol) {
                case 'ventas':
                    $resultados = $modelo->consultaUsuario();
                    $_SESSION['resultados_consulta'] = $resultados;
                    header('Location: ventas.php');
                    exit;

                case 'marketing':
                    $resultados = $modelo->consultaMarketing();
                    $_SESSION['resultados_consulta'] = $resultados;
                    header('Location: marketing.php');
                    exit;

                case 'usuarios':
                    $resultados = $modelo->consultaCompras();
                    $_SESSION['resultados_consulta'] = $resultados;
                    header('Location: usuarios.php');
                    exit;
            }


            } catch (PDOException $e) {
                $_SESSION['errores'] = ["Error en la base de datos: " . $e->getMessage()];
                $_SESSION['datos_previos'] = $datos_para_sesion;
                header('Location: index.php');
                exit;
            }

        default:
            // Acción no reconocida, volvemos al inicio
            header('Location: index.php');
            exit;
    }

} else {
    // Si se intenta acceder al controlador sin POST
    header('Location: index.php');
    exit;
}
