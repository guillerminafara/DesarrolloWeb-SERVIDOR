<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejer8</title></head>
<body>
    <form action="Ejer11.php" id="formulario" method="POST">
        <label>Nombre: <input type="text" name="nombre" required></label>
        

        <br>

        <label>Nivel de estudio:</label><br>
        <select name="nivel-estudio" id="nivel-estudio" required>
            <option value="Primaria">Primaria</option>
            <option value="Secundaria">Secundaria</option>
            <option value="Bachillerato">Bachillerato</option>
            <option value="Universidad">Universidad</option>
            <option value="Postgrado">Postgrado</option>
        </select>

        <br>

        <label>Situación actual:</label><br>
        <select name="situacion-actual[]" id="situacion-actual" multiple required>
            <option value="Estudiando">Estudiando</option>
            <option value="Trabajando">Trabajando</option>
            <option value="Buscando Empleo">Buscando Empleo</option>
            <option value="Desempleado">Desempleado</option>
        </select>

        <br>

        <label>Hobbies:</label><br>
        <input type="checkbox" name="hobbies[]" value="Cine"> Cine
        <input type="checkbox" name="hobbies[]" value="Deporte"> Deporte
        <input type="checkbox" name="hobbies[]" value="Literatura"> Literatura
        <input type="checkbox" name="hobbies[]" value="Música"> Música
        <input type="checkbox" name="hobbies[]" value="Cómics"> Cómics
        <input type="checkbox" name="hobbies[]" value="Series"> Series
        <input type="checkbox" name="hobbies[]" value="Videojuegos"> Videojuegos
        <br>
        Otros: <input type="text" name="hobbies[]">

        <br><br>

        <input type="submit" value="Validar">
        <input type="submit" value="Enviar">
        <button type="button" onclick="document.getElementById('formulario').reset()">Borrar</button>
    </form>
</body>
</html>

<?php
    session_start();

    $_SESSION['nombre'] = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    $_SESSION['nivelEstudio'] = isset($_POST['nivel-estudio']) ? $_POST['nivel-estudio'] : null;
    $_SESSION['situacion'] = isset($_POST['situacion-actual']) ? $_POST['situacion-actual'] : [];
    $_SESSION['hobbies'] = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];

    echo "<h2>" . $_SESSION['nombre'] . "</h2>";
    echo "Nivel de estudio:" . $_SESSION['nivelEstudio'] . "<br>";
    echo "Situación actual: ";
    foreach ($_SESSION['situacion'] as $sit) {
        echo $sit . " ";
    }
    echo "<br>Aficiones: ";
    foreach ($_SESSION['hobbies'] as $hobbie) {
        echo $hobbie . " ";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer11</title>
</head>
<body>
    <p><a href="index.html"><?php echo "Volver"; ?></a></p>
</body>
</html>