<?php
session_start();
require_once "../comprobaciones.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $asignatura = $_POST["asignatura"];
    $grupo = $_POST["grupo"];
    $mayor_de_edad = $_POST["mayor_de_edad"];
    $cargo = $_POST["cargo"] ?? null;
    if (ctype_alpha($nombre) && ctype_alpha($apellido) && ctype_alpha($asignatura) && isset($cargo)&& isset($mayor_de_edad)) {
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
                break;
        }
        header($location);
        exit;
    } else {
        echo "Error en linea 21";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 Guillermina</title>
</head>

<body>
    <h2>Ejercicio 2- Guillermina Fara</h2>
    <form action="" method="POST">
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
        <label for="radioMayor"><input id="radioMayor" type="radio" name="mayor_de_edad" value=true required>Sí</label><br><br>
        <label for="radioMayor"><input id="radioMayor" type="radio" name="mayor_de_edad" value=false required>No</label><br><br>

        <label for="">¿Cuentas con algún cargo?</label><br><br>

        <label for="cargo"><input id="cargo" type="radio" name="cargo" value=true required>Sí</label><br><br>
        <label for="cargo"><input id="cargo" type="radio" name="cargo" value=false required>No</label><br><br>
        <button>Cargar tabla</button><br> <br>
    </form>
</body>

</html>