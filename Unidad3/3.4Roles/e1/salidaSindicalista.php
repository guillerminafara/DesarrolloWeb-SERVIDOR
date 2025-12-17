<?php
session_start();
include "calculos.php";
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "Sindicalista") {
    header("Location: e1.php");
    exit;
}
$rolesSession = $_SESSION["rol"];
$nombreSession = $_SESSION["nombre"];
$trabajadoresSession = $_SESSION["trabajadores"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>SALIDA SINDICALISTA- Guillermina </h2>
    <?php echo "Bienvenido: $nombreSession - $rolesSession ";
    leerAAsociativos($trabajadoresSession);
    $media = calcularMedia($trabajadoresSession);
    echo "<p>El salario medio: $media €</p>";

    ?>
    <form action="CerrarSesion.php" method="post">
        <button>Cerrar Sesión</button>
    </form>
</body>

</html>