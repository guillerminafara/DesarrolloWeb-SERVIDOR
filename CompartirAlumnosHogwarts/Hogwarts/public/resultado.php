<?php
session_start();
include_once(__DIR__ . "/../app/controllers/AprendizController.php");

// Conectamos a la base de datos

if (isset($_SESSION["alumnos"])) {
    // Buscamos el aprendiz por su id
    // Obtenemosel id del aprendiz o es null

    $id = $_SESSION["alumnos"]["id"];
    // $id=$_GET["id"]??null;
    // Si no hay id, mostramos mensaje de error y detenemos la ejecución
    if (!isset($id)) {
        die("Acceso no permitido.");
    }
    $controller = new AprendizController(); // llamamos al controlador 
    $aprendiz = $controller->buscarAprendizById($id); // usamos función en controlador que busca al aprendiz 
    // Si no se encuentra el aprendiz, mostramos mensaje de error y detenemos la ejecución
    if (!isset($aprendiz)) {
        die("Aprendiz no encontrado.");
    }
}



//<!--Pon un h1 con el texto "Aprendiz registrado correctamente" y tu nombre-->

echo "<h1>Aprendiz registrado correctamente - Guillermina fara</h1>";


echo "<p><strong>Nombre: </strong>$aprendiz->nombre</p>";
echo "<p><strong>Casa: </strong>$aprendiz->casa</p>";
echo "<p><strong>Nivel: </strong>$aprendiz->nivelMagico</p>";
echo "<p><strong>Varitas: </strong>$aprendiz->varitas</p>";
echo "<p><strong>Asignaturas: </strong>$aprendiz->asignaturas</p>";
echo "<p><strong>Fecha: </strong>$aprendiz->fecha</p>";
echo "<p><strong>Foto: </strong>$aprendiz->foto</p>";
echo "<img src='uploads/$aprendiz->foto'>";

/***
* Se deben mostrar todos los datos del aprendiz (de la foto mostrar el nommbre y la imagen)
* Se puede imprimir el HTML directamente aquí (desde PHP) o poner el HTML fuera del bloque PHP.
* La primera opción demuestra más dominio de PHP, la segunda es más sencilla.
*/
?>

<!-- Agregar botón "Volver al formulario" (NO enlace). Ejecuta el script volver.php-->
<form action="volver.php" method="post">
    <button name="volver">Volver</button>
</form>