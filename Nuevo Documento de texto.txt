<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $dinero_anterior = $_COOKIE["dinero"] ?? "Ninguno";
        $conversion_anterior = $_COOKIE["conversion"] ?? "Ninguna";
        $resultado_anterior = $_COOKIE["resultado"] ?? "Ninguno";

        $dinero = $_POST["dinero"];
        $conversion = $_POST["conversion"];
        $pesetas = 166.386;

        if ($conversion == "Euros a Pesetas") {
            $resultado = round($dinero * $pesetas, 2);
            $mensaje = "$dinero euros son $resultado pesetas.";
        } else {
            $resultado = round($dinero / $pesetas, 2);
            $mensaje = "$dinero pesetas son $resultado euros.";
        }

        setcookie("dinero", $dinero, time() + 3600);
        setcookie("conversion", $conversion, time() + 3600);
        setcookie("resultado", $mensaje, time() + 3600);

        echo "<hr><h3>Conversión actual:</h3>";
        echo "<p><strong>$mensaje</strong></p>";

        echo "<h3>Conversión anterior:</h3>";
        if ($dinero_anterior != "Ninguno") {
            echo "<p>Cantidad: <strong>$dinero_anterior</strong></p>";
            echo "<p>Tipo de conversión: <strong>$conversion_anterior</strong></p>";
            echo "<p>Resultado anterior: <strong>$resultado_anterior</strong></p>";
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
        <h1>Conversor Euros ↔ Pesetas</h1>

        <form method="POST">
            <label>Cantidad:</label>
            <input type="number" name="dinero" step="0.01" required><br><br>
            
            <input type="radio" name="conversion" value="Euros a Pesetas" required>Euros a Pesetas<br>
            <input type="radio" name="conversion" value="Pesetas a Euros" required>Pesetas a Euros<br><br>

            <input type="submit" name="enviar" value="Convertir">
        </form>
    </body>
</html>