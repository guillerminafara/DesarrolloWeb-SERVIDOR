<!-- 9.Escribe un formulario de recogida de datos que conste de dos páginas: 
    En la primera página se solicitan los datos y se muestran errores 
    tras validarlos (botones Validar y Enviar). En la segunda página 
    se muestra toda la información introducida por el usuario si no
     hay errores (tendrá botón Volver a la página inicial). 
     Los datos a recoger son datos personales, nivel de estudios (desplegable), 
     situación actual (selección múltiple: estudiando, trabajando, 
     buscando empleo, desempleado) y hobbies (marcar de varios mostrados y
      poner otro con opción a introducir texto). -->
<?php
session_start();
$nombreAnterior = $_SESSION["nombre"] ?? null;
$edadAnterior = $_SESSION["edad"] ?? null;
$estudiosAnteriores = $_SESSION["estudios"] ?? null;
$situacionActualAnterior = $_SESSION["situacion"] ?? [];
$hobbiesAnteriores = $_SESSION["hobbies"] ?? [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["valida"])) {
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $bandera = comprobarEdad($edad);
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
            font-family: sans-serif;
            margin-left: 10px;
        }

        #mal {
            color: red;
        }

        #bien {
            color: green;
        }

        div {
            background-color: #8bfff090;
            position: fixed;
            bottom: 20px;
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }
    </style>
</head>

<body>
    <h2>Formulario ejercicio 9 -Fara Santeyana</h2>
    <form method="POST" action="">
        <label>Nombre:<input type="text" name="nombre" required></label>
        <br><br>
        <label>Edad:<input type="text" name="edad"></label>

        <h3>Nivel de estudios:</h3>
        <select name="nivelEstudios" required>
            <option value="">Nivel de estudios</option>
            <option value="Primaria">Primaria</option>
            <option value="ESO">ESO</option>
            <option value="Bachiller">Bachiller</option>
            <option value="Formacion profesional">Formacion Profesional</option>
            <option value="Universitario">Universitario</option>
        </select>
        <h3>Situación Actual:</h3>
        <br>
        <label><input type="checkbox" name="situacion[]" value="Estudiante">Estudiante</label>
        <br>
        <label><input type="checkbox" name="situacion[]" value="Trabajador">Trabajador</label>
        <br>
        <label><input type="checkbox" name="situacion[]" value="En busca de empleo">En busca de empleo</label>
        <br>
        <label><input type="checkbox" name="situacion[]" value="Desempleado">Desempleado</label>
        <br>

        <h3>Hobbies</h3>
        <label><input type="checkbox" name="hobbies[]" value="Leer">Leer</label>
        <br>
        <label><input type="checkbox" name="hobbies[]" value="Tejer">Tejer</label>
        <br>
        <label><input type="checkbox" name="hobbies[]" value="Deportes">Deportes</label>
        <br>
        <label><input type="checkbox" name="hobbies[]" value="Videojuegos">Videojuegos</label>
        <br>
        <label><input type="checkbox" name="hobbies[]" value="Viajar">Viajar</label>
        <br>
        <label><input type="checkbox" name="hobbies[]" value="Otros">Otros:</label>
        <br>
        <label> Otro: <input type="text" name="otro"></label>
        <br><br>
        <button type="submit" name="valida">Validar</button>
        <button type="submit" name="enviar" formaction="salidaE9.php">Enviar</button>
        <button type="reset">Borrar</button>
    </form>
    <p></p>
    <?php



    if ($bandera) {
        echo "<p id='bien'>Edad correcta</p>";
    } else {
        echo "<p id='mal'>Edad errónea</p>";
    }
    comprobarCasillasSituacion();
    comprobarCasillasHobbies();

    function comprobarEdad($edad)
    {
        return is_numeric($edad) && comprobarMinMax($edad);
    }
    function comprobarCasillasSituacion()
    {
        if (isset($_POST["situacion"]) && !empty($_POST["situacion"])) {
            $situacion = $_POST["situacion"];
            // foreach ($situacion as $opcion) {
            //     echo htmlspecialchars($opcion);
            //     echo "<br>";
            // }
            echo "<p id='bien'>Situación laboral correcta</p>";
        } else {
            echo "<p id='mal'>No puedes dejar casillas vacias en Situación actual</p>";
        }
    }
    function comprobarCasillasHobbies()
    {
        if (isset($_POST["hobbies"])) {
            $hobbies = $_POST["hobbies"];
            if (!empty($_POST["hobbies"])) {
                // foreach ($hobbies as $opcion) {
                //     echo htmlspecialchars($opcion);
                //     echo "<br>";
                // }
                echo "<p id='bien'>Hobbies correctos</p>";
            } else {
                echo "<p id='mal'>No puedes dejar casillas vacias en hobbies</p>";
            }
        }
    }
    function comprobarMinMax($edad)
    {
        return $edad > 0 && $edad < 99 ? true : false;
    }
    ?>

</body>

</html>