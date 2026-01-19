<?php
require_once 'funciones.php';
require_once 'datos_trabajadores.php';

if (!usuarioEstaLogueado() || $_SESSION['usuario_perfil'] !== 'Responsable de Nóminas') {
    header('Location: index.php');
    exit;
}
// //comprobación de token en la URL (desactivada)
// if (!isset($_GET['token']) || !tokenEsValido($_GET['token'])) {
//     limpiarSesionUsuario();
//     header('Location: index.php');
//     exit;
// }

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['accion'] ?? '') === 'cambiar_sid') {
    cambiarSIDyToken();
    $mensaje = "SID y token cambiados desde Nóminas.";
}

$trabajadores = Trabajador::obtenerTodos();
$min = salarioMinimo($trabajadores);
$max = salarioMaximo($trabajadores);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Responsable de Nóminas - Álvaro Verdeguer</title>
</head>
<body>
    <h1>Página de Responsable de Nóminas - Álvaro Verdeguer</h1>
    <p>Usuario: <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?></p>

    <?php if ($mensaje !== ''): ?>
        <p style="color:green;"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <h2>Resultados de salarios (Nóminas ve MÍNIMO y MÁXIMO)</h2>
    <p>Salario mínimo: <?php echo number_format($min, 2); ?> €</p>
    <p>Salario máximo: <?php echo number_format($max, 2); ?> €</p>

    <form method="post">
        <button type="submit" name="accion" value="cambiar_sid">Cambiar SID (nuevo token)</button>
    </form>

    <p>
        <a href="logout.php?token=<?php echo htmlspecialchars($_SESSION['token'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            Cerrar sesión
        </a>
    </p>
</body>
</html>