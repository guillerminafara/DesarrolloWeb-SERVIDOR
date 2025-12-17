<?php
session_start();
if ($_SERVER("REQUEST_METHOD") === "POST") {
    $nombre= $_POST["nombre"];
    $apellido=$_POST["apellido"];
    $asignatura=$_POST["asignatura"];
    $grupo= $_POST["grupo"];
    $mayor_de_edad=$_POST["mayor_de_edad"];
    $cargo= $_POST["cargo"];
    if(ctype_alpha($nombre)&& ctype_alpha($apellido)&& ctype_alpha($asignatura)){
        $_SESSION["nombre"]= $nombre;
        $_SESSION["apellido"]= $apellido;
        $_SESSION["asignatura"]= $asignatura;
        $_SESSION["grupo"]= $grupo;
        $_SESSION["mayor_de_edad"]=$mayor_de_edad;
        $_SESSION["cargo"]= $cargo;
        header("Location: salida.php");
        exit;
        
    }


}

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <label>Nombre: <input type="text" name="nombre" required></label>
    <label for="">Apellido: <input type="text" name="apellido" required></label>
    <label for="">Asignatura: <input type="text" name="asignatura" required></label>
    <label for="">Grupo: <select type="combo" name="grupo" required>
        <option value="Estudiante">Estudiante</option>
        <option value="Delegado">Delegado</option>
        <option value="Profesor">Profesor</option>
        <option value="Director">Director</option>

        </select></label>
    <label for="">¿Eres mayor de edad?</label>
    <input type="radio" name="mayor_de_edad" value="Sí" required><br>
    <input type="radio" name="mayor_de_edad" value="No"required><br>

    <input type="radio" name="cargo" value="Sí" required><br>
    <input type="radio" name="cargo" value="No" required><br>

</body>

</html>