<?php
    $nombre = "Guillermina";
    $hora = date("H:i:s");
   
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Nombre- Hora</title>

</head>

<body>
    <h1>Diferencia de ejecución cliente-servidor</h1>
    <p id="nombre">Hola! soy: <?= $nombre ?> </p>
    <p id="hora">La hora Actual es: <?= $hora ?> </p>
</body>

</html>