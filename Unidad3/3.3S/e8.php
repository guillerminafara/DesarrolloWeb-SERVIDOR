<?php
session_start();
$zonaAnterior = $_SESSION["zonaHoraria"] ?? null;
$horaAnterior = $_SESSION["hora"] ?? null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $zonaActual = $_POST["zonaHoraria"];
    date_default_timezone_set($zonaActual);
    $horaActual = date("H:i:s");
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

    <h2>Ejercicio 8 sessions zona horaria - Guillermina Fara </h2>
    <form method="POST">
        <label>Elige zona horaria: </label>
        <select name="zonaHoraria" id="zonaHoraria" required>
            <option value="Europe/Madrid">Madrid (GMT+1)</option>
            <option value="America/Argentina/Buenos_Aires">Argentina (GMT-3)</option>
            <option value="Asia/Tokyo">Japon(GMT+9)</option>
            <option value="Africa/Johannesburg">Sudafrica (GMT+2)</option>

        </select><br><br>
        <button type="submit">Enviar</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {


        echo "<h3>Ejecución Actual:</h3>";
        echo "<p>Zona Horaria: $zonaActual </p>";
        echo "<p>Hora: $horaActual </p>";

        echo "<h3>Ejecución Anterior:</h3>";
        if (isset($_SESSION["hora"]) && isset($_SESSION["zonaHoraria"])) {
            $zonaAnterior = $_SESSION["zonaHoraria"];
            $horaAnterior = $_SESSION["hora"];
            echo "<p>Zona Horaria: $zonaAnterior </p>";
            echo "<p>Hora: $horaAnterior </p>";
        } else {
            echo "<p>Aún no hay datos almacenadas </p>";
        }

        $_SESSION["zonaHoraria"] = $zonaActual;
        $_SESSION["hora"] = $horaActual;
    }
    ?>
</body>

</html>