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
    <?php echo "Bienvenido:". ucfirst($nombreSession)." - $rolesSession ";

    leerAAsociativos($trabajadoresSession);
    echo "<h3> A lo que tiene acceso: </h3>";

    $media = calcularMedia($trabajadoresSession);
    echo "<p>El salario medio: $media €</p>";

    ?>
    <!-- <a href="cerrarSesion.php"> Cerrar Sesión /body></a> -->
    <form action="cerrarSesion.php" method="POST">
        <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
        <button>Cerrar Sesión</button>
    </form>
</body>

</html>