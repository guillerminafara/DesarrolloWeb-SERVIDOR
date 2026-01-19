<?php
require_once 'funciones.php';
//declaramos variables
$errores = [];
$mensaje = '';
$nombre = '';
$perfilSeleccionado = '';
$password = '';
$success = false;

// Generar token si no existe
if (!isset($_SESSION['token'])) {
    generarTokenFormulario();
}
$token = $_SESSION['token'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //obtener datos del formulario
    $accion = $_POST['accion'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $perfilSeleccionado = $_POST['perfil'] ?? '';
    $password = $_POST['password'] ?? '';
    $tokenPost = $_POST['token'] ?? '';

    if ($accion === 'eliminar') {
        $nombre = '';
        $perfilSeleccionado = '';
        $password = '';
        $errores = [];
        $mensaje = 'Formulario limpiado.';
    } else {
        //validar token y campos
        if (!isset($_POST['token'])) {
            $errores[] = "No se ha encontrado token en el formulario.";
        } elseif (!tokenEsValido($tokenPost)) {
            $errores[] = "El token no coincide. Posible ataque CSRF o SID cambiada.";
        }

        $erroresCampos = validarFormularioLogin($nombre, $perfilSeleccionado, $password);
        $errores = array_merge($errores, $erroresCampos);

        //si hemos dado a validar y las comprobaciones anteriores son correctas
        if ($accion === 'validar' && empty($errores)) {
            $mensaje = "Formulario validado correctamente. Puedes enviarlo.";
            $success = true;
        }
        //se guardan los datos en sesión y se redirige a process.php
        if ($accion === 'enviar' && empty($errores)) {
            header('Location: process.php');
            $_SESSION['post_temp'] = [
                'nombre' => $nombre,
                'perfil' => $perfilSeleccionado,
                'password' => $password,
                'token' => $tokenPost,
            ];
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de la Empresa - Álvaro Verdeguer</title>
</head>
<body>
    <h1>Formulario de autenticación - Álvaro Verdeguer</h1>

    <?php if (!empty($errores)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errores as $e): ?>
                    <li><?php echo htmlspecialchars($e, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($mensaje !== ''): ?>
        <p style="color:green;"><?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <input type="hidden" name="token"
               value="<?php echo htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>">

        <p>
            <label>Nombre de usuario:
                <input type="text" name="nombre"
                       value="<?php echo htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'); ?>">
            </label>
        </p>

        <p>Perfil (rol):</p>
        <p>
            <label>
                <input type="radio" name="perfil" value="Gerente"
                    <?php echo ($perfilSeleccionado === 'Gerente') ? 'checked' : ''; ?>>
                Gerente
            </label><br>
            <label>
                <input type="radio" name="perfil" value="Sindicalista"
                    <?php echo ($perfilSeleccionado === 'Sindicalista') ? 'checked' : ''; ?>>
                Sindicalista
            </label><br>
            <label>
                <input type="radio" name="perfil" value="Responsable de Nóminas"
                    <?php echo ($perfilSeleccionado === 'Responsable de Nóminas') ? 'checked' : ''; ?>>
                Responsable de Nóminas
            </label>
        </p>

        <?php if(!$success): ?>
        <p>
            <label>Contraseña:
                <input type="password" name="password">
            </label>
        </p>
        <?php else: ?>
        <p>
            <label>Contraseña:
                <input type="password" name="password"
                    value="<?php echo htmlspecialchars($password, ENT_QUOTES, 'UTF-8'); ?>">
            </label>
        </p>
        <?php endif; ?>
        <p>
            <button type="submit" name="accion" value="validar">Validar</button>
            <button type="submit" name="accion" value="eliminar">Eliminar</button>
            <button type="submit" name="accion" value="enviar">Enviar</button>
        </p>
    </form>
</body>
</html>