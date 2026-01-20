<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">

    <form action="ejemplo.php">
        <!-- fieldset -->
        <fieldset>
            <legend>Datos Personales:</legend>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre"><br>
            <label for="apellido">Apellido:</label><br>
            <input type="text" id="apellido" name="apellido"><br>
            <input type="submit" value="Enviar">
        </fieldset>
        <!-- text area -->
        <TEXTAREA COLS="50" ROWS="4" NAME="comentario">

        </TEXTAREA>

        <?PHP
        $comentario = $_REQUEST['comentario'];
        echo $comentario;
        ?>
        <!-- input text -->
        <!-- Introduzca la cadena a buscar: -->
        <INPUT TYPE="text" NAME="cadena" VALUE="valor por defecto" SIZE="20">

        <?php
        $cadena = $_REQUEST['cadena'];
        echo $cadena;
        ?>
        <!-- password -->
        <!-- Contraseña: -->
        <INPUT TYPE="password" NAME="clave">
        <?PHP
        $clave = $_REQUEST['clave'];
        echo $clave;
        ?>
        <!-- input hidden  -->
        <INPUT TYPE='hidden' NAME='username' VALUE=“$usuario”>

        <?PHP
        $username = $_REQUEST['username'];
        echo $username;
        ?>

        <!-- radio button-->
        <!-- Sexo: -->
        <INPUT TYPE="radio" NAME="sexo" VALUE="M" CHECKED>Mujer
        <INPUT TYPE="radio" NAME="sexo" VALUE="H">Hombre
        <!-- ●
            Se obtienen los datos del control en PHP: -->
        <?PHP
        $sexo = $_REQUEST['sexo'];
        echo ($sexo);

        ?>
        Ejemplo
        <INPUT TYPE="checkbox" NAME="extras[]" VALUE="garaje" CHECKED>Garaje
        <INPUT TYPE="checkbox" NAME="extras[]" VALUE="piscina">Piscina
        <INPUT TYPE="checkbox" NAME="extras[]" VALUE="jardin">Jardín
        <!-- ●
 Se obtienen los datos del control en PHP: -->
        <?PHP
        $extras = $_REQUEST['extras'];
        foreach ($extras as $extra)
            echo "$extra<br>\n";

        ?>
      



    </form>

</body>

</html>