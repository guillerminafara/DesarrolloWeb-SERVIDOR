<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $num_anterior = $_COOKIE["num"] ?? "Ninguno";
        $resultado_anterior = $_COOKIE["resultado"] ?? "Ninguno";

        $num_actual = $_POST["num"];
        $resultado = 0;

        if($num_actual <= 0 || $num_actual > 31){
            $resultado = "El día no existe";
        }else{
            if ($num_actual <= 15){
                $resultado = "Primera quincena. Día: $num_actual";
            }else{
                $resultado = "Segunda quincena. Día: $num_actual";
            }
        }

        setcookie("num", $num_actual, time() + 3600);
        setcookie("resultado", $resultado, time() + 3600);


        echo "<h3>Datos actuales:</h3>";
        echo "Día del mes: <strong>{$resultado}</strong><br>";

        echo "<h3>Datos anteriores:</h3>";
        echo "Día del mes: <strong>{$resultado_anterior}</strong><br>";
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Lucía Ferrandis</title>
    </head>
    <body>
        <h2>Lucía Ferrandis Martínez</h2>
        <hr>
        <h2>Quincena del mes</h2>

        <form method="post" action="">
            <label>Día del mes:</label>
            <input type="number" name="num" required><br><br>

            <input type="submit" value="Calcular">
        </form>
    </body>
</html>