<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div {
            background-color: #8bfff090;
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }
    </style>
</head>

<?php
// Variables con valores previos o vacíos
$nombre = $_POST["nombre"] ?? "";
$apellido = $_POST["apellido"] ?? "";
$edad = $_POST["edad"] ?? "";
$peso = $_POST["peso"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$estado = $_POST["EstadoCivil"] ?? "";
$aficiones = $_POST["aficiones"] ?? [];
?>

<form action="" method="POST">
    <h2>Formulario ejercicio 10</h2>

    <label>Nombre: 
        <input type="text" name="nombre" required value="<?= htmlspecialchars($nombre) ?>">
    </label><br><br>

    <label>Apellido: 
        <input type="text" name="apellido" required value="<?= htmlspecialchars($apellido) ?>">
    </label><br><br>

    <label>Edad: 
        <input type="text" name="edad" value="<?= htmlspecialchars($edad) ?>">
    </label><br><br>

    <label>Peso: 
        <input type="text" name="peso" required value="<?= htmlspecialchars($peso) ?>">
    </label><br><br>

    <h3>Sexo:</h3>
    <label><input type="radio" name="sexo" value="Mujer" <?= ($sexo=="Mujer"?"checked":"") ?>> Mujer</label><br>
    <label><input type="radio" name="sexo" value="Hombre" <?= ($sexo=="Hombre"?"checked":"") ?>> Hombre</label><br>
    <label><input type="radio" name="sexo" value="No responde" <?= ($sexo=="No responde"?"checked":"") ?>> Prefiero no responder</label><br>

    <h3>Estado Civil:</h3>
    <?php 
    $opciones = ["Soltero","Casado","Divorciado","Viudo"];
    foreach ($opciones as $op): ?>
        <label>
            <input type="radio" name="EstadoCivil" value="<?= $op ?>" <?= ($estado==$op?"checked":"") ?>> <?= $op ?>
        </label><br>
    <?php endforeach; ?>

    <h3>Aficiones:</h3>
    <?php 
    $lista = ["Cine","Deporte","Literatura","Musica","Comics","Series","Videojuegos"];
    foreach ($lista as $a): ?>
        <label>
            <input type="checkbox" name="aficiones[]" value="<?= $a ?>" 
                <?= (in_array($a, $aficiones)?"checked":"") ?>> <?= $a ?>
        </label><br>
    <?php endforeach; ?>
<br>

    <button type="submit" name="valida">Validar</button>
    <button type="submit" id="boton" name="enviar" formaction="salidaE10.php" disabled>Enviar</button>
    <button type="reset">Borrar</button>
</form>

<body>
<?php 
require_once "comprobaciones.php";

if (isset($_POST["valida"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

    $bandera = comprobarEdad($edad);
    $bandera2 = comprobarPeso($peso);
    $bandera3 = comprobarCasillasAficiones();

    if ($bandera) echo "<p id='bien'>Edad correcta</p>";
    else echo "<p id='mal'>Edad errónea</p>";

    if ($bandera2) echo "<p id='bien'>Peso correcto</p>";
    else echo "<p id='mal'>Peso fuera de rango</p>";

    validarTodo($bandera, $bandera2, $bandera3);
}

function validarTodo($bandera, $bandera2, $bandera3)
{
    if ($bandera && $bandera2 && $bandera3) {
        echo "<script>document.getElementById('boton').disabled = false;</script>";
        echo "<p style='color:green;'>Todos los datos son correctos, envíalos</p>";
    }
}

function comprobarPeso($peso)
{
    return is_numeric($peso) && $peso > 10 && $peso < 150;
}

function comprobarEdad($edad)
{
    return is_numeric($edad) && $edad >= 1 && $edad <= 120;
}

function comprobarCasillasAficiones()
{
    if (isset($_POST["aficiones"]) && !empty($_POST["aficiones"])) {
        echo "<p id='bien'>Aficiones correctas</p>";
        return true;
    } 
    echo "<p id='mal'>Aficiones incorrectas</p>";
    return false;
}
?>

<div>
    <p>Fara Santeyana María Guillermina · 2do DAW</p>
</div>

</body>
</html>
