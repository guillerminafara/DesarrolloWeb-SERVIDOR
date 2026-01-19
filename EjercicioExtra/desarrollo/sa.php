<?php

$nombre = $_GET['nombre'] ?? 'Desconocido';
$estudios = $_GET['estudios'] ?? 'No especificado';
$nacionalidad = $_GET['nacionalidad'] ?? 'No especificada';
$email = $_GET['email'] ?? 'No especificado';
$idiomas = $_GET['idiomas'] ?? 'Ninguno';
$urlImagen = $_GET['ruta_imagen'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesado con éxito!!</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .ficha { border: 1px solid #ccc; padding: 20px; background: #f9f9f9; max-width: 600px; }
        img { max-width: 300px; display: block; margin-top: 15px; border: 5px solid white; shadow: 0 0 5px #ccc; }
        .firma { margin-top: 30px; border-top: 2px solid #333; padding-top: 10px; color: #555; }
    </style>
</head>
<body>

    <h1>Procesado con éxito!!</h1>
    <p>Sus datos han sido registrados correctamente en el sistema.</p>

    <div class="ficha">
        <h3>Ficha del Usuario</h3>
        <ul>
            <li><strong>Nombre Completo:</strong> <?php echo htmlspecialchars($nombre); ?></li>
            <li><strong>Estudios:</strong> <?php echo htmlspecialchars($estudios); ?></li>
            <li><strong>Nacionalidad:</strong> <?php echo htmlspecialchars($nacionalidad); ?></li>
            <li><strong>Idiomas:</strong> <?php echo htmlspecialchars($idiomas); ?></li>
            <li><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></li>
        </ul>

        <?php if($urlImagen): ?>
            <div>
                <strong>Foto de perfil:</strong><br>
                <img src="<?php echo htmlspecialchars($urlImagen); ?>" alt="FotoUser">
            </div>
        <?php else: ?>
            <p><em>No se ha podido cargar la imagen.</em></p>
        <?php endif; ?>
    </div>

        <a href="procesar.php"><button>Volver al inicio</button></a>
    

</body>
</html>