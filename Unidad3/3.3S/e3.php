<?php
session_start();
$n1Anterior = $_SESSION["primerNumero"] ?? "Aún no hay datos";
$n2Anterior = $_SESSION["segundoNumero"] ?? "Aún no hay datos";
$operacioinesAnteriores = $_SESSION["operacion"] ?? "Aún no hay datos";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $n1 = $_POST["primerNumero"];
    $n2 = $_POST["segundoNumero"];
    $operaciones = $_POST["operacion"];
    if (is_numeric($n1) && is_numeric($n2)) {
        $_SESSION["primerNumero"] = $n1;
        $_SESSION["segundoNumero"] = $n2;
        $_SESSION["operacion"] = $operaciones;
    }
}
function salidaAnterior($n1Anterior, $n2Anterior, $operacioinesAnteriores)
{
    // $n1Anterior = $_SESSION["primerNumero"];
    // $n2Anterior = $_SESSION["segundoNumero"];
    // $operacioinesAnteriores = $_SESSION["operacion"];
    echo "<p> Primer número: $n1Anterior</p>";
    echo "<p> Segundo Número $n2Anterior </p>";
    echo "<p> Operaciones: </p>";
    leerArray($operacioinesAnteriores);
    // $operacioinesAnteriores = explode(",", $operacioinesAnteriores);
    foreach ($operacioinesAnteriores as $a) {

        switch ($a) {
            case "Sumar":
                echo "<h3>sumando</h3>";

                echo "<p>" . sumar($n1Anterior, $n2Anterior) . "</p>";
                break;
            case "Restar":
                echo "<h3>Restando</h3>";
                echo "<p>" . restar($n1Anterior, $n2Anterior) . "</p>";
                break;
            case "Multiplicar":
                echo "<h3>Multiplicando</h3>";
                echo "<p>" . multiplicar($n1Anterior, $n2Anterior) . "</p>";

                break;
            case "Dividir":
                echo "<h3>Dividiendo</h3>";
                echo "<p>" . dividir($n1Anterior, $n2Anterior) . "</p>";
                break;
            default:
                echo "Entra al default";
                break;
        }
    }
}
function leerArray($lista)
{
    foreach ($lista as $elemento) {
        print $elemento;
        echo "  ";
    }
}
function salidaActual($n1, $n2, $operaciones)
{
    echo "<p> Primer número: $n1 </p>";
    echo "<p> Segundo Número $n2 </p>";
    echo "<p> Operaciones: </p>";
    leerArray($operaciones);

    foreach ($operaciones as $a) {
        switch ($a) {
            case "Sumar":
                echo "<h3>sumando</h3>";
                echo "<p>" . sumar($n1, $n2) . "</p>";

                break;
            case "Restar":
                echo "<h3>Restando</h3>";
                echo "<p>" . restar($n1, $n2) . "</p>";

                break;
            case "Multiplicar":
                echo "<h3>Multiplicando</h3>";
                echo "<p>" . multiplicar($n1, $n2) . "</p>";
                break;
            case "Dividir":
                echo "<h3>Dividiendo</h3>";
                echo "<p>" . dividir($n1, $n2) . "</p>";

                break;
            default:
                echo "Entra al default";
                break;
        }
    }
}
function sumar($n1, $n2)
{
    $suma = $n1 + $n2;
    return "$n1+ $n2 = $suma";
}
function restar($n1, $n2)
{
    $devolver = $n1 - $n2;
    return "$n1 - $n2 = $devolver";
}
function multiplicar($n1, $n2)
{
    $devolver = $n1 * $n2;
    return "$n1 X $n2 = $devolver";
}

function dividir($n1, $n2)
{
    if ($n2 === 0) {
        return "<p> No es posible dividir por 0 </p>";
    } else {
        $devolver = $n1 - $n2;
        return "$n1 - $n2 = $devolver";
    }
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
        <h2>Ejercicio 3 - Guillermina Fara </h2>
    </div>
    <form method="POST">
        <fieldset>
            <legend>Números a calcular</legend>
            <label> Qué operación deseas realizar? </label> <br>
            <select name="operacion[]" id="operacion" multiple required>
                <option value="Sumar">Sumar</option>
                <option value="Restar">Restar</option>
                <option value="Multiplicar">Multiplicar</option>
                <option value="Dividir">Dividir</option>

            </select><br><br>
            <label>1er Número <input type="text" name="primerNumero" required></label><br><br>
            <label>2do Número <input type="text" name="segundoNumero" required></label><br><br>
            <button>Enviar</button>
        </fieldset>
    </form>
    <?php
    echo "<h2>Resultados Actuales</h2>";

    if (isset($n1) && isset($n2) && isset($operaciones)) {
        if (is_numeric($n1) && is_numeric($n2)) {
            salidaActual($n1, $n2, $operaciones);
        }
    } else {
        echo "<p>Aún no hay valores almacenados </p>";
    }
    echo "<h2>Resultados Anteriores</h2>";

    if (is_numeric($n1Anterior) && is_numeric($n2Anterior)) {

        if (isset($_SESSION["primerNumero"]) && isset($_SESSION["segundoNumero"]) && isset($_SESSION["operacion"])) {


            salidaAnterior($n1Anterior, $n2Anterior, $operacioinesAnteriores);
        } else {
            echo "<p>Aún no hay valores almacenados </p>";
        }
    } else {
        echo "<p>DAtos inconrrectis </p>";
    }
    ?>
</body>

</html>