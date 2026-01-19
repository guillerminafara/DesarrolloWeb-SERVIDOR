<?php
// Incluimos fichero de validación
require_once 'valida.php';

// Inicializar variables vacías para que el formulario no de error al cargar la primera vez
$errores = [];
$nombre = "";
$contrasena = "";
$estudios = "";
$nacionalidad = "espanola"; // Valor por defecto
$nacionalidad_texto = "";
$idiomas = [];
$email = "";
$ruta_imagen = "";

$accion = $_POST['accion'] ?? null;
$mensaje_exito = "";

// PROCESAMIENTO (Solo si se ha enviado el formulario)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. RECOGIDA DE DATOS (Saneamiento básico)
    $nombre = $_POST['nombre_completo'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $estudios = $_POST['estudios'] ?? '';
    $email = $_POST['email'] ?? '';
    $idiomas = $_POST['idiomas'] ?? [];
    
    // Lógica Nacionalidad
    $nac_radio = $_POST['nacionalidad'] ?? '';
    $nac_texto = $_POST['nacionalidad_texto'] ?? '';
    
    if ($nac_radio === 'otra') {
        $nacionalidad = $nac_texto; // Para guardar el valor real
        $nacionalidad_radio_seleccionado = 'otra'; // Para mantener el radio marcado
    } else {
        $nacionalidad = "Española";
        $nacionalidad_radio_seleccionado = 'espanola';
    }

    // 2. VALIDACIONES
    if (!validaRequerido($nombre)) $errores[] = "El nombre completo es obligatorio.";
    if (!validaContrasena($contrasena)) $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    if (!validaRequerido($estudios)) $errores[] = "Debes seleccionar un nivel de estudios.";
    
    if ($nac_radio === 'otra' && !validaRequerido($nac_texto)) {
        $errores[] = "Si seleccionas 'Otra' nacionalidad, debes especificar cuál.";
    }
    
    if (empty($idiomas)) $errores[] = "Debes seleccionar al menos un idioma.";
    if (!validaEmail($email)) $errores[] = "El formato del email no es válido.";

    // Validación de Imagen
    // NOTA: Si hay errores en el resto del formulario, la imagen se subirá igualmente
    // pero no la procesaremos como válida para el envío final hasta que todo esté bien.
    $checkImagen = validarYGuardarImagen($_FILES['imagen']);
    
    if ($checkImagen['correcto'] === false) {
        $errores[] = $checkImagen['mensaje'];
    } else {
        $ruta_imagen = $checkImagen['ruta'];
    }

    // 3. LÓGICA DE DECISIÓN
    if (count($errores) === 0) {
        // --- CASO: TODO BIEN ---
        
        if ($accion === 'Validar') {
            // Si solo quería validar, mostramos mensaje verde en esta misma página
            $mensaje_exito = "¡Todo correcto! El formulario está listo para enviarse.";
        } 
        elseif ($accion === 'Enviar') {
            // Si quiere enviar, construimos el HEADER y nos vamos a resultados.php
            // Como NO HAY SESIONES, pasamos los datos por la URL (query string)
            
            // Preparamos los datos para la URL
            $datos_a_pasar = [
                'nombre' => $nombre,
                'estudios' => $estudios,
                'nacionalidad' => $nacionalidad,
                'email' => $email,
                // Convertimos el array de idiomas a string para pasarlo
                'idiomas' => implode(", ", $idiomas), 
                'ruta_imagen' => $ruta_imagen
            ];
            
            // http_build_query convierte el array en "nombre=pepe&email=...@..."
            $query_string = http_build_query($datos_a_pasar);
            
            // REDIRECCIÓN
            header("Location: resultados.php?" . $query_string);
            exit(); // Importante detener el script después del header
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
        .error-msg { color: red; font-weight: bold; background: #ffe6e6; padding: 10px; border: 1px solid red; }
        .success-msg { color: green; font-weight: bold; background: #e6fffa; padding: 10px; border: 1px solid green; }
        label { font-weight: bold; display: block; margin-top: 10px; }
    </style>
</head>
<body>

    <h2>Formulario de Registro</h2>

    <?php if (count($errores) > 0): ?>
        <div class="error-msg">
            <p>Se han encontrado los siguientes errores:</p>
            <ul>
                <?php foreach($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($mensaje_exito): ?>
        <div class="success-msg">
            <?php echo $mensaje_exito; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        
        <label>Nombre completo:</label>
        <input type="text" name="nombre_completo" value="<?php echo htmlspecialchars($nombre); ?>" required>

        <label>Contraseña (mín. 6 caracteres):</label>
        <input type="password" name="contrasena" value="<?php echo htmlspecialchars($contrasena); ?>" required>

        <label>Nivel de estudios:</label>
        <input type="radio" name="estudios" value="Sin estudios" <?php if($estudios=="Sin estudios") echo "checked"; ?> required> Sin Estudios<br>
        <input type="radio" name="estudios" value="ESO" <?php if($estudios=="ESO") echo "checked"; ?>> ESO<br>
        <input type="radio" name="estudios" value="Bachillerato" <?php if($estudios=="Bachillerato") echo "checked"; ?>> Bachillerato<br>
        <input type="radio" name="estudios" value="FP" <?php if($estudios=="FP") echo "checked"; ?>> FP<br>
        <input type="radio" name="estudios" value="Universidad" <?php if($estudios=="Universidad") echo "checked"; ?>> Universidad<br>

        <label>Nacionalidad:</label>
        <input type="radio" name="nacionalidad" value="espanola" checked> Española<br>
        <input type="radio" name="nacionalidad" value="otra" <?php if(isset($nacionalidad_radio_seleccionado) && $nacionalidad_radio_seleccionado == 'otra') echo "checked"; ?>> Otra: 
        <input type="text" name="nacionalidad_texto" value="<?php echo htmlspecialchars($nacionalidad_texto); ?>">

        <label>Idiomas:</label>
        <input type="checkbox" name="idiomas[]" value="Español" <?php if(in_array("Español", $idiomas)) echo "checked"; ?>> Español
        <input type="checkbox" name="idiomas[]" value="Inglés" <?php if(in_array("Inglés", $idiomas)) echo "checked"; ?>> Inglés
        <input type="checkbox" name="idiomas[]" value="Francés" <?php if(in_array("Francés", $idiomas)) echo "checked"; ?>> Francés
        <input type="checkbox" name="idiomas[]" value="Alemán" <?php if(in_array("Alemán", $idiomas)) echo "checked"; ?>> Alemán<br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label>Adjuntar Foto (Máx 50KB - jpg, png, gif):</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="51200">
        <input type="file" name="imagen" required><br><br>

        <input type="submit" name="accion" value="Validar">
        <input type="submit" name="accion" value="Enviar">
        <button type="reset">Limpiar</button>

    </form>

</body>
</html>