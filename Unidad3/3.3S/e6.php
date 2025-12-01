<?php
session_start();

$multiplicandoAnterior = $_SESSION["multiplicando"] ?? "Aún no hay datos";
$multiplicadorAnterior = $_SESSION["multiplicador"] ?? "Aún no hay datos";
$productoAnterior = $_SESSION["producto"] ?? "Aún no hay datos";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $multiplicando = $_POST["multiplicando"];
    $multiplicador = $_POST["multiplicador"];

    if (is_numeric($multiplicando) && is_numeric($multiplicador)) {
        $producto = $multiplicando * $multiplicador;
        $_SESSION["multiplicando"] = $multiplicando;
        $_SESSION["multiplicador"] = $multiplicador;
        $_SESSION["producto"] = $producto;
    } else {
        echo "a";
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="titulo">
        <h2>Ejercicio 6 Tabla de multiplicar - Guillermina Fara </h2>
    </div>
    <form method="POST">
        <label>Ingresa un número para el multiplicando: <input type="text" name="multiplicando" required></label>
        <br><br>
        <label>Ingresa un número para el multiplicador: <input type="text" name="multiplicador" required></label> <br>
        <br>

        <button type="submit">enviar</button>
    </form>
    <!-- <h3></h3>
<p></p> -->

    <?php

    echo " <h3>Salida Actual</h3>";

    if (isset($multiplicando)) {
        echo "<p>$multiplicando x $multiplicador =$producto</p>";
    } else {
        echo "<p>Aún no hay datos almacenadas </p>";
    }


    echo " <h3>Salida Anterior</h3>";

    if (is_numeric($multiplicandoAnterior) && is_numeric($multiplicadorAnterior) && is_numeric($productoAnterior)) {

        if (isset($_SESSION["multiplicando"]) && isset($_SESSION["multiplicador"]) && isset($_SESSION["producto"])) {

            $multiplicandoAnterior = $_SESSION["multiplicando"];
            $multiplicadorAnterior = $_SESSION["multiplicador"];
            $productoAnterior = $_SESSION["producto"];

            echo "<p> $multiplicandoAnterior x $multiplicadorAnterior = $productoAnterior</p>";
        } else {
            echo "<p>Aún no hay datos almacenadas </p>";
        }
    }


    ?>
</body>


</html>