<?php

session_start();

// Si no hay resultados, redirige o muestra mensaje
if (empty($_SESSION['resultados_consulta'])) {
    echo "<p>No hay datos para mostrar.</p>";
    exit;
}

// Recuperar resultados
$resultados = $_SESSION['resultados_consulta'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Marketing</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>
    <h1>Resultados de Marketing</h1>

    <table>
        <thead>
            <tr>
                <?php foreach (array_keys($resultados[0]) as $columna): ?>
                    <th><?php echo htmlspecialchars($columna); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $fila): ?>
                <tr>
                    <?php foreach ($fila as $valor): ?>
                        <td><?php echo htmlspecialchars($valor); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
