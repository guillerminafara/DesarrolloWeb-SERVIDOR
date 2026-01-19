<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejer8</title></head>
<body>
    <form action="Ejer12.php" id="formulario" method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label>
        

        <br>

        <label>Apellidos: <input type="text" name="apellidos" required></label>

        <br>

        <label>Edad: <input type="number" name="edad" min="18" max="100" required></label>

        <br>

        <label>Peso: <input type="number" name="peso" min="10" max="150" required></label>

        <br>

        <label>Sexo: <input type="text" name="sexo" required></label>

        <br>

        <label>Estado Civil:</label><br>
        <input type="radio" id="soltero" name="estado-civil" value="Soltero" required>
        <label for="soltero">Soltero</label>
        <input type="radio" id="casado" name="estado-civil" value="Casado">
        <label for="casado">Casado</label>
        <input type="radio" id="viudo" name="estado-civil" value="Viudo">
        <label for="viudo">Viudo</label>
        <input type="radio" id="divorciado" name="estado-civil" value="Divorciado">
        <label for="divorciado">Divorciado</label>
        <input type="radio" id="otro" name="estado-civil" value="Otro">
        <label for="otro">Otro</label>
        <input type="text" name="estado-civil-otro">
        <br>

        <br>

        <label>Aficiones:</label><br>
        <input type="checkbox" name="aficiones[]" value="Cine"> Cine
        <input type="checkbox" name="aficiones[]" value="Deporte"> Deporte
        <input type="checkbox" name="aficiones[]" value="Literatura"> Literatura
        <input type="checkbox" name="aficiones[]" value="Música"> Música
        <input type="checkbox" name="aficiones[]" value="Cómics"> Cómics
        <input type="checkbox" name="aficiones[]" value="Series"> Series
        <input type="checkbox" name="aficiones[]" value="Videojuegos"> Videojuegos

        <br><br>

        <input type="submit" value="Validar">
        <input type="submit" value="Enviar">
        <button type="button" onclick="document.getElementById('formulario').reset()">Borrar</button>
    </form>
</body>
</html>

<?php
    $_SESSION['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $_SESSION['apellidos'] = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
    $_SESSION['edad'] = isset($_POST['edad']) ? $_POST['edad'] : null;
    $_SESSION['peso'] = isset($_POST['peso']) ? $_POST['peso'] : null;
    $_SESSION['sexo'] = isset($_POST['sexo']) ? $_POST['sexo'] : null;

    $seleccion_radio = $_POST['estado-civil'] ?? null;
    $texto_otro = $_POST['estado-civil-otro'] ?? null;
    if ($seleccion_radio === 'Otro' && !empty($texto_otro)) {
        $_SESSION['estadoCivil'] = $texto_otro;
    } else {
        $_SESSION['estadoCivil'] = $seleccion_radio;
    }

    $_SESSION['aficiones'] = isset($_POST['aficiones']) ? $_POST['aficiones'] : [];
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados</title>
</head>
<body>

    <h2><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></h2>
    
    <p>
        <strong>Edad:</strong> <?php echo $_SESSION['edad']; ?><br>
        <strong>Peso:</strong> <?php echo $_SESSION['peso']; ?><br>
        <strong>Sexo:</strong> <?php echo $_SESSION['sexo']; ?><br>
        
        <strong>Estado Civil:</strong> <?php echo $_SESSION['estadoCivil']; ?>
    </p>

    <p><strong>Aficiones:</strong>
    <?php
        if (!empty($_SESSION['aficiones'])) {
            foreach ($_SESSION['aficiones'] as $aficion) {
                echo $aficion . " ";
            }
        } else {
            echo "Ninguna";
        }
    ?>
    </p>

    <p><a href="index.html">Volver</a></p>

</body>
</html>