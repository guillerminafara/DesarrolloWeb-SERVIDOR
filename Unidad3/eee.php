<?php
session_start();

// Inicializar sesión (combinación y contador) si no existe o si se solicita reiniciar
if (!isset($_SESSION['combo']) || (isset($_POST['action']) && $_POST['action'] === 'reset')) {
    // Generar combinación de 4 cifras (con ceros iniciales)
    $_SESSION['combo'] = str_pad((string)rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $_SESSION['intentos'] = 0;
    $_SESSION['abierta'] = false;
    $mensaje = '';
}

// Variables de sesión
$combo = $_SESSION['combo'];
$intentos = $_SESSION['intentos'];
$maxIntentos = 4;
$abierta = $_SESSION['abierta'];
$mensaje = $mensaje ?? '';
$clase = ''; // para color

// Procesar envío del formulario de intento
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo']) && !$_SESSION['abierta']) {
    $codigoUsuario = trim($_POST['codigo']);

    // Validar que sean exactamente 4 dígitos (permitimos '0123' etc)
    if (!preg_match('/^\d{4}$/', $codigoUsuario)) {
        $mensaje = "Introduce una combinación de 4 dígitos (ej. 0123).";
        $clase = 'warning';
    } else {
        // Aumentar contador sólo si aún quedan intentos
        if ($_SESSION['intentos'] < $maxIntentos) {
            $_SESSION['intentos']++;
            $intentos = $_SESSION['intentos'];

            if ($codigoUsuario === $combo) {
                $mensaje = "La caja fuerte se ha abierto satisfactoriamente.";
                $clase = 'success';
                $_SESSION['abierta'] = true;
                $abierta = true;
            } else {
                if ($intentos >= $maxIntentos) {
                    $mensaje = "Lo siento, esa no es la combinación. No quedan más intentos.";
                    $clase = 'error';
                } else {
                    $quedan = $maxIntentos - $intentos;
                    $mensaje = "Lo siento, esa no es la combinación. Te quedan $quedan intento(s).";
                    $clase = 'error';
                }
            }
        } else {
            $mensaje = "No quedan intentos. Pulsa Reiniciar para volver a intentarlo.";
            $clase = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Caja fuerte — Control de acceso</title>
    <style>
        body { font-family: Arial, sans-serif; max-width:640px; margin:40px auto; padding:0 16px; }
        h1 { color:#333; }
        form { margin-top:16px; }
        input[type="text"] { font-size:1rem; padding:8px; width:120px; text-align:center; }
        button { padding:8px 12px; font-size:1rem; margin-right:8px; }
        .msg { margin-top:16px; padding:10px 12px; border-radius:6px; }
        .success { background:#e6ffed; color:#0a5b21; border:1px solid #8ee0a5; }
        .error { background:#ffecec; color:#a90000; border:1px solid #f5a9a9; }
        .warning { background:#fff4e5; color:#7a5a00; border:1px solid #f0d8a5; }
        .info { background:#eef6ff; color:#084b8a; border:1px solid #bcdff7; }
        .status { margin-top:12px; font-size:0.95rem; color:#333; }
        .combo-debug { margin-top:12px; font-weight:bold; }
    </style>
</head>
<body>
    <h1>Control de acceso — Caja fuerte</h1>

    <p>Introduce la combinación de 4 cifras para abrir la caja. <br>
       <small>Nota: la combinación se muestra solo para pruebas.</small>
    </p>

    <!-- Mostrar combinación (para pruebas) -->
    <div class="combo-debug">Combinación (prueba): <strong><?= htmlspecialchars($combo) ?></strong></div>

    <!-- Estado e intentos -->
    <div class="status">
        Intentos realizados: <?= htmlspecialchars((string)$intentos) ?> / <?= $maxIntentos ?>.
        <?php if ($abierta): ?>
            <span> — <strong style="color:green">Caja abierta</strong></span>
        <?php endif; ?>
    </div>

    <!-- Mensaje resultante -->
    <?php if (!empty($mensaje)): ?>
        <div class="msg <?= $clase ?>"><?= nl2br(htmlspecialchars($mensaje)) ?></div>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="post" autocomplete="off">
        <label for="codigo">Combinación:</label>
        <input id="codigo" name="codigo" type="text" maxlength="4" pattern="\d{4}" placeholder="0123"
               value="" <?= $abierta || $intentos >= $maxIntentos ? 'disabled' : '' ?> >
        <button type="submit" <?= $abierta || $intentos >= $maxIntentos ? 'disabled' : '' ?>>Probar</button>

        <!-- Reiniciar -->
        <button type="submit" name="action" value="reset" formaction="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">Reiniciar</button>
    </form>

    <p style="margin-top:18px; font-size:0.9rem; color:#555">
        Al reiniciar se genera una nueva combinación y se restablecen los intentos.
    </p>
</body>
</html>
