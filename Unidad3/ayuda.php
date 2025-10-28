<?php
// Inicializar variables
$nombre = $_POST['nombre'] ?? '';
$edad = $_POST['edad'] ?? '';
$estudios = $_POST['estudios'] ?? '';
$situacion = $_POST['situacion'] ?? [];
$hobbies = $_POST['hobbies'] ?? [];
$otro_hobby = $_POST['otro_hobby'] ?? '';

$errores = [];

// Si se presiona el botón "Validar"
if (isset($_POST['validar']) || isset($_POST['enviar'])) {
    if (empty($nombre)) $errores['nombre'] = "Debe introducir su nombre.";
    if (empty($edad) || !is_numeric($edad) || $edad <= 0) $errores['edad'] = "Debe introducir una edad válida.";
    if (empty($estudios)) $errores['estudios'] = "Debe seleccionar un nivel de estudios.";
    if (empty($situacion)) $errores['situacion'] = "Debe seleccionar al menos una situación.";
    if (empty($hobbies) && empty($otro_hobby)) $errores['hobbies'] = "Debe elegir o indicar al menos un hobby.";

    // Si se presionó "Enviar" y no hay errores → ir a resultado.php
    if (isset($_POST['enviar']) && empty($errores)) {
        // Guardamos datos en sesión
        session_start();
        $_SESSION['datos'] = [
            'nombre' => $nombre,
            'edad' => $edad,
            'estudios' => $estudios,
            'situacion' => $situacion,
            'hobbies' => $hobbies,
            'otro_hobby' => $otro_hobby
        ];
        header("Location: resultado.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de datos personales</title>
</head>
<body>
    <h2>Formulario de recogida de datos</h2>

    <form method="post" action="formulario.php">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>">
        <span style="color:red"><?= $errores['nombre'] ?? '' ?></span><br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad" value="<?= htmlspecialchars($edad) ?>">
        <span style="color:red"><?= $errores['edad'] ?? '' ?></span><br><br>

        <label>Nivel de estudios:</label><br>
        <select name="estudios">
            <option value="">--Seleccione--</option>
            <option value="Primaria" <?= $estudios == 'Primaria' ? 'selected' : '' ?>>Primaria</option>
            <option value="Secundaria" <?= $estudios == 'Secundaria' ? 'selected' : '' ?>>Secundaria</option>
            <option value="Bachillerato" <?= $estudios == 'Bachillerato' ? 'selected' : '' ?>>Bachillerato</option>
            <option value="Universidad" <?= $estudios == 'Universidad' ? 'selected' : '' ?>>Universidad</option>
        </select>
        <span style="color:red"><?= $errores['estudios'] ?? '' ?></span><br><br>

        <label>Situación actual:</label><br>
        <label><input type="checkbox" name="situacion[]" value="Estudiando" <?= in_array('Estudiando', $situacion) ? 'checked' : '' ?>> Estudiando</label><br>
        <label><input type="checkbox" name="situacion[]" value="Trabajando" <?= in_array('Trabajando', $situacion) ? 'checked' : '' ?>> Trabajando</label><br>
        <label><input type="checkbox" name="situacion[]" value="Buscando empleo" <?= in_array('Buscando empleo', $situacion) ? 'checked' : '' ?>> Buscando empleo</label><br>
        <label><input type="checkbox" name="situacion[]" value="Desempleado" <?= in_array('Desempleado', $situacion) ? 'checked' : '' ?>> Desempleado</label><br>
        <span style="color:red"><?= $errores['situacion'] ?? '' ?></span><br><br>

        <label>Hobbies:</label><br>
        <label><input type="checkbox" name="hobbies[]" value="Leer" <?= in_array('Leer', $hobbies) ? 'checked' : '' ?>> Leer</label><br>
        <label><input type="checkbox" name="hobbies[]" value="Deporte" <?= in_array('Deporte', $hobbies) ? 'checked' : '' ?>> Deporte</label><br>
        <label><input type="checkbox" name="hobbies[]" value="Viajar" <?= in_array('Viajar', $hobbies) ? 'checked' : '' ?>> Viajar</label><br>
        <label><input type="checkbox" name="hobbies[]" value="Cine" <?= in_array('Cine', $hobbies) ? 'checked' : '' ?>> Cine</label><br>
        <label>Otro: <input type="text" name="otro_hobby" value="<?= htmlspecialchars($otro_hobby) ?>"></label>
        <span style="color:red"><?= $errores['hobbies'] ?? '' ?></span><br><br>

        <input type="submit" name="validar" value="Validar">
        <input type="submit" name="enviar" value="Enviar">

    </form>
</body>
</html>
