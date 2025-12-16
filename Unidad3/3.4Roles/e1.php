<?php
session_start();
$rolSession = $_SESSION["rol"] ?? null;
$nombreSession = $_SESSION["nombre"] ?? null;
$trabajadoresSession = $_SESSION["trabajadores"] ?? [];
$trabajadores = [
    "Pepito" => 1000,
    "Paquito" => 1200,
    "Beto" => 1400,
    "Cachito" => 2000,
    "Manolito" => 600,
];


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nombre"]) && isset($_POST["roles"])) {
        $nombre = $_POST["nombre"];
        $rol = $_POST["roles"];
        $_SESSION["trabajadores"] = $trabajadores;
        $_SESSION["nombre"] = $nombre;
        $_SESSION["rol"] = $rol;

        $location = "";
        switch ($rolSession) {
            case "Sindicalista":
                $location = "Location:salidaSindicalista.php";
                break;
            case "Gerente":
                // $location = "Location: salidaGerente.php";
                header("Location: salidaGerente.php");
                exit;
            case "Responsble de Nóminas":
                $location = "Location:salidaResponsable.php";
                break;
            default:
                header("Location: e1.php");
                break;
        }
        header($location);
        exit;
    } else {
        echo "salida Erronea en e1";
    }
} else {
    echo "salida Erronea en e1 2";
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
    <h2> Formulario Roles y Permisos - Guillermina Fara</h2>
    <form method="POST">
        <label>nombre: <input type="text" name="nombre" placeholder="ejemplo guillermina"></label><br><br>
        <h3>Perfil:</h3>
        <label><input type="radio" name="roles" value="Sindicalista">Sindicalista</label><br>
        <label><input type="radio" name="roles" value="Responsable de Nóminas">Responsable de Nóminas</label><br>
        <label><input type="radio" name="roles" value="Gerente">Gerente</label><br><br>


        <button type="submit">Iniciar Sesión</button><br>
    </form>
</body>

</html>