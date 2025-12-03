<?php
session_start();
$mail1Anterior = $_SESSION["mail"] ?? null;
$mail2Anterior = $_SESSION["mail2"] ?? null;
$aceptaAnterior=null;
$bandera = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail1 = $_POST["mail"];
    $mail2 = $_POST["mail2"];
    $acepta = isset($_POST["acepta"]) ? "Sí" : "No";

    $aceptaAnterior = $acepta ?? null;
    if (comprobar($mail1, $mail2)) {

        $bandera = true;
    }
}

?>
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
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }

        button {
            margin: 10px;
            padding: 5px;
        }
    </style>
</head>

<body>

    <h2>Confirmador de mail - Guillermina Fara</h2>
    <form method="POST">
        <label>Ingresa tu mail: <input type="text" name="mail" placeholder="ejemplo@mail.com" ></label>
        <br><br>
        <label>Confirma tu mail: <input type="text" name="mail2" placeholder="ejemplo@mail.com"></label>
        <br><br>
        <label> <input type="checkbox" name="acepta"> Acepta recibir notificaciones</label>
        <br><br>
        <button type="sumbit">Enviar </button><button type="reset">Borrar </button>

    </form>
    <?php
    echo "<h3>Salida Actual:</h3>";
    if (isset($mail1) && isset($mail2) && isset($acepta)) {
        if ($bandera) {
            echo "Mail: $mail1, $acepta acepta recibir publicidad";
            $_SESSION["mail"] =  $mail1;
            $_SESSION["mail2"] = $mail2;
            $_SESSION["acepta"] = $acepta;
        } else {
            echo "<p>Los mails deben coincidir</p>";
        }
    } else {
        echo "<p>Aún no hay datos almacenados</p>";
    }

    echo "<h3>Salida Anterior:</h3>";
    if (isset($_SESSION["mail"]) && isset($_SESSION["mail2"]) && isset($_SESSION["acepta"])) {

        echo "Mail:$mail1Anterior , $aceptaAnterior acepta recibir publicidad";
    } else {
        echo "<p>Aún no hay datos almacenados</p>";
    }

    function comprobar($mail, $mail2)
    {
        return $mail === $mail2 ? true : false;
    }
    ?>
</body>

</html>