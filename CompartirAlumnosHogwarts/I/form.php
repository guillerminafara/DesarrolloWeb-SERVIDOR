<?php
/***
 * Formulario para registrar un aprendiz de Hogwarts
 * Requiere sesión para guardar los datos entre peticiones 
 * y un token CSRF para evitar ataques.
 * Se debe validar usando el fichero validaciones.php
 **/

/**
 * PROCESAR FORMULARIO
 */

// Generamos el token si no existe en la sesión
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$nombre = $_POST['nombre'] ?? '';
$casa = $_POST['casa'] ?? '';
$varita = $_POST['varita'] ?? '';
$asignaturas = $_POST['asignaturas'] ?? [];
$nivel = $_POST['nivel'] ?? '';

$action = $_POST['action'] ?? '';
$errores = [];

// Comprobar token CSRF
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        $errores[] = "Error de seguridad: Token CSRF inválido. Recarga la página.";
        $action = ''; // Anulamos la acción para que no procese nada más
    }
}

// BLOQUE DE VALIDACIÓN (Se ejecuta tanto para VALIDAR como para ENVIAR)
if ($action === 'ENVIAR' || $action === 'VALIDAR') {

    // nombre
    if (!validaRequerido($nombre)) {
        $errores[] = 'Es obligatorio introducir el nombre.';
    } elseif (!validaAlfabeto($nombre)) {
        $errores[] = 'El nombre solo puede contener caracteres del alfabeto.';
    }

    // casa 
    if (!validaRequerido($casa)) {
        $errores[] = 'Es obligatorio seleccionar casa.';
    }

    // varita
    if (!validaRequerido($varita)) {
        $errores[] = 'Es obligatorio seleccionar varitas.';
    }

    // asignaturas
    if (!validaSeleccion($asignaturas)) {
       $errores[] = 'Debes seleccionar al menos 1 asignatura.';
    }

    // nivel mágico
    if (!validaRequerido($nivel)) {
        $errores[] = 'Debes introducir el nivel.';
    } elseif (!validaNumero($nivel)) {
        $errores[] = 'El nivel debe ser un valor numérico.';
    }

    // foto
    // Si NO hay foto guardada ya en la sesión, validamos la subida
    if (!isset($_SESSION['foto'])) {
        
        // 1. Comprobar si se ha subido archivo
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
            $errores[] = "Es obligatorio subir una foto.";
        } elseif ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            $errores[] = "Error al subir el archivo.";
        } else {
            // 2. Validar tamaño (max 2MB)
            if ($_FILES['foto']['size'] > 2000000) {
                $errores[] = "La foto es demasiado grande. Máximo 2MB.";
            }

            // Validar extensión
            $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $errores[] = "Formato no válido. Solo JPG, PNG o GIF.";
            }

            // Si no hay errores se guarda
            if (empty($errores)) {
                $carpetaDestino = 'uploads/';
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0755, true);
                }

                $nombreLimpio = preg_replace('/[^a-zA-Z0-9]/', '', $nombre);
                if (empty($nombreLimpio)) $nombreLimpio = "aprendiz";
                
                $nombreFichero = $nombreLimpio . '_' . time() . '.' . $ext;
                
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $carpetaDestino . $nombreFichero)) {
                    $_SESSION['foto'] = $nombreFichero;
                } else {
                    $errores[] = "Error al guardar la foto en el servidor.";
                }
            }
        }
    }
}

// BLOQUE DE ENVÍO
if ($action === 'ENVIAR' && empty($errores)) {
    
    // Preparar datos
    $asignaturasString = is_array($asignaturas) ? implode(", ", $asignaturas) : $asignaturas;
    $fotoNombre = $_SESSION['foto'] ?? null;

    // Incluir el controlador
    require_once __DIR__ . "/../controllers/AprendizController.php";

    // Usar el controlador
    $controller = new AprendizController();
    
    $idGenerado = $controller->guardar(
        $nombre, 
        $casa, 
        $varita, 
        $asignaturasString, 
        $nivel, 
        $fotoNombre
    );

    if ($idGenerado) {
        // Guardar datos en sesión para resultado.php
        $_SESSION['id_aprendiz'] = $idGenerado;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['casa'] = $casa;
        $_SESSION['varita'] = $varita;
        $_SESSION['asignaturas'] = $asignaturasString;
        $_SESSION['nivel'] = $nivel;
        
        header("Location: resultado.php");
        exit;
    } else {
        $errores[] = "Error al guardar en la base de datos.";
    }
}
?>

<h1>Iván Montiano González</h1>

<?php if (!empty($errores)): ?>
    <ul style="color:red;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif ($action === "VALIDAR" && empty($errores)): ?>
    <h3 style="color:green;">Sin errores. Listo para enviar.</h3>
<?php endif; ?>

<form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token']) ?>">

    <p><label>Nombre del aprendiz:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>">
    </p>

    <p><label>Casa:</label>
        <select name="casa">
            <option value="" <?= $casa == '' ? 'selected' : '' ?>>Seleccione...</option>
            <option value="Gryffindor" <?= $casa == 'Gryffindor' ? 'selected' : '' ?>>Gryffindor</option>
            <option value="Slytherin" <?= $casa == 'Slytherin' ? 'selected' : '' ?>>Slytherin</option>
            <option value="Ravenclaw" <?= $casa == 'Ravenclaw' ? 'selected' : '' ?>>Ravenclaw</option>
            <option value="Hufflepuff" <?= $casa == 'Hufflepuff' ? 'selected' : '' ?>>Hufflepuff</option>
        </select>
    </p>

    <p><label>Varita:</label>
        <select name="varita">
            <option value="" <?= $varita == '' ? 'selected' : '' ?>>Seleccione...</option>
            <option value="Roble" <?= $varita == 'Roble' ? 'selected' : '' ?>>Roble con núcleo de fénix</option>
            <option value="Sauce" <?= $varita == 'Sauce' ? 'selected' : '' ?>>Sauce con núcleo de unicornio</option>
            <option value="Acebo" <?= $varita == 'Acebo' ? 'selected' : '' ?>>Acebo con núcleo de dragón</option>
        </select>
    </p>

    <p><label>Asignaturas favoritas:</label><br>
        <input type="checkbox" name="asignaturas[]" value="Pociones" <?= (is_array($asignaturas) && in_array('Pociones', $asignaturas)) ? 'checked' : '' ?>>Pociones<br>
        <input type="checkbox" name="asignaturas[]" value="Encantamientos" <?= (is_array($asignaturas) && in_array('Encantamientos', $asignaturas)) ? 'checked' : '' ?>>Encantamientos<br>
        <input type="checkbox" name="asignaturas[]" value="Defensa" <?= (is_array($asignaturas) && in_array('Defensa', $asignaturas)) ? 'checked' : '' ?>>Defensa contra las artes oscuras<br>
    </p>

    <p><label>Nivel mágico (1-100):</label>
        <input type="text" name="nivel" min="1" max="100" value="<?= htmlspecialchars($nivel) ?>">
    </p>
    
    <p><label>Foto del aprendiz:</label><br>
        <input type="file" name="foto">
    </p>
    <input type="hidden" name="tamano_maximo" value="2000000">

    <br><br>

    <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !empty($errores)): ?>
        <button type="submit" name="action" value="VALIDAR">VALIDAR</button>
    <?php endif; ?>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errores)): ?>
        <button type="submit" name="action" value="ENVIAR">ENVIAR</button>
    <?php endif; ?>

</form>