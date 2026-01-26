<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <h3>Información personal</h3><br>
        <label>Nombre: <input type="text" name="nombre"></label><br><br>
        <label>Apellido: <input type="text" name="apellido"></label><br><br>

        <label>Email:<input type="text" name="mail"></label><br><br>
        <label>Contraseña: <input type="password" name="contraseña"></label><br><br>

        <h3>Nivel de estudios:</h3>
        <select name="nivelEstudios" required>
            <option value="">Nivel de estudios</option>
            <option value="Sin estudios">Sin estudios</option>
            <option value="ESO">ESO</option>
            <option value="Bachiller">Bachiller</option>
            <option value="Formacion profesional">Formacion Profesional</option>
            <option value="Universitario">Universitario</option>
        </select><br>
        <h3>Nacionalidad:</h3>
        <label>Español</label><input type="radio" name="nacionalidad" value="español" required><br>
        <label>otro</label><input type="radio" name="nacionalidad" value="otro"><br>


        <h3>Idioma</h3>
        <label>Selecciona un idioma</label>
        <select name="idioma[]" id="idioma" multiple required>
            <option value="">Selecciona un idioma</option>
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
            <option value="Alemán">Alemán</option>
            <option value="Francés">Francés</option>
            <option value="Italiano">Italiano</option>
        </select><br><br>


        <label>Sube una imagen<input type="file" name="imagen"></label><br><br>



        <button type="sumbit" name="validar">Validar</button>
        <button type="sumbit" name="enviar" formaction="salida.php">Enviar</button>
        <button type="reset">Borrar</button>

    </form>

    <?php
    $errores = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $contraseña = $_POST["contraseña"];
        $nivelEstudios = $_POST["nivelEstudios"];
        $nacionalidad = $_POST["nacionalidad"];
        $idioma = $_POST["idioma"];
        if (strlen($contraseña) < 6) {

            $errores[] = " La contraseña debe contener al menos 6 carácteres";
        }
        if (!comprobarMail($mail)) {
            $errores[] = "Formato de contraseña no válida";

        }
        if (ctype_alnum($nombre) && ctype_alnum($apellido)) {
            $errores[] = "Formato de nombre no válido";
        }


        // if (is_uploaded_file($_FILES["imagen"])) {
        $tamanyo = intval($_FILES['imagen']['size']);
        $tipo = $_FILES["imagen"]["type"];
        $extraer = explode("/", $tipo);
        echo "ver tamaño" . $tamanyo;
        echo $tipo . "<br> viendooo $extraer[1]";


        if ($tamanyo > 5000 || $comprobarFormato($extraer)) {

            // '<a href="salida.php?user="$"></a>';
    
        } else {
            $errores[] = "Formato o tamaño no válido";

        }

        if (count($errores) > 0) {
            leerErrores($errores);
        } elseif (count($errores) === 0) {
            echo "<p style='color: green;>FORMULARIO VALIDADO </p>";
            header("Location: salida.php?nombre=$nombre?apellido=$apellido?Nacionalidad=$nacionalidad?nivelEstudios=$nivelEstudios?idiomas=$idioma?imagen=$imagen");
            exit;
        }
    }
    function comprobarFormato($extraer)
    {
        $bandera = false;
        if ($extraer[1] === "png" || $extraer[1] === "pdf" || $extraer[1] === "gif") {
            $bandera = true;
        }
        return $bandera;
    }
    function comprobarMail($mail)
    {
        return preg_match(" /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $mail) ? true : false;

    }

    function leerErrores($errores)
    {
        echo " <ul>";
        foreach ($errores as $error) {
            echo "<li style='color: red;' > $error</li> ";
        }
        echo " </ul>";

    }

    ?>
</body>

</html>