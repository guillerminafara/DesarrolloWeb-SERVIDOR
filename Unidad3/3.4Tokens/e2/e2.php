<?php
session_start();
require_once "comprobaciones.php";
// creo un token en caso de que no haya ninguno creado
if (!isset($_SESSION["token"])) {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
}
//funcion para cambiar el token actual por otro
if (isset($_POST["cambiar"])) {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
    // echo "<p>Token de sesión regenerado. Prueba a enviar el formulario ahora</p>";
}
//
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST["cambiar"])) {
    //si no hay tokens activos
    if (!isset($_POST["token"])) {
        // echo "<p>No hay token activos</p>";
    } else if (!hash_equals($_SESSION["token"], $_POST["token"])) {
        //salida para tokens que no coinciden 
        // echo "<p id='mal'>No hay token activos</p>";
    } else {
        //salida para tokens que si coinciden y que no presenta variables vacias
        if (isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["asignatura"]) && isset($_POST["mayor_de_edad"])) {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $asignatura = $_POST["asignatura"];
            $grupo = $_POST["grupo"];
            $mayor_de_edad = $_POST["mayor_de_edad"];
            $cargo = $_POST["cargo"] ?? null;
            if (ctype_alpha($nombre) && ctype_alpha($apellido) && ctype_alpha($asignatura) && isset($cargo) && isset($mayor_de_edad)) {
                $_SESSION["nombre"] = $nombre;
                $_SESSION["apellido"] = $apellido;
                $_SESSION["asignatura"] = $asignatura;
                $_SESSION["grupo"] = $grupo;
                $_SESSION["mayor_de_edad"] = $mayor_de_edad;
                $_SESSION["cargo"] = $cargo;
                switch ($grupo) {
                    case "Estudiante":
                        $location = "Location: salidaEstudiante.php";
                        break;
                    case "Delegado":
                        $location = "Location: salidaDelegado.php";
                        break;
                    case "Profesor":
                        $location = "Location: salidaProfesor.php";
                        break;
                    case "Director":
                        $location = "Location: salidaDirector.php";
                        break;
                    default:
                        $location = "Location: e2.php";
                        // echo "Encontrando el error";

                        break;
                }
                // sleep(2);
                header($location);
                exit;
            } else {
                // echo "<p>Nombre y apellido deben ser solo letras</p>";
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
    <title>Ejercicio Tokens 2 Guillermina</title>
</head>

<body>
    <h2>Ejercicio Tokens 2- Guillermina Fara</h2>
    <form method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label><br><br>
        <label for="">Apellido: <input type="text" name="apellido" required></label><br><br>
        <label for="">Asignatura: <input type="text" name="asignatura" required></label><br><br>
        <label for="">Grupo: <select type="combo" name="grupo" required><br><br>
                <option value="Estudiante">Estudiante</option>
                <option value="Delegado">Delegado</option>
                <option value="Profesor">Profesor</option>
                <option value="Director">Director</option>

            </select></label><br><br>
        <label for="">¿Eres mayor de edad?</label><br><br>
        <label for="radioMayor"><input id="radioMayor" type="radio" name="mayor_de_edad" value=true
                required>Sí</label><br><br>
        <label for="radioMayor"><input id="radioMayor" type="radio" name="mayor_de_edad" value=false
                required>No</label><br><br>

        <label for="">¿Cuentas con algún cargo?</label><br><br>

        <label for="cargo"><input id="cargo" type="radio" name="cargo" value=true required>Sí</label><br><br>
        <label for="cargo"><input id="cargo" type="radio" name="cargo" value=false required>No</label><br><br>
        <input type="hidden" name="token" value="<?= $_SESSION["token"]?>">
        <button type="submit">Cargar tabla</button><br> <br>
        <button type="submit" name="cambiar"> Cambiar la SID</button>
    </form>
</body>

</html>