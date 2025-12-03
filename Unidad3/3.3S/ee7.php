<?php
session_start();
// $historial = [];

if (!isset($_SESSION["codigo"])) {
    $codigoRand = strval(rand(1000, 9999));

    $_SESSION["codigo"] = $codigoRand;
}
$codigoAnterior = $_SESSION["codigo"];
$contadorAnterior = $_SESSION["contador"] ?? 0;
$historialAnterior = $_SESSION["historialAnterior"] ?? [];
$historialActual = $_SESSION["historialActual"] ?? [];

$salida;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $combinacion = trim($_POST["combinacion"]);
    $contador++;
    $_SESSION["contador"]=$contador;
    $historial = $_SESSION["historial"];
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

</body>

</html>