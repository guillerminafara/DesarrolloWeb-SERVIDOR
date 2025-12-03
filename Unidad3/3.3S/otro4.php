<?php
session_start();

/* === INICIALIZACIÓN DE SESIÓN === */
if (!isset($_SESSION["codigo"])) {
    $_SESSION["codigo"] = strval(rand(1000, 9999));
    $_SESSION["contador"] = 0;
    $_SESSION["historial_actual"] = [];
    $_SESSION["historial_anterior"] = [];
}

$codigoRan = $_SESSION["codigo"];
$contador  = $_SESSION["contador"];
$historialActual = $_SESSION["historial_actual"];
$historialAnterior = $_SESSION["historial_anterior"];

$mensaje = "";

/* === PROCESO DEL FORMULARIO === */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $combinacion = trim($_POST["combinacion"]);
    $contador++;
    $_SESSION["contador"] = $contador;

    $historialActual[] = $combinacion;
    $_SESSION["historial_actual"] = $historialActual;

    if (!is_numeric($combinacion)) {

        $mensaje = "<p id='mal'>Ingresa solamente números</p>";

    } elseif ($combinacion === $codigoRan) {

        $mensaje = "<p id='bien'>Has acertado la contraseña en $contador intentos</p>";

        $historialAnterior[] = [
            "intentos" => $historialActual,
            "resultado" => "ÉXITO",
            "codigo" => $codigoRan
        ];

        $_SESSION["historial_anterior"] = $historialAnterior;

        // Reiniciar sesión
        reiniciarCaja();

    } else {

        $mensaje = "<p id='mal'>Contraseña incorrecta ($contador / 4)</p>";

        if ($contador >= 4) {

            $mensaje = "<p id='mal'>Has agotado los intentos</p>";

            $historialAnterior[] = [
                "intentos" => $historialActual,
                "resultado" => "FALLO",
                "codigo" => $codigoRan
            ];

            $_SESSION["historial_anterior"] = $historialAnterior;

            // Reiniciar sesión
            reiniciarCaja();
        }
    }
}

function reiniciarCaja()
{
    $_SESSION["codigo"] = strval(rand(1000, 9999));
    $_SESSION["contador"] = 0;
    $_SESSION["historial_actual"] = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Caja Fuerte con Sesiones</title>
    <style>
        #bien { color: green; }
        #mal  { color: red; }
    </style>
</head>

<body>

<h2>Ejercicio 7 Caja Fuerte - SESIONES</h2>

<p><strong>Contraseña (para pruebas):</strong> <?= $codigoRan ?></p>

<form method="POST">
    <label>Ingresa la combinación:</label>
    <input type="password" name="combinacion" required>
    <br><br>
    <button type="submit">Adivinar</button>
</form>

<?= $mensaje ?>

<hr>

<h3>🔹 Ejecución actual</h3>
<p>Intentos actuales: <?= $contador ?></p>

<?php if (!empty($historialActual)): ?>
    <ul>
        <?php foreach ($historialActual as $intento): ?>
            <li><?= htmlspecialchars($intento) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aún no hay intentos</p>
<?php endif; ?>

<hr>

<h3>📌 Ejecuciones anteriores</h3>

<?php if (!empty($historialAnterior)): ?>
    <?php foreach ($historialAnterior as $indice => $bloque): ?>
        <p><strong>Intento <?= $indice + 1 ?>:</strong></p>
        <ul>
            <?php foreach ($bloque["intentos"] as $i): ?>
                <li><?= htmlspecialchars($i) ?></li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Resultado:</strong> <?= $bloque["resultado"] ?></p>
        <p><strong>Contraseña correcta:</strong> <?= $bloque["codigo"] ?></p>
        <hr>
    <?php endforeach; ?>
<?php else: ?>
    <p>No hay ejecuciones anteriores</p>
<?php endif; ?>

</body>
</html>
