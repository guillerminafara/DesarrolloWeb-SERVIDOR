<?php
session_start();
include "calculos.php";
if (!isset($_SESSION["rol"]) || $_SESSION["rol"] !== "Gerente") {
    header("Location: e1.php");
    exit;
} else {
    $rolesSession = $_SESSION["rol"];
    $nombreSession = $_SESSION["nombre"];
    $trabajadoresSession = $_SESSION["trabajadores"];
    // $trabajadoresSession;
}
function cerrarSesion()
{
    session_unset();
    session_destroy();
    header("Location:e1.php");
    exit();
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
    <h2>Salida del Gerente - Guillermina</h2>
    <?php echo "Bienvenido:". ucfirst($nombreSession)." - $rolesSession ";
    leerAAsociativos($trabajadoresSession);
    $media = calcularMedia($trabajadoresSession);
    $minimo = calculaSalarioMinimo($trabajadoresSession);
    $maximo = calculaSalarioMaximo($trabajadoresSession);

    echo "<h3> A lo que tiene acceso: </h3>";
    echo "<p>El salario medio: $media €</p>";
    echo "<p>El salario mínimo: $minimo €</p>";
    echo "<p>El salario máximo $maximo €</p>";

    ?>
    <form action="cerrarSesion.php" method="post">
        <button>Cerrar Sesión</button>
    </form>
</body>

</html>