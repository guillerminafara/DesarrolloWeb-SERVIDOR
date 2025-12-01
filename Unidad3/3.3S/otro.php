<?php
session_start();

// Inicializar variables para evitar warnings
$multiplicando = "";
$multiplicador = "";
$producto = "";

// Guardamos valores anteriores (si existen)
$multiplicandoAnterior = isset($_SESSION["multiplicando"]) ? $_SESSION["multiplicando"] : "";
$multiplicadorAnterior = isset($_SESSION["multiplicador"]) ? $_SESSION["multiplicador"] : "";
$productoAnterior = isset($_SESSION["producto"]) ? $_SESSION["producto"] : "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $multiplicando = $_POST["multiplicando"];
    $multiplicador = $_POST["multiplicador"];
    $producto = $multiplicando * $multiplicador;

    if (is_numeric($multiplicando) && is_numeric($multiplicador)) {
        $_SESSION["multiplicando"] = $multiplicando;
        $_SESSION["multiplicador"] = $multiplicador;
        $_SESSION["producto"] = $producto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="titulo">
        <h2>Ejercicio 6 Tabla de multiplicar - Guillermina Fara</h2>
    </div>

    <form method="POST">
        <label>Ingresa un número para el multiplicando:
            <input type="text" name="multiplicando" required>
        </label><br><br>

        <label>Ingresa un número para el multiplicador:
            <input type="text" name="multiplicador" required>
        </label><br><br>

        <button type="submit">Enviar</button>
    </form>

    <!-- Salida Actual -->
    <h3>Salida Actual</h3>
    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") : ?>
        <p><?= $multiplicando ?> x <?= $multiplicador ?> = <?= $producto ?></p>
    <?php else : ?>
        <p>Aún no se ha ingresado una operación.</p>
    <?php endif; ?>

    <!-- Salida Anterior -->
    <h3>Salida Anterior</h3>
    <?php if ($multiplicandoAnterior !== "") : ?>
        <p><?= $multiplicandoAnterior ?> x <?= $multiplicadorAnterior ?> = <?= $productoAnterior ?></p>
    <?php else : ?>
        <p>Aún no hay datos almacenados.</p>
    <?php endif; ?>

</body>
</html>
