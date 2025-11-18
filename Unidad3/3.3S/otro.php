<?php
session_start(); // Iniciar sesión

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $user_name_nuevo = $_POST["nombre"];
    $elegir_nuevo = $_POST["elegir"];


    if (isset($_SESSION['user_actual']) && isset($_SESSION['elegir_actual'])) {

        $_SESSION['user_anterior'] = $_SESSION['user_actual'];
        $_SESSION['elegir_anterior'] = $_SESSION['elegir_actual'];
    }

    // Almacenamos los nuevos datos del POST como los "actuales"
    $_SESSION['user_actual'] = $user_name_nuevo;
    $_SESSION['elegir_actual'] = $elegir_nuevo;
}

function saludar($nombre, $elegir)
{
    if ($elegir === "saludo") {
        return "Hola $nombre";
    } else {
        return "Adiós $nombre";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies vs Sesiones</title>
</head>

<body>

    <form method="POST">
        <label>Indique su nombre <input type="text" name="nombre" required></label> <br><br>

        <label>¿Qué prefieres?</label><br><br>
        <label><input type="radio" name="elegir" value="saludo" required>Saludo</label><br>
        <label><input type="radio" name="elegir" value="despedida" required>Despedida</label><br><br>

        <button type="submit">Enviar</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST") {
        echo "<h2>Valores Anteriores (Sesión)</h2>";
        if (isset($_SESSION['user_anterior']) && isset($_SESSION['elegir_anterior'])) {
            echo saludar($_SESSION['user_anterior'], $_SESSION['elegir_anterior']);
        } else {
            echo "Aún no hay datos anteriores registrados en la sesión.";
        }



        echo "<h2>Valores Actuales (Sesión)</h2>";
        if (isset($_SESSION['user_actual']) && isset($_SESSION['elegir_actual'])) {
            echo saludar($_SESSION['user_actual'], $_SESSION['elegir_actual']);
        }
    }
    ?>


</body>

</html>