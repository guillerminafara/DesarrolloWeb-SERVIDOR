<?php
session_start();
if (isset($_SESSION["cargo"]) || $_SESSION["cargo"] === "Estudiante") {
    $mayor_de_edad_session = null;
    $nombreSession = $_SESSION["nombre"] ?? null;
    $apellidoSession = $_SESSION["apellido"] ?? null;
    $grupoSession = $_SESSION["grupo"] ?? null;
    $asignaturaSession = $_SESSION["asignatura"] ?? null;
    $mayor_de_edad_session = $_SESSION["mayor_de_edad"] ?? null;
    $cargoSession = $_SESSION["cargo"] ?? null;
    // echo "$nombreSession, $apellidoSession, $grupoSession, $asignaturaSession, $mayor_de_edad_session, $grupoSession";
} else {
    header("Location: e2.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: sans-serif;
        }

        table {
            border: 1px solid grey;
            border-collapse: collapse;
            padding: 8px;
        }

        th {
            border: 1px solid grey;
            background-color: #c3c3c3ff;
            padding: 8px;
        }

        td {
            border: 1px solid grey;
            padding: 8px;
            text-align: center;
            width: 20%;
        }
    </style>
</head>

<body>

    <?php
    echo "<h2>Salida Estudiante</h2>";
    echo "<h3>Bienvenido - " . ucfirst($nombreSession) . " - " . ucfirst($apellidoSession) . " - "  . ucfirst($grupoSession) . "</h3>";
     echo "<p><strong>Asignatura:</strong>" . ucfirst($asignaturaSession) . "</p>";
    echo "<br>";
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
   if ($mayor_de_edad_session === "true") {
        echo "<td> X </td>";
        echo "<td></td>";    
    } else if ($mayor_de_edad_session === "false") {
        echo "<td></td>";
        echo "<td> X </td>";
    }
  
    if ($cargoSession === "true") {
        echo "<td> X </td>";
        echo "<td></td>";
    } else if ($cargoSession === "false") {
        echo "<td></td>";
        echo "<td> X </td>";
    }

    echo "</tr>";
    echo " </table>";
    ?>
      <br>
      <form action="cerrarSesion.php" method="post">
        <button>Cerrar Sesión</button>
    </form>
</body>

</html>