<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <br><br>
        <label>Seleciona el curso para asistir: </label>
        <label></label>
        <label>DAM 1: <input type="radio" name="curso" value="dam1" required></label>
        <br>
        <label>DAW 2: <input type="radio" name="curso" value="daw1" required></label>
        <br><br>
        <label for="asignaturas"> Asignaturas</label>
        <select name="asignaturas" id="asignaturas">
            <option value="op1">Programacion</option>
            <option value="op1">Sistemas</option>
            <option value="op1">Base de Datos</option>
            <option value="op1">Entorno de desarrollo</option>
            <option value="op1">FOL</option>
        </select>
        <label><input type="checkbox" name="seleccion" value="8">08:00-10:00</label>
        <label><input type="checkbox" name="seleccion" value="10">10:00-12:00</label>
        <label><input type="checkbox" name="seleccion" value="12">12:00-14:00</label>
        <label><input type="checkbox" name="seleccion" value="14">14:00-16:00</label>

        <button>Arma tu horario</button>

    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $curso = $_POST["curso"];
    }
    ?>
</body>

</html>