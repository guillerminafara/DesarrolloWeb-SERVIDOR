<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo con Cookies</title>
</head>
<body>

<h2>Formulario de saludo o despedida</h2>

<form method="POST">
    <label>Nombre: 
        <input type="text" name="nombre" required>
    </label>
    <br><br>

    <label>¿Qué prefieres?</label><br>
    <label><input type="radio" name="accion" value="saludo" required> Saludo</label><br>
    <label><input type="radio" name="accion" value="despedida" required> Despedida</label><br><br>

    <button type="submit">Enviar</button>
</form>

<hr>

<?php
// --- FUNCIÓN AUXILIAR ---
function generarMensaje($accion, $nombre) {
    if ($accion === "saludo") return "👋 Hola, $nombre";
    else return "👋 Adiós, $nombre";
}

// --- LEER COOKIES ANTERIORES ---
$nombreAnterior = $_COOKIE['nombre'] ?? null;
$accionAnterior = $_COOKIE['accion'] ?? null;

// --- PROCESAR ENVÍO ACTUAL ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombreActual = $_POST['nombre'];
    $accionActual = $_POST['accion'];

    // Mostrar los valores anteriores (si existían)
    if ($nombreAnterior && $accionAnterior) {
        echo "<h3>🕓 Valores anteriores guardados en cookie:</h3>";
        echo "<p>Nombre anterior: <strong>" . htmlspecialchars($nombreAnterior) . "</strong></p>";
        echo "<p>Acción anterior: <strong>" . htmlspecialchars($accionAnterior) . "</strong></p>";
        echo "<p>" . generarMensaje($accionAnterior, $nombreAnterior) . "</p><hr>";
    } else {
        echo "<p>No había cookies previas almacenadas.</p><hr>";
    }

    // Mostrar los valores actuales del formulario
    echo "<h3>✅ Valores actuales enviados:</h3>";
    echo "<p>Nombre actual: <strong>" . htmlspecialchars($nombreActual) . "</strong></p>";
    echo "<p>Acción actual: <strong>" . htmlspecialchars($accionActual) . "</strong></p>";
    echo "<p>" . generarMensaje($accionActual, $nombreActual) . "</p>";

    // Guardar cookies nuevas (reemplazan las anteriores)
    setcookie('nombre', $nombreActual, time() + 3600, '/');
    setcookie('accion', $accionActual, time() + 3600, '/');

    echo "<p><em>Las nuevas cookies se aplicarán al recargar la página o en el siguiente envío.</em></p>";
}
?>
</body>
</html>
