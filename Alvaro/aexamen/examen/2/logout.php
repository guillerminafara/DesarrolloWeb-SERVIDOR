<?php
// Alumno: CorsoCoder
// Cierra la sesión y destruye datos. Solo por POST.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION = [];
    session_unset();
    session_destroy();
    // Creamos una nueva sesión para poder tener un nuevo token si se regresa
    session_start();
    require_once __DIR__ . '/validaciones.php';
    generate_csrf_token();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesión cerrada</title>
</head>
<body>
    <p>La sesión se ha cerrado correctamente.</p>
    <form action="alumnos.php" method="post">
        <button type="submit" name="accion" value="volver">Volver al formulario</button>
    </form>
</body>
</html>