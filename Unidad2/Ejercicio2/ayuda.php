<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Permutaciones de un vector</title>
</head>
<body>
    <h2>Permutaciones de un vector</h2>

    <?php
    // --- Función que realiza las permutaciones ---
    function permutaciones(&$V) {
        $N = count($V);
        for ($i = 0; $i < floor($N / 2); $i++) {
            $temp = $V[$i];
            $V[$i] = $V[$N - 1 - $i];
            $V[$N - 1 - $i] = $temp;
        }
    }

    // --- Ejemplo de uso ---
    $V = [1, 2, 3, 4, 5, 6];

    echo "<p><strong>Vector original:</strong> [" . implode(", ", $V) . "]</p>";

    permutaciones($V);

    echo "<p><strong>Vector permutado:</strong> [" . implode(", ", $V) . "]</p>";
    ?>
</body>
</html>
marcar => checkbox
seleccionar= combobox