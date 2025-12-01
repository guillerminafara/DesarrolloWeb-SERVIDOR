<?php
session_start();
$cantidadAnterior = intval($_SESSION["idCantidad"] ?? 0);
$divisaAnterior = $_SESSION["divisa"] ?? "Aún no hay datos almacenados";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cantidad = $_POST["idCantidad"];
    $divisa = $_POST["divisa"];

    if (is_numeric($cantidad) && is_numeric($divisa)) {
        $_SESSION["idCantidad"] = $cantidad;
        $_SESSION["divisa"] = $divisa;
    } else {
    }

    echo "<h3>Salida Actual:</h3>";
    if (isset($cantidad) && isset($divisa)) {
        echo calcularCambio($divisa, $cantidad);
    } else {
        echo "<p>Aún no hay datos almacenados </p>";
    }
    echo "<h3>Salida Anterior:</h3>";
    if (isset($cantidadAnterior) && isset($divisaAnterior)) {
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
}
