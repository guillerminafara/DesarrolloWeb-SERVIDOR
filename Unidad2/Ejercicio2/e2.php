<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function permutaciones($v)
    {
        $cant = count($v);
        echo "Cadena original: " . implode(", ", $v);
        echo "<br>";
        if ($cant % 2 == 0) {
            for ($i = 0; $i < $cant / 2; $i++) {
                $primero = $v[$i];
                $ultimo = $v[$cant - ($i + 1)];
                $v[$i] = $ultimo;
                $v[$cant - ($i + 1)] = $primero;
                // echo "$ultimo";
                // echo "<br>";
                // echo $primero;
                // echo "<br>";
            }
        } else {
            for ($i = 0; $i < floor($cant / 2); $i++) {
                $primero = $v[$i];
                $ultimo = $v[$cant - ($i + 1)];
                $v[$i] = $ultimo;
                $v[$cant - ($i + 1)] = $primero;
            }
        }
        echo "Cadena permutada: " . implode(", ", $v);
    }
    $v = [1, 2, 3, 4, 5];
    permutaciones($v);
    ?>
</body>

</html>