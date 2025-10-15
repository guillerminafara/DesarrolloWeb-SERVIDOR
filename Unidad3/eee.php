<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conversor Euros ↔ Pesetas</title>
</head>
<body>
    <h2>💱 Conversor entre Euros y Pesetas</h2>

    <form method="post">
        <label>Cantidad:</label>
        <input type="number" step="0.01" name="cantidad" required>
        <br><br>

        <label>Conversión:</label><br>
        <input type="radio" name="tipo" value="euro_peseta" required> De Euros a Pesetas<br>
        <input type="radio" name="tipo" value="peseta_euro" required> De Pesetas a Euros<br><br>

        <button type="submit">Convertir</button>
    </form>

    <hr>

    <?php
    // Solo ejecuta cuando el formulario se envía
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $cantidad = $_POST["cantidad"];
        $tipo = $_POST["tipo"];
        $conversion = 166.386; // 1€ = 166.386 ptas

        // Validar que el valor sea numérico y positivo
        if (!is_numeric($cantidad) || $cantidad <= 0) {
            echo "<p style='color:red;'>⚠️ Introduce una cantidad válida mayor que 0.</p>";
        } else {
            if ($tipo === "euro_peseta") {
                $resultado = $cantidad * $conversion;
                echo "<p>💶 $cantidad € son <strong>" . number_format($resultado, 2, ',', '.') . " ptas</strong></p>";
            } elseif ($tipo === "peseta_euro") {
                $resultado = $cantidad / $conversion;
                echo "<p>💰 $cantidad ptas son <strong>" . number_format($resultado, 2, ',', '.') . " €</strong></p>";
            } else {
                echo "<p style='color:red;'>⚠️ Selecciona un tipo de conversión válido.</p>";
            }
        }
    }
    ?>
</body>
</html>
