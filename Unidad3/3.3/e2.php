<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 10px;
        }
    </style>
</head>

<body>

    <form method="POST">
        <label> Nombre: <input type="text" name="nombre"></label>
        <br>
        <label>Selecciona un color: </label>
        <select name="color[]" id="color">
            <option value="">Selecciona un color</option>
            <option value="Rojo">Rojo</option>
            <option value="Amarillo">Amarillo</option>
            <option value="Naranja">Naranja</option>
            <option value="Verde">Verde</option>
            <option value="Azul">Azul</option>
        </select><br>
        <label>Selecciona un idioma</label>
        <select name="idioma[]" id="idioma">
            <option value="">Selecciona un idioma</option>
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
            <option value="Valenciano">Valenciano</option>
            <option value="Francés">Francés</option>

        </select><br>
        <label>Ciudad: <input type="text"></label><br>

        <button>Enviar</button>
    </form>
    <?php
    if ($_SERVER === "POST") {
        $nombre = $_POST["nombre"];
        $color = $_POST["color"];
        $idioma = $_POST["idioma"];
        $ciudad = $_POST["ciudad"];

        $cookie_name = "nombre";
        $cookie_value = $nombre;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);


        $cookie_name = "color";
        $cookie_value = $color;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $cookie_name = "idioma";
        $cookie_value = $idioma;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $cookie_name = "ciudad";
        $cookie_value = $ciudad;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);
        echo "<h2>Valores actuales</h2>";
        if (isset($nombre) && isset($color) && isset($idioma) && isset($ciudad)) {
            echo "$nombre,\n prefiere el color $color,\n Selección de idioma: $idioma, \n ciudad: $ciudad ";
        } else {
            echo "Aún no  hay cookies almacenadas";
        }

        echo "<h2>Valores anteriores</h2>";


        if (!isset($_COOKIE["nombre"]) && !isset($_COOKIE["color"]) && !isset($_COOKIE["idioma"]) && !isset($_COOKIE["ciudad"])) {
            echo "$nombre,\n prefiere el color $color,\n Selección de idioma: $idioma, \n ciudad: $ciudad ";
        } else {
            echo "Aún no  hay cookies almacenadas";
        }
    }


    ?>
</body>


</html>