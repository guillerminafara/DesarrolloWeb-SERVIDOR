<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div {
            background-color: #8bfff090;
            position: fixed;
            bottom: 20px;
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }
    </style>
</head>
<form action="" method="">
    <h2>Formulario ejercicio 10</h2>
    <label>Nombre:<input type="text" name="nombre" required></label>
    <br><br>
    <label>Apellido:<input type="text" name="apellido" required></label>
    <br><br>
    <label>Edad:<input type="text" name="edad"></label><br><br>
    <label>Peso:<input type="text" name="peso" required></label>
    <br><br>
    <label>Sexo:</label>
    <br><br>
    <label><input type="radio" name="sexo" value="Mujer" required> Mujer</label>
    <br><br>
    <label><input type="radio" name="sexo" value="Hombre" required> Hombre</label>
    <br><br>
    <label><input type="radio" name="sexo" value="No responde" required> Prefiero no responder</label>
    <br><br>
    <label>Estado Civil:</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Soltero" required> Soltero</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Casado" required> Casado</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Divorciado" required> Divorciado</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Viudo" required> Viudo</label>

    <label>Aficiones:</label>
    <label><input type="checkbox" name="aficiones[]" value="Cine"> Cine</label>
    <br>
    <label><input type="checkbox" name="aficiones[]" value="Deporte"> Deporte</label><br>
    <label><input type="checkbox" name="aficiones[]" value="Literatura"> Literatura</label><br>
    <label><input type="checkbox" name="aficiones[]" value="Musica"> Musica</label><br>
    <label><input type="checkbox" name="aficiones[]" value="Comics"> Comics</label><br>
    <label><input type="checkbox" name="aficiones[]" value="Series"> Series</label><br>
    <label><input type="checkbox" name="aficiones[]" value="Videojuegos"> Videojuegos</label><br>



    <button type="submit" name="valida">Validar</button>
    <button type="hidden" name="enviar" formaction="salidaE10.php" style="display:none;">Enviar</button>
    <button type="reset">Borrar</button>
</form>

<body>
    <?php require_once "comprobaciones.php";

    if (isset($_POST["valida"]) && $_SERVER["REQUEST_METHOD"]) {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $edad = $_POST["edad"];
        $peso = $_POST["peso"];
        $bandera = comprobarEdad($edad);
        $bandera2 = comprobarPeso($peso);
        $bandera3 = comprobarCasillasAficiones($peso2);
        // $bandera4= isset($_POST["sexo"]) ? $_POST["sexo"] :;
        if ($bandera) {
            echo "<p id='bien'>Edad correcta</p>";
        } else {
            echo "<p id='mal'>Edad errónea</p>";
        }

        if ($bandera2) {
            echo "<p id='bien'>Peso correcto</p>";
        } else {
            echo "<p id='mal'>Peso fuera de rango</p>";
        }

    }

    function validarTodo($bandera, $bandera2, $bandera3, $bandera4, $bandera5)
    {
        if ($bandera && $bandera2 && $bandera3 && $bandera4 && $bandera5) {
            echo "<button type='submit' name='enviar' formaction='salidaE10.php'>Enviar</button>";

        }

    }
    function comprobarPeso($peso)
    {
        $a = $peso > 10 && $peso < 150;
        return is_numeric($peso) && $a ? true : false;
    }
    function comprobarEdad($edad)
    {
        return is_numeric($edad) && comprobarMinMax($edad);
    }
    function comprobarCasillasAficiones()
    {
        $bandera = false;
        if (isset($_POST["aficiones"]) && !empty($_POST["aficiones"])) {
            echo "<p id='bien'>Aficiones correctas</p>";
            $bandera = true;
        } else {
            echo "<p id='bien'>Aficiones incorrectas</p>";
        }
        return $bandera;
    }
    ?>

    <div>
        <p>Fara Santeyana María Guillermina · 2do DAW</p>

    </div>


</body>

</html>