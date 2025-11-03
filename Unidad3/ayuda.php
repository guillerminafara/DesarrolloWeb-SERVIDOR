<!DOCTYPE html>
<html>

<head>
    <title> Formulario </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <?php if ($errores): ?> <ul style="color: #f00;">
            <?php foreach ($errores as $error): ?>
                <li> <?php echo $error ?>
                </li> <?php endforeach; ?>
        </ul>

    <?php endif; ?>
    <form method="post" action="index.php">
        <label> Nombre </label><br /> <input type="text" name="nombre" value="<?php echo $nombre ?>" /><br />
        <label> Edad </label><br /> <input type="text" name="edad" size="3" value="<?php echo $edad ?>" /><br />
        <label> E-mail </label><br /> <input type="text" name="email" value="<?php echo $email ?>" /><br />
        <input type="submit" value="Enviar" />
    </form>
</body>

</html>