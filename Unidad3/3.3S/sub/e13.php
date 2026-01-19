<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejer11</title>
</head>
<body>
    <form action="Ejer13.php" id="formulario" method="POST" enctype="multipart/form-data">
        <label>Nombre completo: <input type="text" name="nombre" required></label><br>

        <label>Apellidos: <input type="text" name="apellidos" required></label><br>

        <label>Contraseña: <input type="password" name="contrasena" minlength="6" required></label><br><br>

        <label>Nivel de estudio:</label><br>
        <select name="nivel-estudio" id="nivel-estudio" required>
            <option value="Sin estudios">Sin estudios</option>
            <option value="Educación Secundaria Obligatoria">Educación Secundaria Obligatoria</option>
            <option value="Bachillerato">Bachillerato</option>
            <option value="Formación Profesional">Formación Profesional</option>
            <option value="Estudios Universitarios">Estudios Universitarios</option>
        </select>
        
        <br><br>

        <label>Nacionalidad:</label><br>
        <input type="radio" id="espanola" name="nacionalidad" value="Española" required>
        <label for="espanola">Española</label>
        <input type="radio" id="otro" name="nacionalidad" value="Otro">
        <label for="otro">Otro</label>
        <input type="text" name="nacionalidad-otra"><br><br>

        <label>Idiomas:</label><br>
        <input type="checkbox" name="idiomas[]" value="Español"> Español
        <input type="checkbox" name="idiomas[]" value="Inglés"> Inglés
        <input type="checkbox" name="idiomas[]" value="Francés"> Francés
        <input type="checkbox" name="idiomas[]" value="Alemán"> Alemán
        <input type="checkbox" name="idiomas[]" value="Italiano"> Italiano<br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        
        <br>

        <label>Imágen (solo jpg, gif, png - max 50 KB):</label>
        <input type="file" name="imagen" accept="image/jpeg, image/gif, image/png" required><br><br>

        <input type="submit" name="validar" value="Validar">
        <input type="submit" name="enviar" value="Enviar">
        <button type="button" onclick="document.getElementById('formulario').reset()">Borrar</button>
    </form>
</body>
</html>


<?php
session_start();

$_SESSION['nombre'] = $_POST['nombre'] ?? null;
$_SESSION['apellidos'] = $_POST['apellidos'] ?? null;
$_SESSION['nivelEstudio'] = $_POST['nivel-estudio'] ?? null;
$_SESSION['nacionalidad'] = $_POST['nacionalidad'] ?? null;

if ($_SESSION['nacionalidad'] === "Otro" && !empty($_POST['nacionalidad-otra'])) {
    $_SESSION['nacionalidad'] = $_POST['nacionalidad-otra'];
}

$_SESSION['idiomas'] = $_POST['idiomas'] ?? [];
$_SESSION['email'] = $_POST['email'] ?? null;

$nombre = $_SESSION['nombre'];
$apellidos = $_SESSION['apellidos'];
$nivelEstudio = $_SESSION['nivelEstudio'];
$nacionalidad = $_SESSION['nacionalidad'];
$idiomas = $_SESSION['idiomas'];
$email = $_SESSION['email'];

echo "<h2>$nombre $apellidos</h2>";
echo "$email<br>";
echo "Nivel de estudio: $nivelEstudio<br>";
echo "Nacionalidad: $nacionalidad<br>";
echo "Idiomas: ";

foreach ($idiomas as $idioma) {
    echo $idioma . " ";
}

echo "<br><br>";

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {

    $imagenTmp = $_FILES['imagen']['tmp_name'];
    $imagenData = file_get_contents($imagenTmp);
    $imagenBase64 = base64_encode($imagenData);

    echo "<img src='data:image/jpeg;base64,$imagenBase64' width='200'>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer11</title>
</head>
<body>
    <p><a href="index.html">Volver</a></p>
</body>
</html>