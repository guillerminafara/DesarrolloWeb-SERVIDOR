<?php
    $correcta = "1234";

    if (!isset($_COOKIE["intentos"])) {
        setcookie("intentos", 0, time() + 30);
        $_COOKIE["intentos"] = 0;
    }

    if (!isset($_COOKIE["historial"])) {
        setcookie("historial", "", time() + 30);
        $_COOKIE["historial"] = "";
    }

    $mensaje = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $pass = $_POST["pass"];

        $intentos = $_COOKIE["intentos"] + 1;
        setcookie("intentos", $intentos, time() + 30);
        $_COOKIE["intentos"] = $intentos;

        if ($_COOKIE["historial"] === "") {
            $nuevo = $pass;
        } else {
            $nuevo = $_COOKIE["historial"] . "," . $pass;
        }

        setcookie("historial", $nuevo, time() + 30);
        $_COOKIE["historial"] = $nuevo;

        if ($pass === $correcta) {
            $mensaje = "Contraseña correcta";
            $_COOKIE["intentos"] = 0;
            $_COOKIE["historial"] = "";

        } else {
            $mensaje = "Contraseña incorrecta";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Caja fuerte</title>
    </head>
    <body>

    <h2>Caja fuerte</h2>

    <form method="POST">
        <label>Contraseña:</label>
        <input type="text" name="pass" maxlength="4" required>
        <button type="submit">Enviar</button>
    </form>

    <hr>

    <p><?php echo $mensaje; ?></p>

    <p><b>Contraseña correcta:</b> <?php echo $correcta; ?></p>

    <p><b>Contraseñas introducidas:</b> <?php echo $_COOKIE["historial"]; ?></p>

    <p><b>Intentos:</b> <?php echo $_COOKIE["intentos"]; ?></p>

    </body>
</html>