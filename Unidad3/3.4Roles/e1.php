<?php
session_start();
$rol = $_SESSION["rol"];
switch ($rol) {
    case "Sindicalista":
        $location="Location:salidaSindicalista.php";
        break;
    case "Gerente":
        $location="Location:salidaGerente.php";

        break;
    case "Responsble de Nóminas":
         $location="Location:salidaResponsable.php";
        break;
    default:
        break;
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <label>email:<input type="text" placeholder="ejemplo@mail.com"></label><br>
        <label>constraseña:<input type="text"></label><br>
        <label ><input type="radio"name="roles" value="Sindicalista">Sindicalista</label>
        <label ><input type="radio"name="roles" value="Responsable">Responsable de Nóminas</label>
        <label ><input type="radio"name="roles" value="Gerente">Gerente</label>


        <button>Iniciar Sesión</button><br>
    </form>
</body>

</html>