<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $dia = $_POST["dia"];
    if (isset($dia) && is_numeric($dia) && $dia > 0 && $dia < 32) {
        $_SESSION["dia"] = $dia;
        $_SESSION["quincena"] = quincena($dia);
    }
}

function salida()
{
    $dia = $_SESSION["dia"];
    $quincena = $_SESSION["quincena"];
    echo "<p> Día: $dia. Se encuentra en la  $quincena </p>";
    echo "<p> </p>";
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
    <div id="titulo">
        <h2>Ejercicio 4 - Guillermina Fara </h2>
    </div>

    <form method="POST">
        <h2>Calcular semana del mes</h2>
        <label>Ingresa el dia: <input type="text" name="dia" required></label>
        <button type="submit"> Calcular </button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $dia = $_POST["dia"];
        if (is_numeric($dia) && $dia > 0 && $dia < 32) {
            echo "<h3>Salida Actual: </h3>";

            if (isset($dia)) {
                $quincena = quincena($dia);
                echo " <p>El dia $dia se encuentra en la $quincena</p>";
            } else {
                echo "<p>Aún no hay valores almacenados </p>";
            }
        } else {
            echo "<p id='mal'>Datos incorrectos, ingresa números entre 1 y 31</p>";
        }
        echo "<h3>Salida Anterior: </h3>";
        if (isset($_SESSION["dia"]) && isset($_SESSION["quincena"])) {

            salida();
        } else {
            echo "Aún no hay sessiones almacenadas</p>";
        }
    }
    function quincena($dia)
    {
        return ($dia <= 15) ? "Primera quincena" : "Segunda Quincena";
    }
    session_destroy();c

    ?>
</body>

</html>