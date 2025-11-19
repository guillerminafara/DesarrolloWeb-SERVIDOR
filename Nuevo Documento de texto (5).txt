<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $zona = $_POST["zona"] ?? "";

        date_default_timezone_set($zona);

        $hora_actual = date("H:i:s");

        setcookie("zona_anterior", $zona, time() + 3600);
        setcookie("hora_anterior", $hora_actual, time() + 3600);

        $zona_anterior = $_COOKIE["zona_anterior"] ?? "No guardada";
        $hora_anterior = $_COOKIE["hora_anterior"] ?? "No guardada";

        echo "<h3>Ejecución actual:</h3>";
        echo "Zona horaria: <strong>{$zona}</strong><br>";
        echo "Hora actual: <strong>{$hora_actual}</strong><br>";

        echo "<h3>Ejecución anterior:</h3>";
        echo "Zona guardada: <strong>{$zona_anterior}</strong><br>";
        echo "Hora guardada: <strong>{$hora_anterior}</strong><br>";
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lucía Ferrandis Martínez</title>
    </head>
    <body>

        <h2>Lucía Ferrandis Martínez</h2>
        <hr>
        <h1>Zona Horaria</h1>

        <form method="POST">
            <label>Elige una zona horaria:</label><br>
            <select name="zona" required>
                <option value="Europe/Madrid">Europa / Madrid</option>
                <option value="Europe/London">Europa / Londres</option>
                <option value="America/New_York">América / Nueva York</option>
                <option value="America/Mexico_City">América / México</option>
                <option value="Asia/Tokyo">Asia / Tokio</option>
            </select><br><br>

            <input type="submit" value="Ver hora">
        </form>
    </body>
</html>