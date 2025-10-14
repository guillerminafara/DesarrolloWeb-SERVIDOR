<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function llenarMatriz()
    {
        $matriz = [];
        for ($m = 0; $m < 5; $m++) {

            for ($n = 0; $n < 5; $n++) {
                $matriz[$m][$n] = $m + $n;
            }
        }
        return $matriz;
    }
    function sumar($matriz)
    {
        $sumarColumna = [0, 0, 0, 0, 0];
        for ($i = 0; $i < 5; $i++) {
            $sumarFila = 0;
            for ($j = 0; $j < 5; $j++) {
                echo " " . $matriz[$i][$j] . " ". " ";
                echo ".";
                $sumarFila += $matriz[$i][$j];
                $sumarColumna[$j] += $matriz[$i][$j];
            }
            echo "= " . $sumarFila;
            echo "<br>";
        }

        for ($i = 0; $i < 5; $i++) {

            echo " = ";
        }
        echo "<br>";
        for ($j = 0; $j < 5; $j++) {
            echo  $sumarColumna[$j] . " ";
        }
    }
    $matriz = llenarMatriz();
    sumar($matriz);
    ?>
</body>

</html>