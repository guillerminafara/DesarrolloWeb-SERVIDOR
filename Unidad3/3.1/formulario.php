<?php
session_start();

if (!isset($_SESSION['datos'])) {
    header("Location: formulario.php");
    exit;
}

$datos = $_SESSION['datos'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos introducidos</title>
</head>
<body>
    <h2>Datos introducidos por el usuario</h2>

    <p><strong>Nombre:</strong> <?= htmlspecialchars($datos['nombre']) ?></p>
    <p><strong>Edad:</strong> <?= htmlspecialchars($datos['edad']) ?></p>
    <p><strong>Nivel de estudios:</strong> <?= htmlspecialchars($datos['estudios']) ?></p>
    <p><strong>Situación actual:</strong> <?= implode(", ", $datos['situacion']) ?></p>

    <?php
    $todos_hobbies = $datos['hobbies'];
    if (!empty($datos['otro_hobby'])) {
        $todos_hobbies[] = $datos['otro_hobby'];
    }
    ?>
    <p><strong>Hobbies:</strong> <?= implode(", ", $todos_hobbies) ?></p>

    <form action="ayuda.php" method="get">
        <button type="submit">Volver a la página inicial</button>
    </form>
</body>
</html>
