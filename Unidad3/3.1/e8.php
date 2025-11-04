<!-- 8.Escribe un formulario que solicite una dirección de correo, que la confirme e indique si acepta
recibir publicidad. Añade botón Enviar y Borrar. El botón borrar se mantendrá en el mismo
formulario inicial pero limpiará todos los campos. Cuando pulsemos Enviar, iremos a otra página
donde se le indique el email y si ha aceptado recibir publicidad o no con un botón que volverá a la
página inicial. -->

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
    <h2>Confirmador de mail</h2>
    <form action="salidaE8.php" method="POST">
        <label>Ingresa tu mail: <input type="text" name="mail" placeholder="ejemplo@mail.com"></label>
        <br><br>
        <label>Confirma tu mail: <input type="text" name="mail2" placeholder="ejemplo@mail.com"></label>
        <br><br>
        <label> <input type="checkbox" name="acepta"> Acepta recibir notificaciones</label>
        <br><br>
        <button type="sumbit">Enviar </button><button type="reset">Borrar </button>

    </form>

    <div>
        <p>Fara Santeyana María Guillermina  ·  2do DAW</p>
    </div>
</body>

</html>