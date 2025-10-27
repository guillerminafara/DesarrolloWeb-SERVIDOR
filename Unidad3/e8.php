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
</head>
<body>
    <form method="POST">
    <label >Ingresa tu mail: <input type="text" placeholder="ejemplo@mail.com"></label>

    <button type="sumbit">Enviar </button><button type="sumbit">Borrar </button> 

    </form>
    <?php
         if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
         }
    ?>
</body>
</html>