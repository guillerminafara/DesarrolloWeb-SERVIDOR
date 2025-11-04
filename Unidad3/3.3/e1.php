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
    $listaNombres = array();
    $listaEleccion = array();
    $listaNombres = $_COOKIE["nombre"];
    $listaEleccion = $_COOKIE["elegir"];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $user_name = $_POST["nombre"];
        $elegir = $_POST["elegir"];

        $cookie_name = "user";
        $cookie_value = $user_name;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $cookie2_name = "elegir";
        $cookie2_value = $elegir;
        $cookie2_expires = time() + (60 * 60 * 24 * 30);
        $cookie2_path = "/";
        setcookie($cookie2_name, $cookie2_value, $cookie2_expires, $cookie2_path);

        if (!isset($_COOKIE[$cookie_name])) {
            echo "No hay tal cookie " . $cookie_name;
        }
        else {
            echo "<br>valor de la cookie: " . $_COOKIE[$cookie_name];
        }
        if (!isset($_COOKIE[$cookie2_name])) {
            echo "<br>No hay tal cookie " . $cookie2_name;
        }
        else {
            echo "<br>valor de la cookie2: " . $_COOKIE[$cookie2_name];
        }
        echo "<h2>salida mensaje:</h2>";

        echo "<h3>salida mensaje:</h3>";
        saludar($_COOKIE[$cookie_value], $_COOKIE[$cookie_value]);
        
        echo "<h2>salida mensaje:</h2>";

        echo "<h3>salida mensaje:</h3>";
        saludar($_COOKIE[$cookie2_value], $_COOKIE[$cookie2_value]);
    }

    function saludar($nombre, $elegir)
    {
        // $cookie[0];
        // echo "$cookie[0], $cookie[1]";
        echo $elegir === "saludo" ? "Hola $nombre" : "adiós $nombre";
    }
    ?>
    <p><strong>Note:</strong> You might have to reload the page to see the value of
        the cookie.</p>
</body>

</html>