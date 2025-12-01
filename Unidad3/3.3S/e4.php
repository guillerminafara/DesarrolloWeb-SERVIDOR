<?php
session_start();
$diaAnterior = $_SESSION["dia"] ?? "Aún no hay datos almacenados";
$quincenaAnterior = $_SESSION["quincena"]?? "Aún no hay datos almacenados";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dia = $_POST["dia"];

    if (is_numeric($dia) && $dia > 0 && $dia < 32) {
        $_SESSION["dia"] = $dia;
        $_SESSION["quincena"] = quincena($dia);
    }

}
function quincena($dia)
{

    return ($dia <= 15) ? "Primera quincena" : "Segunda Quincena";
}

function salida($dia, $quincena)
{

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
    <h3></h3>
    <?php
    echo "<h3>Salida Actual:</h3>";
    if (isset($dia)) {
        if (is_numeric($dia) && $dia > 0 && $dia < 32) {
            salida($dia, quincena($dia));

        } else {
            echo "<p id='mal'>Datos incorrectos, ingresa números entre 1 y 31</p>";
        }
    } else {
        echo "<p>Aún no hay datos almacenados </p>";

    }


    echo "<h3>Salida Anterior:</h3>";

    if (isset($_SESSION["dia"])) {
        salida($diaAnterior, quincena($diaAnterior));

    } else {
        echo "<p>Aún no hay datos almacenados </p>";
    }
    ?>
</body>

</html>