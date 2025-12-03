<?php
session_start();
$mail1Anterior= $_SESSION["mail"];
$mail2Anterior= $_SESSION["mail"];

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
        <label>Ingresa tu mail: <input type="text" name="mail" placeholder="ejemplo@mail.com"></label>
        <br><br>
        <label>Confirma tu mail: <input type="text" name="mail2" placeholder="ejemplo@mail.com"></label>
        <br><br>
        <label> <input type="checkbox" name="acepta"> Acepta recibir notificaciones</label>
        <br><br>
        <button type="sumbit">Enviar </button><button type="reset">Borrar </button>

    </form>

   
</body>

</html>