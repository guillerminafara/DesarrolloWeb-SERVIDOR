Guillermina fara
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>
        Conversor de Pesetas - Euros by Guillermina
    </h2>

    <?php
    if (isset($_POST['divisa'])) {
        // if($_POST['divisa'] !== null){
        $divisa = $_POST['divisa'] === 'EUROS' ? 'PESETAS' : 'EUROS';
    } else {
        $divisa = 'EUROS';
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $cantidad = $_POST["idCantidad"];
        $tipoDivisa = $_POST["divisa"];
        $cambio = 166.386;
        if (!is_numeric($cantidad) || $cantidad <= 0) {

            echo "<p>Introduce una cantidad válida</p>";
        } else {
            if ($tipoDivisa === "EUROS") {
                $resultado = $cantidad * $cambio;
                echo "<p>$cantidad € son <strong>" . number_format($resultado, 2, ',', '.') . " ptas</strong></p>";
            } else if ($tipoDivisa === "PESETA") {
                $resultado = $cantidad / $cambio;
                echo "<p>$cantidad ptas son <strong>" . number_format($resultado, 2, ',', '.') . " €</strong></p>";
            }
        }
    }

    // function validar() {}
    ?>

    <form method="post">
        <input type="hidden" name="divisa" value="<?= $divisa ?>">
        <br>
        <br>
        <button type="button">
            <?= $divisa === 'EUROS' ? 'EUROS -> PESETAS' : 'PESETAS -> EUROS' ?>
        </button>
        <br>
        <br>
        <label>Cantidad:</label><input type="text" name="idCantidad" required>
        <br>
        <br>
        <button type="submit">Calcula</button>

    </form>

</body>

</html>