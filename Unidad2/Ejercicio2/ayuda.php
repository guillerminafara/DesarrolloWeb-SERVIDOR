<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Permutaciones de un vector</title>
</head>
<body>
<?php
// 🔹 Función para crear una matriz 5x5 con M[n][m] = n + m
function crearMatriz($filas, $columnas) {
    $matriz = [];
    for ($n = 0; $n < $filas; $n++) {
        for ($m = 0; $m < $columnas; $m++) {
            $matriz[$n][$m] = $n + $m;
        }
    }
    return $matriz;
}

// 🔹 Función para mostrar la matriz en formato tabla HTML
function mostrarMatriz($matriz) {
    echo "<table border='1' cellpadding='5' style='border-collapse:collapse; text-align:center;'>";
    $filas = count($matriz);
    $columnas = count($matriz[0]);

    // Calcular suma de columnas
    $sumaColumnas = array_fill(0, $columnas, 0);

    for ($i = 0; $i < $filas; $i++) {
        $sumaFila = 0;
        echo "<tr>";
        for ($j = 0; $j < $columnas; $j++) {
            echo "<td>{$matriz[$i][$j]}</td>";
            $sumaFila += $matriz[$i][$j];
            $sumaColumnas[$j] += $matriz[$i][$j];
        }
        echo "<td><strong>$sumaFila</strong></td>"; // suma fila
        echo "</tr>";
    }

    // Mostrar suma de columnas
    echo "<tr>";
    for ($j = 0; $j < $columnas; $j++) {
        echo "<td><strong>{$sumaColumnas[$j]}</strong></td>";
    }
    echo "<td><strong>—</strong></td>"; // celda vacía para alineación
    echo "</tr>";

    echo "</table>";
}

// 🔹 Programa principal
$matriz = crearMatriz(5, 5);
mostrarMatriz($matriz);
?>

</body>
</html>
marcar => checkbox
seleccionar= combobox