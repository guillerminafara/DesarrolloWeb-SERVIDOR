<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #mal {
            color: red;
        }

        #bien {
            color: green;
        }

        button {
            margin: 10px;
            padding: 5px;
        }

        div {
            background-color: #8bfff090;
            position: fixed;
            bottom: 20px;
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }
    </style>
</head>

<body>
    <h2>Confirmador de mail</h2>
    <h3>Salida: </h3>
    <p></p>

    <?php
    require_once "comprobaciones.php";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $mail = $_POST["mail"] ?? "";
        $mail2 = $_POST["mail2"] ?? "";
        $acepta = isset($_POST["acepta"]) ? "ACEPTA" : "NO ACEPTA";
        if (comprobarMail($mail) && comprobarCoincidencia($mail, $mail2)) {
            echo "<p>$mail</p>";
            echo "<p id='bien'> mail correcto<p>";
            echo "<p>el usuario con mail $mail $acepta recibir publicidad</p>";
        } else {
            echo "<p>$mail</p>";
            echo "<p id='mal'> Mail incorrecto<p>";
        }
    }

    function comprobarCoincidencia($mail, $mail2)
    {
        return $mail === $mail2 ? true : false;
    }
    ?>
    <form action="e8.php" method="post">
        <button type="submit">Atrás</button>
    </form>
    <div>
        <p>Fara Santeyana María Guillermina · 2do DAW</p>
    </div>
</body>

</html>