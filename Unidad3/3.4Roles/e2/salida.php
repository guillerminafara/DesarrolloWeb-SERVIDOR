<?php
session_start();
if (!isset($_SESSION["nombre"]) || !isset($_SESSION["apellido"])) {
    $nombreSession = $_SESSION["nombre"];
    $apellidoSession = $_SESSION["apellido"];
    $grupoSession = $_SESSION["grupo"];
    $asignaturaSession = $_SESSION["asignatura"];
    $mayor_de_edad = $_SESSION["mayor_de_edad"];
    $cargo = $_SESSION["cargo"];

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Bienvenido- htmlspecialchars()</h2>

    <?php
    echo "<table>";
    echo "<tr>";
    echo "<th>Perfil</th>";
    echo "<th>Mayor de Edad</th>";
    echo "<th>Menor de Edad</th>";
    echo "<th>Con cargo</th>";
    echo "<th>Sin cargo</th>";
    echo "</tr>";
    echo "<tr>";
    echo " <td>$grupoSession</td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";
    echo "<td></td>";

    echo "</tr>";
    echo " </table>";
    ?>
</body>

</html>