<?php

/**
 * Lógica de procesamiento y validación
 * Basado en los ejemplos de validación y gestión de archivos
 */

// Inicialización de variables para mantener valores en el formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : "";
$estudios = isset($_POST['estudios']) ? $_POST['estudios'] : "";
$nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : "";
$idiomas = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
$email = isset($_POST['email']) ? trim($_POST['email']) : "";

$errores = [];
$validado = false;
$ruta_foto_final = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validaciones generales
    if (empty($nombre)) $errores[] = "El nombre es obligatorio.";

    if (strlen($_POST['password']) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del email no es válido.";
    }

    if (empty($nacionalidad)) $errores[] = "Debe seleccionar una nacionalidad.";

    // Validación de archivo (Foto)
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tipo = $_FILES['foto']['type'];
        $tamano = $_FILES['foto']['size'];
        $temp = $_FILES['foto']['tmp_name'];

        // Comprobamos la extensión usando explode
        $partes = explode('.', $_FILES['foto']['name']);
        $extension = strtolower(end($partes));
        $extensiones_validas = ['jpg', 'gif', 'png'];

        if (!in_array($extension, $extensiones_validas)) {
            $errores[] = "Extensión de foto no válida (solo jpg, gif, png).";
        }

        if ($tamano > 51200) { // 50 KB en bytes
            $errores[] = "La foto supera el tamaño máximo de 50 KB.";
        }

        // Si no hay errores previos, guardamos
        if (!$errores) {
            $directorio = "img/";
            if (is_dir($directorio)) { //corroboramos si existe
                $nombre_unico = time() . "_" . $_FILES['foto']['name'];
                $ruta_foto_final = $directorio . $nombre_unico;
                move_uploaded_file($temp, $ruta_foto_final);
            } else {
                $errores[] = "El directorio de destino no existe.";
            }
        }
    } else {
        $errores[] = "Debe adjuntar una foto.";
    }

    // Acción según el botón pulsado
    if (isset($_POST['validar'])) {
        if (!$errores) {
            $validado = true;
        }
    } elseif (isset($_POST['enviar'])) {
        if (!$errores) {
            $datos = [
                "nombre" => $nombre,
                "estudios" => $estudios,
                "nacionalidad" => $nacionalidad,
                "email" => $email,
                "idiomas" => implode(", ", $idiomas),
                "ruta_imagen" => $ruta_foto_final
            ];
            header("Location:salida.php?" . http_build_query($datos));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Registro</title>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .resultado {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php if ($validado): ?>
        <p class="success">¡Formulario validado con éxito!</p>
    <?php $datos = [
            "nombre" => $nombre,
            "estudios" => $estudios,
            "nacionalidad" => $nacionalidad,
            "email" => $email,
            "idiomas" => implode(", ", $idiomas),
            "ruta_imagen" => $ruta_foto_final
        ];

    endif; ?>
    <?php if ($errores): ?>
        <ul class="error">
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="correcion.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre completo:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br><br>

            <label for="password">Contraseña (mín 6 caracteres):</label><br>
            <input type="password" id="password" name="password"><br><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>"><br><br>

            <label>Nivel de Estudios:</label><br>
            <select name="estudios">
                <option value="Sin estudios" <?php if ($estudios == "Sin estudios") echo "selected"; ?>>Sin estudios</option>
                <option value="ESO" <?php if ($estudios == "ESO") echo "selected"; ?>>ESO</option>
                <option value="Bachillerato" <?php if ($estudios == "Bachillerato") echo "selected"; ?>>Bachillerato</option>
                <option value="FP" <?php if ($estudios == "FP") echo "selected"; ?>>Formación Profesional</option>
                <option value="Universitarios" <?php if ($estudios == "Universitarios") echo "selected"; ?>>Estudios Universitarios</option>
            </select><br><br>

            <label>Nacionalidad:</label><br>
            <input type="radio" name="nacionalidad" value="Española" <?php if ($nacionalidad == "Española") echo "checked"; ?>> Española
            <input type="radio" name="nacionalidad" value="Otra" <?php if ($nacionalidad == "Otra") echo "checked"; ?>> Otra<br><br>

            <label>Idiomas:</label><br>
            <?php $idiomasLista = ["Español", "Inglés", "Francés", "Alemán", "Italiano"];
            foreach ($idiomasLista as $idioma): ?>
                <input type="checkbox" name="idiomas[]" value="<?php echo $idioma; ?>"
                    <?php if (in_array($idioma, $idiomasLista)) echo "checked"; ?>> <?php echo $idioma; ?>
            <?php endforeach; ?><br><br>

            <label>Adjuntar Foto (jpg, gif, png - máx 50KB):</label><br>
            <input type="file" name="foto"><br><br>

            <input type="reset" value="Limpiar">
            <input type="submit" name="validar" value="Validar">
            <input type="submit" name="enviar" value="Enviar">
        </fieldset>
    </form>
</body>

</html>