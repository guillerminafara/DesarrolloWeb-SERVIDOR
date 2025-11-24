<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $color = $_POST["color"][0];
    $idioma = $_POST["idioma"][0];
    $ciudad = $_POST["ciudad"];
    $nombre_anterior;
    $color_anterior;
    $idioma_anterior;
    $ciudad_anterior;
    $_SESSION["nombreActual"] = $nombre;
    $_SESSION["colorActual"] = $color;
    $_SESSION["idiomaActual"] = $idioma;
    $_SESSION["ciudadActual"] = $ciudad;


    $_SESSION["nombreAnterior"] = $_SESSION["nombreActual"] ?? null;
    $_SESSION["colorAnterior"] = $_SESSION["colorActual"] ?? null;
    $_SESSION["idiomaAnterior"] = $_SESSION["idiomaActual"] ?? null;
    $_SESSION["ciudadAnterior"] = $_SESSION["ciudadActual"] ?? null;

  
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
            margin: 10px;

        }

        #titulo {
            font-family: sans-serif;
            color: blueviolet;
        }
    </style>
</head>

<body>
    <div id="titulo">
        <h2>Ejercicio 2 - Guillermina Fara </h2>
    </div>
    <form method="POST">
        <label> Nombre: <input type="text" name="nombre" required></label>
        <br>
        <label>Selecciona un color: </label>
        <select name="color[]" id="color" required>
            <option value="">Selecciona un color</option>
            <option value="Rojo">Rojo</option>
            <option value="Amarillo">Amarillo</option>
            <option value="Naranja">Naranja</option>
            <option value="Verde">Verde</option>
            <option value="Azul">Azul</option>
        </select><br>
        <label>Selecciona un idioma</label>
        <select name="idioma[]" id="idioma" required>
            <option value="">Selecciona un idioma</option>
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
            <option value="Valenciano">Valenciano</option>
            <option value="Francés">Francés</option>

        </select><br>
        <label>Ciudad: <input type="text" name="ciudad" required></label><br>

        <button>Enviar</button>
    </form>
    <?php
    echo "<h2>Valores actuales</h2>";
    if (isset($nombre) && isset($color) && isset($idioma) && isset($ciudad)) {
        echo "$nombre,\n prefiere el color $color,\n Selección de idioma: $idioma, \n ciudad: $ciudad ";
    } else {
        echo "Aún no  hay valores almacenadas";
    }

    echo "<h2>Valores anteriores</h2>";

    if (isset($_SESSION["nombreAnterior"]) && isset($_SESSION["colorAnterior"]) && isset($_SESSION["idiomaAnterior"]) && isset($_SESSION["ciudadAnterior"])) {
        $nombre_anterior = $_SESSION['nombreAnterior'];
        $color_anterior = $_SESSION["colorAnterior"];
        $idioma_anterior = $_SESSION["idiomaAnterior"];
        $ciudad_anterior = $_SESSION["ciudadAnterior"];
        echo "$nombre_anterior,\n prefiere el color $color_anterior,\n Selección de idioma: $idioma_anterior, \n ciudad: $ciudad_anterior ";
    
      session_destroy();
    } else {
        echo "Aún no  hay sesiones almacenadas";
    }
    ?>
</body>


</html>