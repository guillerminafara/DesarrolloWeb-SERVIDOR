<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $tamanyo = 5;
    function llenarMatriz($tamanyo)
    {
        $matriz = [];
        for ($i = 0; $i < $tamanyo; $i++) {

            for ($j = 0; $j < $tamanyo; $j++) {
                $matriz[$i][$j] =  rand(1, 9);
                // $matriz[$i][$j] = $i;
            }
        }
        return $matriz;
    }
    function llenarMatriz2($tamanyo)
    {
        $matriz2 = [];
        for ($i = 0; $i < $tamanyo; $i++) {
            for ($j = 0; $j < $tamanyo; $j++) {
                $matriz2[$i][$j] = rand(1, 9);
                // $matriz2[$i][$j] = $j;
            }
        }
        return $matriz2;
    }
    function leerMatriz($matriz)
    {
        $tamanyo = count($matriz);
        for ($i = 0; $i <  $tamanyo; $i++) {
            for ($j = 0; $j < $tamanyo; $j++) {
                echo " " . $matriz[$i][$j] . " ";
            }
            echo "<br>";
        }
    }

    function operarMatriz($matriz, $matriz2, $opcion)
    {
        $salida = [];

        for ($i = 0; $i < 5; $i++) {
            for ($j = 0; $j < 5; $j++) {
                switch ($opcion) {
                    case 's':
                        $salida[$i][$j] = $matriz[$i][$j] + $matriz2[$i][$j];
                        break;

                    case 'r':
                        $salida[$i][$j] = $matriz[$i][$j] - $matriz2[$i][$j];
                        break;
                    case 'm':
                        $salida[$i][$j] = $matriz[$i][$j] * $matriz2[$i][$j];
                        break;
                    case 'd':
                        $salida[$i][$j] = round($matriz[$i][$j] / $matriz2[$i][$j], 1);
                        break;

                    default:
                        echo "Opción no válida :p";
                        break;
                }
            }
        }
        leerMatriz($salida);
    }
    $matriz = llenarMatriz($tamanyo);
    leerMatriz($matriz);
    $matriz2 = llenarMatriz2($tamanyo);
    echo "<br>";
    leerMatriz($matriz2);
    echo "<br>";
    $opcion = ["s", "r", "m", "d"];
    $opcion = "d";
    operarMatriz($matriz, $matriz2, $opcion);

    ?>
</body>

</html>