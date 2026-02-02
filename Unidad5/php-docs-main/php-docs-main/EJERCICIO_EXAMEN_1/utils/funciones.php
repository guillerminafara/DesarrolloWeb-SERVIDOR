<?php
require_once 'valida.php';
function obtenerDatosSesion($nombreSesion = 'datos', $default = null)
{
    if (isset($_SESSION[$nombreSesion])) {

        $datos = json_decode($_SESSION[$nombreSesion], true);

        if (is_array($datos)) {
            return $datos;
        }
    }

    return $default;
}

function generarNombreAleatorio($nombreFichero) {
    $fecha = date("d-m-y"); 
    return $fecha . "-" . $nombreFichero; 
}

function subirImagen($input = 'imagen', $directorio = 'uploads/')
{
    if (
        isset($_FILES[$input]) &&
        is_uploaded_file($_FILES[$input]['tmp_name'])
    ) {
        $nombre = time() . '_' . $_FILES[$input]['name'];
        $ruta = $directorio . $nombre;

        move_uploaded_file($_FILES[$input]['tmp_name'], $ruta);

        $_SESSION['foto'] = $ruta;

        return $ruta;
    }

    return false;
}

function validarFormulario(array $datos): array
{
    $errores = [];

    if (!validaRequerido($datos['token'] ?? '')) {
        $errores[] = "Token de seguridad inválido.";
    }

    if (!validaRequerido($datos['nombre'] ?? '')) {
        $errores[] = "El nombre es obligatorio.";
    } elseif (!validaSoloLetras(str_replace(' ', '', $datos['nombre']))) {
        $errores[] = "El nombre solo puede contener letras.";
    }

    if (!validaRequerido($datos['email'] ?? '') || !validaEmail($datos['email'] ?? '')) {
        $errores[] = "El email debe ser válido.";
    }

    if (!validaRequerido($datos['rol'] ?? '')) {
        $errores[] = "Debes seleccionar un rol.";
    }

    if (empty($datos['terminos'])) {
        $errores[] = "Debes aceptar los términos y condiciones.";
    }
    if (!validaRequerido($datos['accion'] ?? '')) {
        $errores[] = "Acción no válida.";
    }

    if (!empty($datos['imagen']) && !is_string($datos['imagen'])) {
        $errores[] = "Imagen inválida.";
    }


    return $errores;
}


function guardarDatosSesion($datos, $nombreSesion = 'datos')
{
    $_SESSION[$nombreSesion] = json_encode($datos);
}

function limpiarSesion() {
    unset($_SESSION['datos']);
    unset($_SESSION['foto']);
    unset($_SESSION['errores']);
}

function validarAccesoRol($rolPermitido)
{
    session_start();

    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $rolPermitido) {
        header('Location: index.php');
        exit;
    }

    print("Bienvenido " . $_SESSION['usuario'] . "!");
    print("Tu rol es " . $_SESSION['rol']);
}

function verificarToken($tokenEnviado) {
    if (isset($_SESSION['token']) && hash_equals($_SESSION['token'], $tokenEnviado)) {
        return true;
    }
    return false;
}
function crearTokenFormulario() {
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
    }

    return $_SESSION['token'];
}

?>