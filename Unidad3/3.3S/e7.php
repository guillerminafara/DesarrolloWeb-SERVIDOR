<?php
session_start();
if (isset($_POST["borrar"])) {
    $_SESSION["historial"] = [];
    $_SESSION["contador"] = 0;
    header("Location: e7.php");
    exit;
}
$historial = [];
$codigoAnterior = $_SESSION["codigo"];
$contadorAnterior = $_SESSION["contador"] ?? 0;
$historialAnterior = $_SESSION["historial"] ?? [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigoRan = $_POST["codigoRan"];
    $contador = intval($_POST["contador"]);
} else {
    $codigoRan = strval(rand(1000, 9999));
    $contador = 0;
}
if (isset($_SESSION["historial"])) {
    $historial = $_SESSION["historial"];
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $combinacion = trim($_POST["combinacion"]);
    $historial = $_SESSION["historial"];
    $contador++;

    if (!is_numeric($combinacion)) {
        $mensaje = "<p>$combinacion</p> <p id='mal'>Ingresa solamente números </p>";
    } elseif ($combinacion === $codigoRan) {
        $mensaje = " <p>$combinacion</p> <p id='bien'>Has acertado la contraseña</p> <p>Lo has hecho en $contador intentos</p>";
        $historial[] = $combinacion;
        $_SESSION["historial"] = $historial;
        $_SESSION["contador"] = $contador;
    } else {
        $mensaje = "<p>$combinacion</p> <p id='mal'>Contraseña incorrecta</p><p> LLevas $contador/4 intentos </p>";
        if ($contador <5) {
            $historial[] = $combinacion;
            $_SESSION["historial"] = $historial;
            $_SESSION["contador"] = $contador;
        } else {
            $mensaje = "<p id='mal'> Has agotado los intentos :C </p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #bien {
            color: aquamarine;
        }

        #mal {
            color: red;
        }
    </style>
</head>

<body>

    <h2>Ejercicio 7 Caja Fuerte - Guillermina Fara </h2>

    <?php
    echo "<p>Contraseña no tan secreta: <strong>$codigoRan</strong></p>";
    ?>
    <form method="POST">
        <p type="text" name="codigoRan" value="<?= htmlspecialchars($codigoRan) ?>"> </p>
        <br><br>
        <label>Ingresa la combinación:</label>
        <input type="text" name="combinacion">
        <input type="hidden" name="codigoRan" value="<?= htmlspecialchars($codigoRan) ?>">
        <input type="hidden" name="contador" value="<?= htmlspecialchars($contador) ?>">

        <br><br>
        <button type="submit">Adivinar</button>
        <button type="submit" name="borrar" value="1">borrar</button>

    </form>
    <?php

    echo "<h3>Intentos Actuales:</h3>";

    if (!empty($mensaje)) {
        echo $mensaje;
    }
    echo "<h3>Intentos Anteriores: </h3>";
    if (!empty($historial)) {
        echo "<ul>";

        foreach ($historial as $inten) {

            echo "<li>$inten</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aún no hay datos almacenadas </p>";
    }

    ?>
</body>

</html>