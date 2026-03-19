<?php
session_start();
/*
    TODO: Iniciar sesión
*/

/*
    TODO: Incluir validaciones.php
*/
include_once(__DIR__ . "/../app/validaciones.php");
/*
    TODO: Leer el archivo users.json y decodificarlo.
    TODO: Extraer solo los nombres autorizados con array_column().
    TODO: Guardar la lista de usuarios autorizados en $_SESSION['listaUsuarios'].
*/
$file = __DIR__ . "/../users.json"; // usamos users!!!
$usuarios = json_decode(file_get_contents($file), true);
//foreach para sumar los nombres a la lista de usuario autorizados
if ($usuarios) {
    // $nombresLista = array_column($usuarios, "name");
    foreach ($usuarios as $nombre) {
        // echo $nombre["name"] . "<br>";
        $nombreLista[] = $nombre["name"];
    }

    $_SESSION["listaUsuarios"] = $nombreLista;
}
/*
    Array para almacenar errores (lo usarán ellos)
*/
$errores = array();
$validar = false;
/*
    TODO: Recoger el nombre enviado por POST (si existe)
*/
$nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : "";

/*
    TODO: Comprobar si la petición es POST
*/
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    /* ============================
       BOTÓN VALIDAR
       ============================ */
    if (isset($_POST["validar"])) {

        /*
            TODO: Validar el nombre usando:
                - validaRequerido()
                - validaAlfabeto()
            TODO: Si es válido, guardar el nombre en sesión.
            TODO: Si NO es válido, añadir mensajes al array $errores.
        */

        if (!validaAlfabeto($nombre) || !validaRequerido($nombre)) {
            $errores[] = "Campo nombre invalido";
        } else {
            $_SESSION["personaje"] = $nombre;
        }
    }

    /* ============================
       BOTÓN ACCEDER
       ============================ */
    if (isset($_POST["acceder"])) {
      
        $personaje = isset($_SESSION["personaje"]) ? $_SESSION["personaje"] : "";
        $listaUsuarios = isset($_SESSION["listaUsuarios"]) ? $_SESSION["listaUsuarios"] : [];
        foreach ($listaUsuarios as $usuario) {
            // if ($usuario === $personaje) {
            //     $_SESSION["auth"] = true;
            //     header("Location: index.php");
            //     exit();
            // }
         
      
        }

        if (in_array($personaje, $listaUsuarios, true)) {
            $_SESSION["auth"] = true;
           
            header("Location: index.php");
            exit();
        } else {
            $errores[] = "Usuario no autorizado: " . $personaje;
            session_unset();
            session_destroy();
            $nombre = "";
        }

        /*
            TODO: Recuperar el nombre guardado en sesión.
            TODO: Comprobar si está en la lista de usuarios autorizados.
            TODO: Si está autorizado:
                    - Guardar auth = true
                    - Redirigir a index.php
            TODO: Si NO está autorizado:
                    - Destruir la sesión
                    - Vaciar $nombre
                    - Añadir error "Usuario no autorizado"
        */
    } 

    // verificamos que el array se encuentre vacio para poder validar el boton el enviar 
    if (empty($errores)) {
        $validar = true;
    }
}
?>
<!-- 
    TODO: Indica TU NOMBRE en el título
-->
<h1>Acceso a la API de Star Wars - GUILLERMINA FARA</h1>

<!-- 
    TODO: Mostrar errores en lista roja recorriendo el array $errores
-->
<ul style="color:red">
    <?php if (!empty($errores)) {

        foreach ($errores as $e): ?>
            <li><?php echo htmlspecialchars($e); ?></li>
    <?php endforeach;
    } ?>
</ul>
<form action="login.php" method="POST">

    <label>Nombre:</label>

    <!-- 
        TODO: Rellenar el campo con el nombre validado o recuperado de sesión
    -->
    <input type="text" name="nombre" value="<?php echo isset($_SESSION["personaje"]) ? $_SESSION["personaje"] : ""; ?>">

    <br><br>

    <!-- 
        TODO: Mostrar botón VALIDAR si no se ha validado o hay errores
    -->
    <button type="submit" name="validar">Validar</button>
    <?php if ($validar === true): ?>
        <p style="color: green;">¡Datos validados correctamente!</p>
        <button type="submit" name="acceder">Acceder</button>
        <!-- 
        TODO: Mostrar botón ACCEDER si se ha validado correctamente
    -->
    <?php endif ?>
</form>