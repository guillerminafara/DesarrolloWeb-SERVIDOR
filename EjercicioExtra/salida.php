<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_GET["nombre"];
        echo "$nombre";
        $nombre = $_GET["apellido"];
        echo "$apellido";
        $nombre = $_GET["nacionalidad"];
        echo "$nacionalidad";
        $nombre = $_GET["idioma"];
        echo "$idioma";
        echo "ver";
    }

    ?>
</body>

</html>