<?php
session_start();
$cantidadAnterior = intval($_SESSION["idCantidad"] ?? "");
$divisaAnterior = $_SESSION["divisa"] ?? "0";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cantidad = $_POST["idCantidad"];
    $divisa = $_POST["divisa"];

    if ($cantidad>0 && $divisa>0) {
        $_SESSION["idCantidad"] = $cantidad;
        $_SESSION["divisa"] = $divisa;
    } else {
        echo"entra mal";
    }

    echo "<h3>Salida Actual:</h3>";
    if (isset($cantidad) && isset($divisa)) {
        echo calcularCambio($divisa, $cantidad);
    } else {
        echo "<p>Aún no hay datos almacenados </p>";
    }
    echo "<h3>Salida Anterior:</h3>";
    if (isset($_SESSION["idCantidad"]) && isset($_SESSION["divisa"])) {
        echo calcularCambio($divisaAnterior, $cantidadAnterior);
    } else {
        echo "<p>Aún no hay datos almacenados </p>";
    }
}
function calcularCambio($divisa, $cantidad)
{
    $cambio = 166.386;
    $resultado = 0;


    if ($divisa === "euros") {
        $resultado = $cambio * $cantidad;
    } else if ($divisa === "pesetas") {
        $resultado = $cambio / $cantidad;
    }
    return "La conversión de $cantidad en $divisa son $resultado";
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="POST">
        <br>
        <br>
        <label>Cantidad:<input type="text" name="idCantidad" required></label>
        <br>
        <br>
        <label> <input type="radio" name="divisa" value="euros" required> De Euros a Pesetas</label>
        <br>
        <label><input type="radio" name="divisa" value="pesetas" required> De Pesetas a Euros</label>
        <br><br>

        <button type="submit">Calcula</button>
    </form>


</body>

</html>