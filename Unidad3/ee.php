<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conversor Euros ↔ Pesetas</title>
</head>
<body>
    <h2>Conversor de Pesetas - Euros by Guillermina</h2>

    <?php
    // Valor inicial de la divisa
    $divisa = 'EUROS';
    $resultadoTexto = '';

    // Cambiar de divisa (sin exigir cantidad)
    if (isset($_POST['accion']) && $_POST['accion'] === 'cambiar') {
        $divisa = $_POST['divisa'] === 'EUROS' ? 'PESETAS' : 'EUROS';
    }
    // Calcular conversión
    elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accion']) && $_POST['accion'] === 'calcular') {
        $divisa = $_POST["divisa"];
        $cantidad = $_POST["idCantidad"];
        $cambio = 166.386;

        if (!is_numeric($cantidad) || $cantidad <= 0) {
            $resultadoTexto = "<p style='color:red;'>⚠️ Introduce una cantidad válida mayor que 0.</p>";
        } else {
            if ($divisa === "EUROS") {
                $resultado = $cantidad * $cambio;
                $resultadoTexto = "<p>$cantidad € son <strong>" . number_format($resultado, 2, ',', '.') . " ptas</strong></p>";
            } else {
                $resultado = $cantidad / $cambio;
                $resultadoTexto = "<p>$cantidad ptas son <strong>" . number_format($resultado, 2, ',', '.') . " €</strong></p>";
            }
        }
    }
    ?>

    <form method="post">
        <input type="hidden" name="divisa" value="<?= $divisa ?>">

        <button type="submit" name="accion" value="cambiar">
            <?= $divisa === 'EUROS' ? 'EUROS → PESETAS' : 'PESETAS → EUROS' ?>
        </button>

        <br><br>

        <label for="idCantidad">Cantidad:</label>
        <input type="number" step="0.01" id="idCantidad" name="idCantidad" value="<?= isset($_POST['idCantidad']) ? htmlspecialchars($_POST['idCantidad']) : '' ?>">

        <br><br>

        <button type="submit" name="accion" value="calcular">Calcular</button>
    </form>

    <hr>

    <?= $resultadoTexto ?>
</body>
</html>
