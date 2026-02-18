<?php
session_start();

// Obtenemosel id del aprendiz o es null
// Si no hay id, mostramos mensaje de error y detenemos la ejecución
if () {
die("Acceso no permitido.");
}
if (isset($_SESSION["alumnos"])): ?>

    <h2>Datos del aprendiz-Guillermina Fara</h2>

    <p><strong>Nombre:</strong>
        <?php echo htmlspecialchars($_SESSION["alumnos"]["nombre"]); ?>
    </p>

    <p><strong>Casa:</strong>
        <?php echo htmlspecialchars($_SESSION["alumnos"]["casa"]); ?>
    </p>

    <p><strong>Nivel mágico:</strong>
        <?php echo htmlspecialchars($_SESSION["alumnos"]["nivel"]); ?>
    </p>

    <p><strong>Asignaturas favoritas:</strong>
        <?php foreach ($_SESSION["alumnos"]["varitas"] as $varita): ?>
            <span><?php echo htmlspecialchars($varita); ?></span><br>
        <?php endforeach; ?>
    </p>
    <p><strong>Asignaturas favoritas:</strong>
        <?php foreach ($_SESSION["alumnos"]["asignaturas"] as $asignatura): ?>
            <span><?php echo htmlspecialchars($asignatura); ?></span><br>
        <?php endforeach; ?>
    </p>

    <p>
        <?php if(!empty($_SESSION["alumnos"]["foto"]) ): ?>
        <strong>Foto:</strong>
            <?php echo htmlspecialchars($foto);?>

    </p>
<?php else: ?>
    <p>No hay datos en sesión.</p>
<?php endif; ?>





// Conectamos a la base de datos

// Buscamos el aprendiz por su id

// Si no se encuentra el aprendiz, mostramos mensaje de error y detenemos la ejecución
// if () {
// die("Aprendiz no encontrado.");
// }
?>

<!--Pon un h1 con el texto "Aprendiz registrado correctamente" y tu nombre-->

<?php

/***
 * Se deben mostrar todos los datos del aprendiz (de la foto mostrar el nommbre y la imagen)
 * Se puede imprimir el HTML directamente aquí (desde PHP) o poner el HTML fuera del bloque PHP.
 * La primera opción demuestra más dominio de PHP, la segunda es más sencilla.
 */
?>

<!-- Agregar botón "Volver al formulario" (NO enlace). Ejecuta el script volver.php-->
<form action="volver.php" method="post">

</form>