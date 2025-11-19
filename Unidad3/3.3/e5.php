<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="POST">
        <br>
        <br>
        <label>Cantidad:<input type="text" name="idCantidad" required></label>
        <br>
        <br>
        <label> <input type="radio" name="divisa" value="euros" required> De Euros a Pesetas</label>
        <br>
        <label><input type="radio" name="divisa" value="pesetas" required> De Pesetas a Euros</label>
        <br><br>

        <button type="submit">Calcula</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $cantidadActual = intval($_POST["idCantidad"]);
            $divisaActual = $_POST["divisa"];
            if (is_numeric($cantidadActual) && $cantidadActual > 0) {
                $cookie_name = "cantidad";
                $cookie_value = $cantidadActual;
                $cookie_expires = time() + (60 * 60 * 24 * 30);
                $cookie_path = "/";
                setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

                $cookie_name = "divisa";
                $cookie_value = $divisaActual;
                $cookie_expires = time() + (60 * 60 * 24 * 30);
                $cookie_path = "/";
                setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

                $resultadoActual;
                $cambio = 166.386;
                // $resultadoActual = resultado($cantidadActual, $moneda) ;
                if (is_numeric($cantidadActual) && $cantidadActual > 0) {
                    if ($divisaActual === "euros") {
                        $resultadoActual = $cantidadActual * $cambio;
                        // echo "<p> -> €$cantidad son $resultado $moneda  </p>";
                    } else if ($divisaActual === "pesetas") {
                        $resultadoActual = $cantidadActual / $cambio;
                        // echo "<p> -> €$cantidad son ".number_format($resultado, 2, ",", "."). " $moneda  </p>";
                    }
                }
                if ($resultadoActual) {
                    $cookie_name = "resultado";

                    $cookie_value = $resultadoActual;
                    $cookie_expires = time() + (60 * 60 * 24 * 30);
                    $cookie_path = "/";
                    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

                }

                echo "<h3>Resultado Actual:</h3>";
                echo "$cantidadActual $divisaActual es $resultadoActual";
                echo "<h3>Resultado Anterior:</h3>";

                if (isset($_COOKIE["resultado"])) {
                    $cantidadAnterior = $_COOKIE["cantidad"];
                    $divisaAnterior = $_COOKIE['divisa'];
                    $resultadoAnterior = $_COOKIE["resultado"];

                    echo "$cantidadAnterior $divisaAnterior es $resultadoAnterior ";
                } else {
                    echo "Aún no hay cookie almacenadas  ";
                }


            }
        }

        ?>


</body>

</html>