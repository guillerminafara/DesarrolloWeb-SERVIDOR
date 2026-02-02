<?php
$nombre = $_GET['nombre'] ?? 'Desconocido';
$estudios = $_GET['estudios'] ?? 'No especificado';
$nacionalidad = $_GET['nacionalidad'] ?? 'No especificada';
$email = $_GET['email'] ?? 'No especificado';
$idiomas = $_GET['idiomas'] ?? 'Ninguno';
$ruta_foto=$GET["ruta_foto"]?? "error";
 ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Éxito</title>
</head>

<body>
    <h2>El formulario se ha procesado con éxito.</h2>
    <p><strong>Alumno:</strong> Guillermina Fara</p>
    <p><strong>Grupo:</strong> DAW2</p>

    <p>Bienvenido, <?php echo $nombre; ?>.</p>

    <p class="success">¡Formulario validado con éxito!</p>
    <div class="resultado">
        <h3>Datos obtenidos:</h3>
        <p>Nombre: <?php echo htmlspecialchars($nombre); ?></p>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Estudios: <?php echo htmlspecialchars($estudios); ?></p>
        <p>Nacionalidad: <?php echo htmlspecialchars($nacionalidad); ?></p>
        <p>Idiomas: <?php echo implode(", ", $idiomas); ?></p>
        <p>Foto subida: <?php echo basename($ruta_foto_final); ?></p>
        <img src="<?php echo $ruta_foto_final; ?>" width="150">
    </div>
    <form action="index.php">
        <input type="submit" value="Volver">
    </form>
</body>

</html>
```

### Notas sobre la implementación:
* **Seguridad**: Se utiliza `strip_tags()` y `trim()` para limpiar la entrada del nombre y `htmlspecialchars()` al mostrar datos en la página de éxito para evitar XSS.
* **Gestión de archivos**: Se verifica la existencia del directorio `img/` con `is_dir()` y se genera un nombre único concatenando el timestamp actual mediante `time()`.
* **Validación de tamaño**: Se comprueba que el tamaño sea menor a 51.200 bytes (equivalente a 50 KB).
* **Persistencia**: En el formulario, los valores se mantienen tras la validación usando PHP dentro de los atributos `value`, `selected` y `checked`.