<?php
/***
 * Formulario para registrar un aprendiz de Hogwarts
 * Requiere sesión para guardar los datos entre peticiones 
 * y un token CSRF para evitar ataques.
 * Se debe validar usando el fichero validaciones.php
 **/

/**
 * PROCESAR FORMULARIO
 * @author Guillermina fara <email>
 */
session_start();
require_once("app/validaciones.php");
$error=array();
$valida = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $casa = $_POST["casa"];
    $varitas = $_POST["varitas"];
    $asignaturas = $_POST["asignaturas"];
    $foto = $_FILES["foto"]["name"];
    $nivel = $POST["nivelMagico"];
    if (validaAlfabeto($nombre) && validaRequerido($nombre)) {
        $error[] = "el nombre solo puede contener letras";
    }

    if (!validaRequerido($casa)) {
        $error[] = "Deber SELECCIONAR una casa";
    }
    if (!validaRequerido($nivel) && !validaNumero($nivel) && !validaRango($nivel)) {
        $error[] = "Error a la hora de ingresar nivel mágico";
    }

    if (count($error) > 0) {
        $valida = true;
    }

    if (empty($_SESSION["alumnos"])) {
        $_SESSION["alumnos"] = array(
            "nombre"->$nombre,
            "casa"->$casa,
            "varitas"->$varitas,
            "asignaturas"->$asignaturas,
            "nivel"->$nivel,
            "foto"->$foto,
            //"fecha_registro"-> new date_timezone_get())

        );
    }

}

// Comprobar token CSRF y finalizar si no es válido


// Si se pulsa ENVIAR


/**
 * GUARDAR EN BASE DE DATOS
 * Los datos ya están validados y se guardan en sesión ($_SESSION)
 * Se redirige a resultado.php con el id del aprendiz
 */


// Si se pulsa VALIDAR

/**
 * VALIDACIONES y guardar valores en sesión
 */

//nombre

//casa 


//varita


//asignaturas


//nivel mágico


//foto

//Si no hay foto en sesión, validamos la subida

// Validar que se ha subido una foto

// Validar extensiones y tamaño de la foto.
//Si todo OK, guardar datos de la foto en sesión

/***
 * GUARDAR LA FOTO EN EL SERVIDOR
 */

//Si no existe se crea la carpeta Uploads

//Generamos el nombre final del archivo

// nombreAprendiz_timestamp.extensión es el formato final


// Mover el archivo subido a la carpeta uploads

// Guardar el nombre final en sesión

//fin validación foto subida
//fin foto en sesión
//fin botón validar

?>
<!-- FORMULARIO HTML, pon tu nombre con h1 -->



<!-- El listado de errores si los hay -->

<!-- completar las opciones necesarias del formulario -->
<form action="index.php" method="POST" enctype="multipart/form-data">
    <!-- Campo oculto para el token CSRF -->
    <input type="hidden" name="token" value="">
    <!-- En cada campo debemos devolver los datos correctos 
        $_SESSION['nombre'] ?? '' Si no hay valor en la sesión devolvemos vacío para no devolver null -->
    <p><label>Nombre del aprendiz:</label>
        <input type="text" name="nombre">
    </p>

    <p><label>Casa:</label>
        <input type="radio" name="casa" value="Gryffindor">Gryffindor
        <input type="radio" name="casa" value="Slytherin">Slytherin
        <input type="radio" name="casa" value="Ravenclaw">Ravenclaw
        <input type="radio" name="casa" value="Hufflepuff">Hufflepuff

        <option value=""></option>

    </p>

    <p><label>Varita:</label>
        <select name="varitas[]" id="varitas" multiple>
            <option value="Roble con núcleo de Fénix">Roble con núcleo de Fénix"</option>
            <option value="Sauce con núcleo de unicornio">Sauce con núcleo de unicornio</option>
            <option value="Acebo con núcleo de dragón">Acebo con núcleo de dragón</option>

        </select>
    </p>

    <p><label>Asignaturas favoritas:</label>
        <input type="checkbox" name="asignaturas[]" value="Encantamientos ">Encantamientos
        <input type="checkbox" name="asignaturas[]" value="Defensa contra las Artes Oscuras">Defensa contra las Artes
        Oscuras
        <input type="checkbox" name="asignaturas[]" value="Herbología">Herbología

    </p>

    <p><label>Nivel mágico (1-100):</label>
        <input type="text" name="nivelMagico">

    </p>
    <!-- Campo para subir la foto -->
    <!-- Si ya hay foto en sesión, no mostramos el campo de subida -->

    <p><label>Foto del aprendiz:</label>
        <input type="file" name="foto">
    </p>
    <!-- Campo oculto para el tamaño máximo de la foto (2MB) -->
    <input type="hidden" name="tamano_maximo" value="2000000">

    <br><br>
    <!-- VALIDAR visible si:
         - NO es POST
         - O es POST con errores -->
    <?php
    if ($valida) {

    }

    ?>


    <button type="submit" name="validar">VALIDAR</button>


    <!-- ENVIAR visible si:
         - ES POST
         - Y NO hay errores -->
    <?php

    ?>

    <button type="submit" name="enviar">ENVIAR</button>

</form>