<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeros = $_POST["numeros"];
    $calcular = $_POST["calcular"];
    $resultado = $_POST["resultado"];
    $listaNumeros = explode(",", $numero);

    $cookie_name = "numeros";
    $cookie_value = $numeros;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

    $cookie_name = "calcular";
    $cookie_value = $calcular;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

    $cookie_name = "resultado";
    $cookie_value = $resultado;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

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
        <label>Ingresa varios numeros: <input name="numeros" required></label><br><br>
        <label><input type="checkbox" name="calcular[]">Media</label><br>
        <label><input type="checkbox" name="calcular[]">Mediana</label><br>
        <label><input type="checkbox" name="calcular[]">Modo</label><br><br>
        <button type="submit">Enviar </button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $largo = count($listaNumeros);

        foreach ($calcular as $modo) {

            switch ($modo) {
                case "Media":
                    $media = array_sum($listaNumeros) / $largo;
                    $resultado[] = $media;
                    break;
                case "Mediana":
                    $mediana = 0;
                    sort($listaNumeros);
                    if ($largo % 2 === 0) {
                        $mediana = ($listaNumeros[$largo / 2 - 1] + $listaNumeros[$largo / 2]) / 2;
                    } else {
                        $mediana = $listaNumeros[floor($largo / 2)];
                    }
                    $resultado[] = $mediana;
                    break;
                case "Moda":
                    $moda = "";
                    $maximo = 0;
                    $cont = 0;
                    for ($i = 0; $i < $largo; $i++) {
                        for ($j = 0; $j < $largo; $j++) {
                            if($listaNumeros[$i]===$listaNumeros[$j]){
                               $cont++; 
                            }
                        }

                        if ($contador > $maximo) {
                            $maximo = $cont;
                            $moda = $listaNumeros[$i];
                        }
                        $resultado[]="Moda: $moda";
                    }
                    break;
                default:
                    #
                    break;
            }

        }
    }
    ?>
</body>

</html>