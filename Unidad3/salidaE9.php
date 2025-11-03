<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: sans-serif;
        }

        div {
            background-color: #8bfff090;
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }
    </style>
</head>

<body>
    <h2>Salida de formulario</h2>
    <?php
    require_once "comprobaciones.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_POST["nombre"] ?? "";
        $edad = $_POST["edad"] ?? "";
        $nivelEstudios = $_POST["nivelEstudios"] ?? "";
        $situacion = $_POST["situacion"] ?? [];
        $hobbies = $_POST["hobbies"] ?? [];
        $bandera = comprobarEdad($edad);
         echo "<h3>Datos personales: </h3>";
        if ($bandera) {
             echo "<p>$nombre \n $edad años </p>";
        } else {
            echo "<p>Edad errónea</p>";
        }

       
       

        echo "<h3>Nivel de estudios: </h3>";
        echo "<p>$nivelEstudios </p>";

        echo "<h3> Situación laboral: </h3>";


        comprobarCasillasSituacion();
        echo "<h3> Hobbies: </h3>";

        comprobarCasillasHobbies();

        echo '<form action="e9.php"><button type="submit">Volver</button></form>';
    }
    function comprobarEdad($edad)
    {
        return is_numeric($edad) && comprobarMinMax($edad);
    }
    function comprobarCasillasSituacion()
    {
        if (isset($_POST["situacion"]) && !empty($_POST["situacion"])) {
            $situacion = $_POST["situacion"];
            foreach ($situacion as $opcion) {
                echo htmlspecialchars($opcion);
                echo "<br>";
            }
            echo "";
        } else {
            echo "<p id='mal'>No puedes dejar casillas vacias en Situación actual</p>";
        }
    }
    function comprobarCasillasHobbies()
    {
        if (isset($_POST["hobbies"])) {
            $hobbies = $_POST["hobbies"];
            if (!empty($_POST["hobbies"])) {
                foreach ($hobbies as $opcion) {
                    echo htmlspecialchars($opcion);
                    echo "<br>";
                }
            } else {
                echo "<p id='mal'>No puedes dejar casillas vacias en hobbies</p>";
            }
        }
    }
    ?>
    <div>
        <p>Fara Santeyana María Guillermina · 2do DAW</p>

    </div>
</body>

</html>