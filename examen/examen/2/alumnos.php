<?php
// Alumno: CorsoCoder
// Formulario principal. Muestra datos tomando $form_data si es incluido por process.php.
// Si se accede directamente, prepara datos vacíos y token.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/validaciones.php';

// Si no hay token en sesión, generarlo.
if (!isset($_SESSION['csrf_token'])) {
    generate_csrf_token();
}

// $form_data y $errors pueden llegar definidos desde process.php (via include).
if (!isset($form_data)) {
    // Importar datos desde sesión si existen, para no perder valores al validar
    if (isset($_SESSION['alumno_data']) && is_array($_SESSION['alumno_data'])) {
        $form_data = $_SESSION['alumno_data'];
    } else {
        $form_data = [
            'nombre' => '',
            'usuario' => '',
            'email' => '',
            'password' => '',
            'cp' => '',
            'direccion' => '',
            'alojamiento' => [],
            'preferencias' => [],
            'tipo_alquiler' => '',
            'estado' => '',
            'csrf_token' => $_SESSION['csrf_token'] ?? ''
        ];
    }
}
if (!isset($errors)) {
    $errors = [];
}

// Nombre del usuario para el título (tomamos campo "usuario")
$usuarioTitulo = val('usuario', 'Usuario');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alumnos - Formulario</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>

<h1 style="color:blue"><?php echo htmlspecialchars($usuarioTitulo, ENT_QUOTES, 'UTF-8'); ?></h1>

<!-- Mensaje de bienvenida para usuario nuevo -->
<?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'nuevo' && isset($_SESSION['fecha_registro'])): ?>
    <p>Bienvenido, usuario nuevo. Fecha de registro: <?php echo htmlspecialchars($_SESSION['fecha_registro'], ENT_QUOTES, 'UTF-8'); ?></p>
<?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'nuevo' && !isset($_SESSION['fecha_registro'])): ?>
    <p>Bienvenido, usuario nuevo.</p>
<?php endif; ?>

<form action="process.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

    <fieldset>
        <legend>Datos personales</legend>
        <label>Nombre:
            <input type="text" name="nombre" value="<?php echo val('nombre'); ?>">
        </label><br>

        <label>Usuario:
            <input type="text" name="usuario" value="<?php echo val('usuario'); ?>">
        </label><br>

        <label>Email:
            <input type="email" name="email" value="<?php echo val('email'); ?>">
        </label><br>

        <label>Contraseña:
            <input type="password" name="password" value="<?php echo val('password'); ?>">
        </label><br>

        <label>Código Postal (CP):
            <input type="text" name="cp" value="<?php echo val('cp'); ?>" maxlength="5">
        </label><br>
    </fieldset>

    <fieldset>
        <legend>Dirección y alojamiento</legend>
        <label>Dirección:
            <select name="direccion">
                <option value="">-- Seleccione --</option>
                <?php
                $dirs = ['calle' => 'Calle', 'avenida' => 'Avenida', 'plaza' => 'Plaza'];
                foreach ($dirs as $k => $label):
                    $selected = (val('direccion') === $k) ? 'selected' : '';
                ?>
                    <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>

        <p>Tipo de alojamiento (múltiple):</p>
        <?php
        $aloj = ['piso', 'chalet', 'cabaña', 'casa rural', 'apartamento'];
        $seleccionados = isset($form_data['alojamiento']) && is_array($form_data['alojamiento']) ? $form_data['alojamiento'] : [];
        foreach ($aloj as $opt):
            $checked = in_array($opt, $seleccionados, true) ? 'checked' : '';
        ?>
            <label>
                <input type="checkbox" name="alojamiento[]" value="<?php echo $opt; ?>" <?php echo $checked; ?>>
                <?php echo ucfirst($opt); ?>
            </label>
        <?php endforeach; ?>
        <br>

        <label>Preferencias de alojamiento (lista múltiple):
            <select name="preferencias[]" multiple size="6">
                <?php
                $prefs = ['zona comercial', 'piscina', 'parking', 'parque infantil', 'transporte público', 'amueblado'];
                $prefSel = isset($form_data['preferencias']) && is_array($form_data['preferencias']) ? $form_data['preferencias'] : [];
                foreach ($prefs as $p):
                    $selected = in_array($p, $prefSel, true) ? 'selected' : '';
                ?>
                    <option value="<?php echo $p; ?>" <?php echo $selected; ?>><?php echo ucfirst($p); ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>

        <p>Tipo de alquiler:</p>
        <?php
        $tipos = ['días', 'semanas', 'meses'];
        $tipoSel = val('tipo_alquiler');
        foreach ($tipos as $t):
            $checked = ($tipoSel === $t) ? 'checked' : '';
        ?>
            <label>
                <input type="radio" name="tipo_alquiler" value="<?php echo $t; ?>" <?php echo $checked; ?>> <?php echo ucfirst($t); ?>
            </label>
        <?php endforeach; ?>
        <br>

        <label>Estado del usuario:
            <select name="estado">
                <option value="">-- Seleccione --</option>
                <?php
                $estados = ['registrado' => 'Usuario ya registrado', 'nuevo' => 'Usuario nuevo'];
                $estadoSel = val('estado');
                foreach ($estados as $k => $label):
                    $selected = ($estadoSel === $k) ? 'selected' : '';
                ?>
                    <option value="<?php echo $k; ?>" <?php echo $selected; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>

        <label>Foto:
            <input type="file" name="foto" accept=".jpg,.jpeg,.png,.gif">
        </label><br>
    </fieldset>

    <hr>

    <button type="submit" name="accion" value="limpiar">Limpiar</button>
    <button type="submit" name="accion" value="validar">Validar</button>
    <button type="submit" name="accion" value="enviar">Enviar</button>
    <button type="submit" name="accion" value="regenerar_token">Regenerar token</button>

</form>

<?php if (!empty($errors)): ?>
    <div class="error">
        <h3>Errores de validación</h3>
        <ul>
            <?php foreach ($errors as $e): ?>
                <li><?php echo htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Logout por POST -->
<form action="logout.php" method="post" style="margin-top:20px;">
    <button type="submit" name="accion" value="logout">Cerrar sesión</button>
</form>

</body>
</html>