<?php
// Configuración de errores y variables iniciales
$errores = [];
$directorioSubida = "fotos/"; // Directorio de destino [5]

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recogida y saneamiento de datos básicos [6, 7]
    $nombre = trim($_POST['nombre']);
    $password = $_POST['password'];
    $estudios = $_POST['estudios'] ?? '';
    $nacionalidad = $_POST['nacionalidad'] ?? '';
    $idiomas = $_POST['idiomas'] ?? []; // Los checkboxes se reciben como array [8, 9]
    $email = trim($_POST['email']);

    // 2. Validaciones de texto
    if (empty($nombre)) $errores[] = "El nombre es obligatorio.";
    if (strlen($password) < 6) $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errores[] = "El email no es válido." [10].

    // 3. Validación y procesamiento de la foto [11, 12]
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            $nombreOriginal = $_FILES['foto']['name'];
            $tamano = $_FILES['foto']['size'];
            
            // Obtener extensión usando explode() como se solicita
            $partes = explode('.', $nombreOriginal);
            $extension = strtolower(end($partes));
            $extensionesValidas = ['jpg', 'gif', 'png'];

            // Comprobar extensión y tamaño (50 KB = 51200 bytes) [11, 13]
            if (!in_array($extension, $extensionesValidas)) {
                $errores[] = "Extensión de foto no válida (solo jpg, gif, png).";
            } elseif ($tamano > 51200) {
                $errores[] = "La foto supera el tamaño máximo de 50 KB.";
            }

            // Comprobar si existe el directorio y generar nombre único [5, 12]
            if (empty($errores)) {
                if (!is_dir($directorioSubida)) {
                    $errores[] = "El directorio de subida no existe.";
                } else {
                    $nombreUnico = time() . "_" . uniqid() . "." . $extension;
                    $rutaDestino = $directorioSubida . $nombreUnico;

                    if (!move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino)) {
                        $errores[] = "Error al mover el archivo al directorio de destino.";
                    }
                }
            }
        }
    } else {
        $errores[] = "Debe adjuntar una foto correctamente.";
    }

    // 4. Redirección si no hay errores [10, 14]
    if (empty($errores)) {
        header("Location: exito.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro</title>
</head>
<body>
    <h1>Registro de Usuario</h1>

    <!-- Mostrar errores si existen [15] -->
    <?php if ($errores): ?>
        <ul style="color: red;">
            <?php foreach ($errores as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="index.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre completo:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo isset($nombre) ? htmlspecialchars($nombre) : ''; ?>"><br><br>

            <label for="password">Contraseña (mín 6 car.):</label><br>
            <input type="password" id="password" name="password"><br><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"><br><br>

            <label for="estudios">Nivel de Estudios:</label><br>
            <select name="estudios" id="estudios">
                <option value="Sin estudios">Sin estudios</option>
                <option value="ESO">Educación Secundaria Obligatoria</option>
                <option value="Bachillerato">Bachillerato</option>
                <option value="FP">Formación Profesional</option>
                <option value="Universitarios">Estudios Universitarios</option>
            </select><br><br>

            <label>Nacionalidad:</label><br>
            <input type="radio" name="nacionalidad" value="Española" checked> Española
            <input type="radio" name="nacionalidad" value="Otra"> Otra [16]<br><br>

            <label>Idiomas:</label><br>
            <input type="checkbox" name="idiomas[]" value="Español"> Español
            <input type="checkbox" name="idiomas[]" value="Inglés"> Inglés
            <input type="checkbox" name="idiomas[]" value="Francés"> Francés
            <input type="checkbox" name="idiomas[]" value="Alemán"> Alemán
            <input type="checkbox" name="idiomas[]" value="Italiano"> Italiano [8]<br><br>

            <label for="foto">Adjuntar Foto (jpg, gif, png - máx 50KB):</label><br>
            <input type="file" name="foto" id="foto"><br><br>

            <!-- Botones solicitados [17-19] -->
            <input type="reset" value="Limpiar">
            <input type="submit" name="validar" value="Validar">
            <input type="submit" name="enviar" value="Enviar">
        </fieldset>
    </form>
</body>
</html>