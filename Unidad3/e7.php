<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            border: 3px solid purple;
        }
    </style>
</head>

<body>
    <form method="POST">
        <br><br>
        <label>Seleciona el curso para asistir: </label>
        <br><br>
        <label>DAM 1: <input type="radio" name="curso" value="DAM1" required></label>
        <br>
        <label>DAW 1: <input type="radio" name="curso" value="DAW1" required></label>
        <br><br>
        <label for="asignaturas"> Escoge una asignatura: </label>
        <br>
        <select id="asignaturas" name="asignaturas[]" multiple size="5">
            <option value="Programacion">Programacion</option>
            <option value="Sistemas">Sistemas</option>
            <option value="Base de Datos">Base de Datos</option>
            <option value="Entorno de desarrollo">Entorno de desarrollo</option>
            <option value="FOL">FOL</option>
        </select>
        <br><br>
        <label><input type="checkbox" name="horario[]" value="8">08:00-10:00</label>
        <br>
        <label><input type="checkbox" name="horario[]" value="10">10:00-12:00</label>
        <br>
        <label><input type="checkbox" name="horario[]" value="12">12:00-14:00</label>
        <br>
        <label><input type="checkbox" name="horario[]" value="14">14:00-16:00</label>
        <br><br>
        <button type="submit">Arma tu horario</button>
        <li></li>
    </form>
    <table></table>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $curso = $_POST["curso"];
    }

    $curso = $_POST["curso"];
    $asignaturas = $_POST["asignaturas"];
    $horarios = $_POST["horario"];
    $cont = 0;

    echo "<h3>Curso seleccionado</h3>";

    //  echo "asignaturas escogidas: $asignaturas <br> \n";
    
    if (!empty($asignaturas)) {
        echo "<table>";
        echo "<th> $curso</th>";

        foreach ($asignaturas as $asignatura) {
            echo "<tr>";
            echo " <td> $asignatura</td>";
            echo "<td> $horarios[$cont]</td>";
            echo "</tr>";
            $cont++;
        }
        echo "</table>";
    }


    ?>
</body>

</html>