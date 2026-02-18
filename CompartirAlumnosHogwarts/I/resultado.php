<?php
session_start();

// Obtenemos el id del aprendiz de la sesión
$id = $_SESSION['id_aprendiz'] ?? null;

// Si no hay id en la sesión, significa que no viene del formulario o hubo error
if (!$id) {
    die("Acceso no permitido. Debe registrarse primero.");
}

// NOTA: Como ya tenemos los datos en sesión, NO hace falta conectar a la BD
// (Ignoramos los comentarios de conexión del esqueleto original por eficiencia)

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Completado</title>
</head>
<body>

    <h1>Aprendiz registrado correctamente - Iván Montiano González</h1>

    <?php
    /***
     * Mostramos los datos recuperándolos directamente de $_SESSION
     */
    echo "<div style='border: 1px solid #000; padding: 20px; max-width: 600px; font-family: Arial, sans-serif;'>";
    
    // Usamos el operador de fusión null (??) por seguridad, aunque deberían estar llenos
    echo "<p><strong>ID:</strong> " . htmlspecialchars($id) . "</p>";
    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($_SESSION['nombre'] ?? '') . "</p>";
    echo "<p><strong>Casa:</strong> " . htmlspecialchars($_SESSION['casa'] ?? '') . "</p>";
    echo "<p><strong>Varita:</strong> " . htmlspecialchars($_SESSION['varita'] ?? '') . "</p>";
    echo "<p><strong>Asignaturas:</strong> " . htmlspecialchars($_SESSION['asignaturas'] ?? '') . "</p>";
    echo "<p><strong>Nivel Mágico:</strong> " . htmlspecialchars($_SESSION['nivel'] ?? '') . "</p>";

    // Recuperamos el nombre de la foto de la sesión
    $fotoSession = $_SESSION['foto'] ?? null;

    if (!empty($fotoSession)) {
        echo "<p><strong>Nombre del archivo:</strong> " . htmlspecialchars($fotoSession) . "</p>";
        // Ajusta la ruta 'uploads/' si es necesario
        echo "<div style='text-align: center; margin-top: 10px;'>";
        echo "<img src='uploads/" . htmlspecialchars($fotoSession) . "' alt='Foto del aprendiz' style='max-width: 200px; border: 3px solid #333; border-radius: 10px;'>";
        echo "</div>";
    } else {
        echo "<p><strong>Foto:</strong> No se ha subido ninguna foto.</p>";
    }
    
    echo "</div>";
    ?>

    <form action="volver.php" method="post" style="margin-top: 20px;">
        <button type="submit" style="padding: 10px 20px; cursor: pointer;">Volver al formulario</button>
    </form>

</body>
</html>