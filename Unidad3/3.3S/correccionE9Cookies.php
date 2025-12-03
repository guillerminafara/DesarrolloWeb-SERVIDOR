<?php

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
    $cookie_name = "numeros";
    $cookie_value = $numeros;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

    $cookie_name = "operaciones";
    $cookie_value = $seleccion;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

    $cookie_name = "resultado";
    $cookie_value = $resultado;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, implode(",", $resultado), $cookie_expires, $cookie_path);
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
    if ($_SERVER["REQUEST_METHOD"] === "POST") {


        echo "<h3>Resultado Actual: </h3>";
        if (isset($resultado) && isset($numeros) && isset($seleccion)) {
            $resultadoSeparado = implode(",", $resultado);
            echo "<p>Numeros ingresados: $numeros oepraciones seleccionados  $seleccion, Resultados: $resultadoSeparado</p>";
        } else {
            echo "Aún no hay datos";
        }


        echo "<h3>Resultado Anterior</h3>";

        if (isset($_COOKIE["numeros"]) && isset($_COOKIE["operaciones"])) {
            $numerosAnteriores = $_COOKIE["numeros"];
            $operacionesAnteriores = $_COOKIE["operaciones"];
            $resultadosAnteriores = $_COOKIE["resultado"];
            echo "<p>Numeros ingresados: $numerosAnteriores oepraciones seleccionados  $operacionesAnteriores REsultados: $resultadosAnteriores</p>";
        } else {
            echo "<p>Aún no hay cookies almacenadas </p>";
        }
    }

    ?>
</body>

</html>