<?php
$nombre = $_GET["nombre"] ?? "";
$apellido = $_GET["apellido"] ?? "";
$peso = $_GET["peso"] ?? "";
$sexo = $_GET["sexo"] ?? "";
$estadoCivil = $_GET["estadoCivil"] ?? "";
$aficiones = $_GET["aficiones"] ?? "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
</head>

<body>
    <p>hola</p>
    <p>Nombre: <?= htmlentities($nombre) ?></p>
    <p>Apellido: <?= htmlentities($apellido) ?></p>
    <p>Peso: <?= htmlentities($peso) ?></p>
    <p>Sexo: <?= htmlentities($edad) ?></p>
    <p>Estado civil:<?= htmlentities($estadoCivil) ?></p>
    <p>aficiones: <?= htmlentities($aficiones) ?></p>
</body>

</html>