<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name_actual = $_POST["nombre"];
    $elegir_actual = $_POST["elegir"];

    $cookie_name = "user";
    $cookie_value = $user_name_actual;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

    $cookie2_name = "elegir";
    $cookie2_value = $elegir_actual;
    $cookie2_expires = time() + (60 * 60 * 24 * 30);
    $cookie2_path = "/";
    setcookie($cookie2_name, $cookie2_value, $cookie2_expires, $cookie2_path);
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

    <form method="POST">
        <label>Indique su nombre <input type="text" name="nombre" required></label> <br><br>
        <label> Qué prefieres?</label><br><br>
        <label><input type="radio" name="elegir" value="saludo" required>Saludo</label><br>
        <label><input type="radio" name="elegir" value="despedida" required>Despedida</label><br><br>

        <button type="submit">Enviar</button>

    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        echo "<h2>Valor Anteriores</h2>";
        if (!isset($_COOKIE[$cookie_name]) && !isset($_COOKIE[$cookie2_name])) {
            echo "Aún no hay cookie almacenadas  " . $cookie_name;
            echo "<br>Aún no hay cookie almacenadas  " . $cookie2_name;
        } else {
            echo saludar($_COOKIE[$cookie_name], $_COOKIE[$cookie2_name]);
        }

        echo "<h2>Valor Actuales</h2>";

        if (isset($user_name_actual) && isset($elegir_actual)) {
            echo saludar($user_name_actual, $elegir_actual);
        } else {
            echo "Aún no hay cookie almacenadas  " . $cookie_name;
            echo "<br>Aún no hay cookie almacenadas  " . $cookie2_name;
        }
    }
    function saludar($nombre, $elegir)
    {
        $salida = "";

        if ($elegir === "saludo") {
            $salida = "Hola $nombre";
        } else {
            $salida = "Adiós $nombre";
        }
        return $salida;
    }
    ?>
    <p><strong>Note:</strong> You might have to reload the page to see the value of
        the cookie.</p>
</body>

</html>