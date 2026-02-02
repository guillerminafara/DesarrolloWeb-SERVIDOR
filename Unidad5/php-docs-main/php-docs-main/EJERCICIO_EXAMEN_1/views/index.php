<?php
session_start();
require_once '../utils/funciones.php';
crearTokenFormulario();

$datos_previos = obtenerDatosSesion('datos_previos', []);
$errores = $_SESSION['errores'] ?? [];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario Principal Empresa</title>
    <style>.error { color: red; } .msg-error { border: 1px solid red; padding: 10px; list-style: none; }</style>
</head>
<body>

    <h1>Registro de Usuario - Sistema Empresa</h1>

    <?php if (!empty($errores)): ?>
        <ul class="msg-error">
            <?php foreach ($errores as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    <form action="formController.php" method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> 

        <fieldset>
            <legend>Datos de Usuario</legend>

            <label for="nombre">Nombre Completo:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>"><br><br>

            <label for="email">Correo Electrónico:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

            <label for="rol">Rol:</label><br>
            <select name="rol" id="rol">
                <option value="ventas" <?php echo ($rol_sel === 'ventas') ? 'selected' : ''; ?>>Ventas</option>
                <option value="marketing" <?php echo ($rol_sel === 'marketing') ? 'selected' : ''; ?>>Marketing</option>
                <option value="usuarios" <?php echo ($rol_sel === 'usuarios') ? 'selected' : ''; ?>>Usuarios</option>
            </select><br><br>

            <input type="checkbox" name="terminos" id="terminos" value="1">
            <label for="terminos">Acepto los términos y condiciones</label><br><br>

            <label for="imagen">Subir fotografía:</label><br>
            <input type="file" name="imagen" id="imagen"><br><br>

            <button type="submit" name="accion" value="validar">Validar</button>
            <button type="submit" name="accion" value="enviar">Enviar</button>
            <button type="reset" name="accion" value="eliminar">Eliminar</button>

        </fieldset>
    </form>

</body>
</html>