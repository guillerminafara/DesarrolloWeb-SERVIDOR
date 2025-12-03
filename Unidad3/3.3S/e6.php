<?php
session_start();

$multiplicandoAnterior = $_SESSION["multiplicando"] ?? null;
$multiplicadorAnterior = $_SESSION["multiplicador"] ?? null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $multiplicando = $_POST["multiplicando"];
    $multiplicador = 1;
 

    $_SESSION["multiplicando"] = $multiplicando;
    $_SESSION["multiplicador"] = $multiplicador;
}
function calcular($multiplicando, $multiplicador)
{
    $salida = "<p>Multiplicando:$multiplicando</p>";
    for ($i = 1; $i <= 10; $i++) {
        $multiplicador = $i;
        // echo"<br>";
        $salida .= "<br> $multiplicando x $multiplicador =" . ($multiplicando * $multiplicador);
    }

    return $salida;
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
        <h2>Ejercicio 6 Tabla de multiplicar - Guillermina Fara </h2>
    </div>
    <form method="POST">
        <label>Ingresa un número para el multiplicando: <input type="text" name="multiplicando" required></label>
        <br><br>
        <!-- <label>Ingresa un número para el multiplicador: <input type="text" name="multiplicador" required></label> <br>
        <br> -->

        <button type="submit">enviar</button>
    </form>

    <?php
   echo "<h3> Salida Actual</h3>";
    if (isset($multiplicador) && isset($multiplicando)) {
        echo calcular($multiplicando, $multiplicador);
    } else {
        echo "Aún no hay datos almacenados";
    }

    echo "<h3> Salida Anterior</h3>";

    if ($multiplicadorAnterior !== null && $multiplicandoAnterior !== null) {
        echo calcular($multiplicandoAnterior, $multiplicadorAnterior);
    } else {
        echo "Aún no hay datos almacenados";
    }


    ?>

</body>


</html>