<?php
session_start();
$numerosAnteriores = $_SESSION["numeros"] ?? null;
$operaciones = $_SESSION["operaciones"] ?? null;
$resultadosAnteriores = $_SESSION["resultado"] ?? null;
$resultado = [];
// $listaNumerosAnteriores = explode(",", $numeros);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeros = trim($_POST["numeros"]);
    $operaciones = $_POST["operaciones"] ?? [];
    $resultado = [];
    $listaNumeros = explode(",", $numeros);

    $seleccion = implode(",", $operaciones);
    $largo = count($listaNumeros);

    foreach ($operaciones as $modo) {

        switch ($modo) {
            case "Media":
                $media = array_sum($listaNumeros) / $largo;
                $resultado[] = "Media: $media";
                break;
            case "Mediana":
                $mediana = 0;
                sort($listaNumeros);
                if ($largo % 2 === 0) {
                    $mediana = ($listaNumeros[$largo / 2 - 1] + $listaNumeros[$largo / 2]) / 2;
                } else {
                    $mediana = $listaNumeros[floor($largo / 2)];
                }
                $resultado[] = "Mediana: $mediana";
                break;
            case "Moda":
                $moda = "";
                $maximo = 0;
                $cont = 0;
                for ($i = 0; $i < $largo; $i++) {
                    for ($j = 0; $j < $largo; $j++) {
                        if ($listaNumeros[$i] === $listaNumeros[$j]) {
                            $cont++;
                        }
                    }
                    if ($cont > $maximo) {
                        $maximo = $cont;
                        $moda = $listaNumeros[$i];
                    }
                }
                $resultado[] = "Moda: $moda";

                break;
            default:
                echo "default";
                break;
        }
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
        <h2>Ejercicio 6 Tabla de multiplicar - Guillermina Fara </h2>
    </div>
    <form method="POST">
        <label>Ingresa varios numeros separados por comas (,): <input name="numeros" required></label><br><br>
        <label><input type="checkbox" name="operaciones[]" value="Media">Media</label><br>
        <label><input type="checkbox" name="operaciones[]" value="Mediana">Mediana</label><br>
        <label><input type="checkbox" name="operaciones[]" value="Moda">Moda</label><br><br>
        <button type="submit">Enviar </button>
    </form>

    <?php



    echo "<h3>Resultado Actual: </h3>";
    if (isset($resultado) && isset($numeros) && isset($seleccion)) {
        $resultadoSeparado = implode(",", $resultado);
        echo "<p>Numeros ingresados: $numeros oepraciones seleccionados  $seleccion, Resultados: $resultadoSeparado</p>";
    } else {
        echo "Aún no hay datos";
    }


    echo "<h3>Resultado Anterior</h3>";

    if (isset($_SESSION["numeros"]) && isset($_SESSION["operaciones"]) && isset($_SESSION["resultado"])) {
        $numerosAnteriores = $_SESSION["numeros"];
        $operacionesAnteriores = $_SESSION["operaciones"];
        $resultadosAnteriores = $_SESSION["resultado"];
        $salida = implode(",", $operacionesAnteriores);
        $salida2 = implode(",", $resultadosAnteriores);

        echo "<p>Numeros ingresados: $numerosAnteriores oepraciones seleccionados $salida REsultados: $salida2</p>";
    } else {
        echo "<p>Aún no hay datos almacenadas </p>";
    }

    $_SESSION["numeros"] = $numeros ?? null;
    $_SESSION["operaciones"] = $operaciones ?? null;
    $_SESSION["resultado"] = $resultado ?? null;

    ?>
</body>

</html>