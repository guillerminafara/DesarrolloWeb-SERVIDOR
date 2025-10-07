<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function calculadorPotencias($base, $exponente)
    {
        $resultados = [];
        $suma = 0;

        for ($i = 1; $i <= $exponente; $i++) {
            $potencia = pow($base, $i);
            $resultados[] = $potencia;
            $suma += $potencia;
            echo "$base ^ $i = $potencia";
            echo "<br>";
        }
        echo "Suma de todas las potencias: $suma ";
        echo "<br>";
        return $resultados;
    }
    $base = 3;
    $exponente = 5;

    calculadorPotencias($base, $exponente);
    ?>
    <p>prueba</p>
</body>

</html>