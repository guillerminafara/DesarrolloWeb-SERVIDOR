<?php
// Alumno: CorsoCoder
// Página final: muestra datos enviados, imagen y rol

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/validaciones.php';

// Comprobar que hay datos en sesión
if (!isset($_SESSION['alumno_data']) || !is_array($_SESSION['alumno_data'])) {
    // Si no hay datos, mostrar formulario
    $errors = ['No hay datos en sesión. Por favor, complete el formulario.'];
    $form_data = [];
    include __DIR__ . '/alumnos.php';
    exit;
}

// Verificar que el token aún existe
if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token'] === '') {
    $errors = ['Token CSRF ausente.'];
    $form_data = $_SESSION['alumno_data'];
    include __DIR__ . '/alumnos.php';
    exit;
}

$datos = $_SESSION['alumno_data'];
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';
$fecha = isset($_SESSION['fecha_registro']) ? $_SESSION['fecha_registro'] : null;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos - Datos enviados</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h1 style="color:blue"><?php echo htmlspecialchars($datos['usuario'] ?? 'Usuario', ENT_QUOTES, 'UTF-8'); ?></h1>

<h2>Datos enviados</h2>
<ul>
    <li>Nombre: <?php echo htmlspecialchars($datos['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Usuario: <?php echo htmlspecialchars($datos['usuario'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Email: <?php echo htmlspecialchars($datos['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Contraseña: <?php echo htmlspecialchars($datos['password'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Código Postal: <?php echo htmlspecialchars($datos['cp'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Dirección: <?php echo htmlspecialchars($datos['direccion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Tipo de alquiler: <?php echo htmlspecialchars($datos['tipo_alquiler'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Estado: <?php echo htmlspecialchars($datos['estado'] ?? '', ENT_QUOTES, 'UTF-8'); ?></li>
    <li>Tipos de alojamiento:
        <ul>
            <?php foreach (($datos['alojamiento'] ?? []) as $a): ?>
                <li><?php echo htmlspecialchars($a, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </li>
    <li>Preferencias:
        <ul>
            <?php foreach (($datos['preferencias'] ?? []) as $p): ?>
                <li><?php echo htmlspecialchars($p, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </li>
</ul>

<?php if (!empty($datos['ruta_imagen'])): ?>
    <h3>Imagen subida</h3>
    <img src="<?php echo htmlspecialchars($datos['ruta_imagen'], ENT_QUOTES, 'UTF-8'); ?>" alt="Foto subida" style="max-width:300px;">
<?php endif; ?>

<h3>Rol del usuario</h3>
<p>
    <?php
    if ($rol === 'nuevo') {
        echo 'Usuario nuevo.';
        if ($fecha) {
            echo ' Fecha de registro: ' . htmlspecialchars($fecha, ENT_QUOTES, 'UTF-8');
        } else {
            echo ' ¡Bienvenido!';
        }
    } elseif ($rol === 'registrado') {
        echo 'Usuario ya registrado.';
    } else {
        echo 'Rol no especificado.';
    }
    ?>
</p>

<!-- Botón para volver al formulario (POST) -->
<form action="alumnos.php" method="post">
    <button type="submit" name="accion" value="volver">Volver al formulario</button>
</form>

<!-- Logout por POST -->
<form action="logout.php" method="post" style="margin-top:10px;">
    <button type="submit" name="accion" value="logout">Cerrar sesión</button>
</form>

</body>
</html>