<?php
session_start();
require_once(__DIR__ . "/../validaciones.php");
require_once(__DIR__ . "/../controllers/AprendizController.php");
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


$error = array();
$valida = false;
if (!isset($_SESSION["token"])) {
    // $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION["token"] = bin2hex(random_bytes(32));
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //corroborar que venga del boton validar, incluso foto. de ahi subir a uploads y poner en sesiones
    //en el if en boton de file solo debe aparecer si no existe en la sesion el file. si ya existe que muestre mensaje de foto subida 
    $nombre = $_POST["nombre"] ?? "";
    $casa = $_POST["casa"] ?? "";
    $varitas = isset($_POST["varitas"]) ? implode(",", $_POST["varitas"]) : [];
    $asignaturas = isset($_POST["asignaturas"]) ? implode(",", $_POST["asignaturas"]) : [];
    $foto = $_FILES["foto"] ?? null;
    $nivel = $_POST["nivelMagico"] ?? "";
    $tamano_maximo = $_POST["tamano_maximo"];


    // Comprobar token CSRF y finalizar si no es válido

    if (!isset($_POST["token"])) {
        die("Acceso no permitido.");
    } else {
        if (hash_equals($_POST['token'], $_SESSION['token']) === false) {
            die("Token no coincide");
        }
    }

    // Si se pulsa ENVIAR
    /// si enviar se muestra es porque validar ya supero correctamente y desaparece validar
    if (isset($_POST["enviar"])) {
        $controller = new AprendizController();
        $idGenerado= $controller->guardar($nombre, $casa, $varitas, $asignaturas, $nivel,$foto);
        $_SESSION["alumnos"] = array(
            // $conjunto = array(
            "nombre" => $nombre,
            "casa" => $casa,
            "varitas" => explode(",", $varitas),
            "asignaturas" => explode(",", $asignaturas),
            "nivel" => $nivel,
            "foto" => $foto ?? null,
            "fecha_registro" => time() //date("Y-m-d H:i:s")
        );
        header("Location: resultado.php");
        exit();
    }
    /**
     * GUARDAR EN BASE DE DATOS
     * Los datos ya están validados y se guardan en sesión ($_SESSION)
     * Se redirige a resultado.php con el id del aprendiz
     */

    // Si se pulsa VALIDAR
    if (isset($_POST["validar"])) {
        /**
         * VALIDACIONES y guardar valores en sesión
         */

        //nombre
        if (!validaAlfabeto($nombre) || !validaRequerido($nombre)) {
            $error[] = "el nombre solo puede contener letras";
        }
        //casa 
        if (!validaRequerido($casa)) {
            $error[] = "Deber SELECCIONAR una casa";
        }
        //varita
        if (!validaRequerido($varitas)) {
            $error[] = "Debe SELECCIONAR al menos una varita";
        }
        //asignaturas
        if (!validaRequerido($asignaturas)) {
            $error[] = "Debe SELECCIONAR al menos una asignatura";
        }
        //nivel mágico
        if (!validaRequerido($nivel) || !validaNumero($nivel) || $nivel < 1 ||  $nivel > 100) {
            $error[] = "Error a la hora de ingresar nivel mágico";
        }


        //foto
        if (isset($foto) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $extensiones = ["jpg", "jpeg", "png"];
            $tipo = $foto["type"];
            $extension = explode("/", $tipo);
            if ($foto["size"] >= $tamano_maximo) {
                $error[] = "La foto no puede superar los 2MB";
            }


            // Validar extensiones y tamaño de la foto.
            if (!in_array($extension[1], $extensiones)) {
                $error[] = "Extensión no válida";
            } else {
                //    foreach ($arrayTipo as $a){
                //         echo "ver: $a";
                //    }
            }
            if (empty($errores)) {
                $carpeta = "uploads/";
                if (!is_dir($carpeta)) {
                    mkdir($carpeta, 0777, true);
                }
                $nombreFoto = $nombre . "_" . time() . "." . $extension[1];

                if (move_uploaded_file($foto["tmp_name"], $dir . $nombreFoto)) {
                    $_SESSION["foto"] = $nombreFoto;
                } else {
                    $error[] = "Error al subir la foto al servidor";
                }
            }
        } else {
            $error[] = "Debes subir una foto";
        }

        //Si no hay foto en sesión, validamos la subida

        // Validar que se ha subido una foto

        //Si todo OK, guardar datos de la foto en sesión
        if (empty($error)) {
            $valida = true;
        }
    }
}

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
<h1>Guillermina Fara</h1>


<!-- El listado de errores si los hay -->
<?php if (!empty($error)): ?>

    <ul style="color: red;">
        <?php foreach ($error as $e): ?>
            <li> <?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- completar las opciones necesarias del formulario -->
<form action="index.php" method="POST" enctype="multipart/form-data">
    <!-- Campo oculto para el token CSRF -->
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
    <!-- En cada campo debemos devolver los datos correctos 
        $_SESSION['nombre'] ?? '' Si no hay valor en la sesión devolvemos vacío para no devolver null -->
    <p><label>Nombre del aprendiz:</label>
        <input type="text" name="nombre">
    </p>

    <p><label>Casa:</label>
        <select name="casa" id="casa">
            <option value="">Escoge una casa</option>
            <option value="Gryffindor">Gryffindor</option>
            <option value="Slytherin">Slytherin</option>
            <option value="Ravenclaw">Ravenclaw</option>
            <option value="Hufflepuff">Hufflepuff</option>
        </select>
        <!-- <input type="radio" name="casa" value="Gryffindor">Gryffindor
        <input type="radio" name="casa" value="Slytherin">Slytherin
        <input type="radio" name="casa" value="Ravenclaw">Ravenclaw
        <input type="radio" name="casa" value="Hufflepuff">Hufflepuff -->
    </p>

    <p><label>Varita:</label>
        <select name="varitas[]" id="varitas" multiple>
            <option value="Roble con núcleo de Fénix">Roble con núcleo de Fénix</option>
            <option value="Sauce con núcleo de unicornio">Sauce con núcleo de unicornio</option>
            <option value="Acebo con núcleo de dragón">Acebo con núcleo de dragón</option>

        </select>
    </p>

    <p><label>Asignaturas favoritas:</label><br><br>
        <input type="checkbox" name="asignaturas[]" value="Encantamientos ">Encantamientos <br><br>
        <input type="checkbox" name="asignaturas[]" value="Defensa contra las Artes Oscuras">Defensa contra las Artes Oscuras <br><br>

        <input type="checkbox" name="asignaturas[]" value="Herbología">Herbología <br><br>

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
    <button type="submit" name="validar">VALIDAR</button>
    <!-- VALIDAR visible si:
         - NO es POST
         - O es POST con errores -->
    <?php if ($valida === true): ?>
        <!-- ENVIAR visible si:
         - ES POST
         - Y NO hay errores -->

        <p style="color: green;">¡Datos validados correctamente!</p>
        <button type="submit" name="enviar">ENVIAR</button>

    <?php endif; ?>

</form>