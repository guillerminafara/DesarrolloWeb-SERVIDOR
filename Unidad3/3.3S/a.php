<?php
session_start();

// -------------------------------
// Obtener valores anteriores (sesión)
// -------------------------------
$dia_anterior = $_SESSION["dia"] ?? "No hay datos";
$quincena_anterior = $_SESSION["quincena"] ?? "No hay datos";

// -------------------------------
// Variables ejecución actual
// -------------------------------
$dia_actual = "";
$quincena_actual = "";
$mensaje = "";

// -------------------------------
// Procesar formulario
// -------------------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $dia = intval($_POST["dia"]);

    if ($dia < 1 || $dia > 31) {
        $mensaje = "<p style='color:red;'>Introduce un día válido (1–31).</p>";
    } else {

        // Calcular quincena
        if ($dia <= 15) {
            $quincena_actual = "Primera quincena";
        } else {
            $quincena_actual = "Segunda quincena";
        }

        $dia_actual = $dia;

        // Guardar como "anterior" en la sesión (para la próxima ejecución)
        $_SESSION["dia"] = $dia_actual;
        $_SESSION["quincena"] = $quincena_actual;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5 con Sesiones</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .box { border: 1px solid #aaa; padding: 20px; width: 420px; margin-top: 20px; }
        input, button { padding: 5px; }
    </style>
</head>
<body>

<h2>Ejercicio 5 - Quincena con Sesiones</h2>

<form method="POST">
    <label>Introduce el día del mes:
        <input type="number" name="dia" min="1" max="31" required>
    </label>
    <br><br>
    <button type="submit">Calcular</button>
</form>

<?= $mensaje ?>

<div class="box">
    <h3>Ejecución Actual</h3>
    <?php if ($dia_actual !== ""): ?>
        <p><strong>Día:</strong> <?= $dia_actual ?></p>
        <p><strong>Quincena:</strong> <?= $quincena_actual ?></p>
    <?php else: ?>
        <p>Aún no hay datos en esta ejecución.</p>
    <?php endif; ?>
</div>

<div class="box">
    <h3>Ejecución Anterior (Sesión)</h3>
    <p><strong>Día anterior:</strong> <?= $dia_anterior ?></p>
    <p><strong>Quincena anterior:</strong> <?= $quincena_anterior ?></p>
</div>

</body>
</html>
