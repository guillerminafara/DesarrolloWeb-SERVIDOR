<?php
session_start();
if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
}
if (isset($_POST["cambiar"])) {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
    echo "<p>Token de sesión regenerado. Prueba a enviar el formulario ahora</p>";
}
$trabajadores = [
    "Pepito" => 1000,
    "Paquito" => 1200,
    "Beto" => 1400,
    "Cachito" => 2000,
    "Manolito" => 600,
];

if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["cambiar"])) {
    if (!isset($_POST["token"])) {
        echo "<p> No hay tokens diponible</p>";
    } else if (!hash_equals($_SESSION["token"], $_POST["token"])) {
        echo "<p> Token no coincide </p>";
    } else {
        if (isset($_POST["nombre"]) && isset($_POST["roles"])) {
            $nombre = $_POST["nombre"];
            $rol = $_POST["roles"];

            if (ctype_alpha($nombre)) {
                $_SESSION["trabajadores"] = $trabajadores;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = $rol;
                $rolSession = $_SESSION["rol"];
                $location = "";
                switch ($rolSession) {
                    case "Sindicalista":
                        $location = "Location:salidaSindicalista.php";
                        break;
                    case "Gerente":
                        $location = "Location: salidaGerente.php";
                        break;
                    case "Responsable de Nóminas":
                        $location = "Location: salidaResponsable.php";
                        break;
                    default:
                        header("Location: e1.php");
                        break;
                }
                header($location);
                exit;
            } else {
                echo "<p>El nombre solo puede contener letras</p>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E1 Tokens Guillermina</title>
</head>

<body>
    <h2> Formulario Roles y Permisos - Guillermina Fara</h2>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"]; ?>">
        <label>nombre: <input type="text" name="nombre" placeholder="ejemplo guillermina"></label><br><br>
        <h3>Perfil:</h3>
        <label><input type="radio" name="roles" value="Sindicalista" required>Sindicalista</label><br>
        <label><input type="radio" name="roles" value="Responsable de Nóminas">Responsable de Nóminas</label><br>
        <label><input type="radio" name="roles" value="Gerente">Gerente</label><br><br>

        <button type="submit">Iniciar Sesión</button>
        <button name="cambiar"> Cambiar la SID</button>

    </form>

</body>

</html>