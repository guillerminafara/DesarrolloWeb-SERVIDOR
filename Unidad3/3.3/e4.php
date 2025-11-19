<?php
function quincena($dia)
{
    return ($dia <= 15) ? "Primera quincena" : "Segunda Quincena";
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dia = $_POST["dia"];
    if (is_numeric($dia) && $dia > 0 && $dia < 32) {
        $cookie_name = "dia";
        $cookie_value = $dia;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $cookie_name = "quincena";
        $cookie_value = quincena($dia);
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);
        echo "no mamme";
    }
}

function salida()
{

    $dia = $_COOKIE["dia"];
    $quincena = $_COOKIE["quincena"];
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
    <style>
        #mal {
            color: red;
        }

        * {
            font-family: sans-serif;
            margin: 10px;
        }
    </style>
</head>

<body>
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
        if (isset($_COOKIE["dia"]) && isset($_COOKIE["quincena"])) {
            salida();
        } else {
            echo "Aún no hay cookies almacenadas</p>";
        }
    }
    ?>
</body>

</html>