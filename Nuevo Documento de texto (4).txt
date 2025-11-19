<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $numeros_anteriores = $_COOKIE["numeros"] ?? "Ningunos";
        $calculo_anterior = $_COOKIE["calculo"] ?? "Ninguno";
        $resultado_anterior = $_COOKIE["resultado"] ?? "Ninguno";

        $numeros = $_POST["numeros"] ?? "";
        $calculo = $_POST["calculo"] ?? [];
        $resultado = [];

        $numeros_array = explode(",", $numeros);

        foreach ($calculo as $calc){
            switch($calc){
                case "Media":
                    $media = array_sum($numeros_array)/count($numeros_array);
                    $resultado[] = "Media: $media";
                break;
                case "Mediana":
                    sort($numeros_array);
                    $cantidad = count($numeros_array);

                    if ($cantidad % 2 == 0) {
                        // Par
                        $mediana = ($numeros_array[$cantidad / 2 - 1] + $numeros_array[$cantidad / 2]) / 2;
                    } else {
                        // Impar
                        $mediana = $numeros_array[floor($cantidad / 2)];
                    }

                    $resultado[] = "Mediana: $mediana (Números ordenados)"; 
                break;
                case "Moda":
                    $moda = "";
                    $max_repeticiones = 0;

                    for ($i = 0; $i < $cantidad; $i++) {
                        $repeticiones = 0;

                        for ($j = 0; $j < $cantidad; $j++) {
                            if ($numeros_array[$i] == $numeros_array[$j]) {
                                $repeticiones++;
                            }
                        }

                        if ($repeticiones > $max_repeticiones) {
                            $max_repeticiones = $repeticiones;
                            $moda = $numeros_array[$i];
                        }
                    }

                    $resultado[] = "Moda: $moda";
                break;
            }
        }

        $mensaje = implode(" | ", $resultado);
        setcookie("numeros", $numeros, time() + 3600);
        setcookie("calculo", implode(", ", $calculo), time() + 3600);
        setcookie("resultado", $mensaje, time() + 3600);

        echo "<hr><h3>Cálculo actual:</h3>";        
        echo "Números: <strong>{$numeros}</strong><br>";
        echo "Cálculo: <strong>" . implode(", ", $calculo) . "</strong><br>";
        echo "Resultado: <strong>{$mensaje}</strong><br>";

        echo "<h3>Cálculo anterior:</h3>";
        if ($numeros_anteriores != "Ninguno") {
            echo "Números anteriores: <strong>{$numeros_anteriores}</strong><br>";
            echo "Cálculo anterior: <strong>{$calculo_anterior}</strong><br>";
            echo "Resultado anterior: <strong>{$resultado_anterior}</strong><br>";
        } else {
            echo "<p>No hay datos anteriores guardados.</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lucía Ferrandis Martínez</title>
    </head>
    <body>
        <h2>Lucía Ferrandis Martínez</h2>
        <hr>
        <h1>Cálculo de Media, Mediana y Moda</h1>

        <form method="POST">
            <label>Cantidad:</label>
            <input type="text" name="numeros" required><br><br>
            
            <input type="checkbox" name="calculo[]" value="Media" >Media<br>
            <input type="checkbox" name="calculo[]" value="Mediana" >Mediana<br>
            <input type="checkbox" name="calculo[]" value="Moda" >Moda<br><br>

            <input type="submit" name="enviar" value="Convertir">
        </form>
    </body>
</html>