<?php
require_once 'funciones.php';
//cargamos los datos del formulario desde la sesión
if (!isset($_SESSION['post_temp'])) {
    header('Location: index.php');
    exit;
}

$datos = $_SESSION['post_temp'];
unset($_SESSION['post_temp']);

$nombre = $datos['nombre'] ?? '';
$perfil = $datos['perfil'] ?? '';
$password = $datos['password'] ?? '';
$tokenPost = $datos['token'] ?? '';

$errores = [];
//validar token
if (!isset($tokenPost)) {
    $errores[] = 'No se ha encontrado token!';
} elseif (!tokenEsValido($tokenPost)) {
    $errores[] = 'El token no coincide!';
}
//se valida que el usuario tenga el nombre y contraseña asociados al perfil seleccionado
//si no vamos a trabajar con contraseña solo hay que quitar la comprobación de la misma
if (empty($errores)) {
    if (!autenticarUsuario($nombre, $perfil, $password)) {
        $errores[] = 'Nombre, perfil o contraseña incorrectos.';
    } else {
        //autenticación correcta, se guarda en sesión y se redirige por perfil
        guardarSesionUsuario($nombre, $perfil);
        redirigirPorPerfil($perfil);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error de autenticación - Álvaro Verdeguer</title>
</head>
<body>
    <h1>Error de autenticación / token</h1>
    <?php if (!empty($errores)): ?>
        <ul style="color:red;">
            <?php foreach ($errores as $e): ?>
                <li><?php echo htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <p><a href="index.php">Volver al formulario</a></p>
</body>
</html>º