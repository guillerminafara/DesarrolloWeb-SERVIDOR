<?php
require_once 'funciones.php';
require_once 'datos_trabajadores.php';
if (!usuarioEstaLogueado() || $_SESSION['usuario_perfil'] !== 'Gerente') {
    header('Location: index.php');
    exit;
}
// //volvemos a comprobar el token de la URL (desactivado)
// if (!isset($_GET['token']) || !tokenEsValido(tokenRecibido: $_GET['token'])) {
//     limpiarSesionUsuario();
//     header('Location: index.php');
//     exit;
// }
//si la acción es cambiar_sid se cambia el SID y token
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'cambiar_sid') {
    cambiarSIDyToken();
    $mensaje = "SID y token cambiados desde Gerente.";
} else {
    $mensaje = "";
}

// Datos de trabajadores
$trabajadores = Trabajador::obtenerTodos();
$min = salarioMinimo($trabajadores);
$max = salarioMaximo($trabajadores);
$med = salarioMedio($trabajadores);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página de Gerente - Álvaro Verdeguer</title>
</head>
<body>
    <h1>Página de Gerente - Álvaro Verdeguer</h1>
    <p>Usuario: <?php echo htmlspecialchars($_SESSION['usuario_nombre'], ENT_QUOTES, 'UTF-8'); ?></p>

    <?php if ($mensaje !== ''): ?>
        <p style="color:green;"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <h2>Resultados de salarios (Gerente ve todo)</h2>
    <p>Salario mínimo: <?php echo number_format($min, 2); ?> €</p>
    <p>Salario máximo: <?php echo number_format($max, 2); ?> €</p>
    <p>Salario medio:  <?php echo number_format($med, 2); ?> €</p>

    <h3>Lista de trabajadores</h3>
    <ul>
        <?php foreach ($trabajadores as $t): ?>
            <li><?php echo htmlspecialchars($t->getNombre(), ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>

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