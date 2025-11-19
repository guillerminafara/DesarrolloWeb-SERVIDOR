<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $multiplicando = $_POST["multiplicando"];
    $multiplicador = $_POST["multiplicador"];
    $producto = $multiplicando * $multiplicador;
    if (is_numeric($multiplicando) && is_numeric($multiplicador)) {
        $cookie_value = $multiplicando;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie("multiplicando", $cookie_value, $cookie_expires, $cookie_path);
    }
    if (is_numeric($multiplicador) && is_numeric($multiplicador)) {
        $cookie_value = $multiplicador;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie("multiplicador", $cookie_value, $cookie_expires, $cookie_path);
    }

    if (is_numeric($producto) && is_numeric($producto)) {
        $cookie_value = $producto;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie("producto", $cookie_value, $cookie_expires, $cookie_path);
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
        <label>Ingresa un número para el multiplicando: <input type="text" name="multiplicando"></label> <br><br>
        <label>Ingresa un número para el multiplicador: <input type="text" name="multiplicador"></label> <br> <br>

        <button type="submit">enviar</button>
    </form>
    <!-- <h3></h3>
<p></p> -->

    <?php

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo " <h3>Salida Actual</h3>";
        echo "<p>$multiplicando x $multiplicador =$producto</p>";
        echo " <h3>Salida Anterior</h3>";
        if (isset($_COOKIE["multiplicando"]) && isset($_COOKIE["multiplicador"]) && isset($_COOKIE["producto"])) {
            $multiplicandoAnterior = $_COOKIE["multiplicando"];
            $multiplicadorAnterior = $_COOKIE["multiplicador"];
            $productoAnterior = $_COOKIE["producto"];

            echo "<p> $multiplicandoAnterior x $multiplicadorAnterior = $productoAnterior</p>";
        } else {
            echo "<p>Aún no hay cookies almacenadas </p>";
        }

    }

    ?>
</body>


</html>