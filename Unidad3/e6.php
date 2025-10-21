<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    echo " <p></p>";
    <!-- <h2>Comprobación de la caja Fuerte </h2> -->
    <p>Contraseña no tan secreta: 1234</p>
    <form method="POST">
        <label>Ingresa la combinación</label>
        <input type="password" name="combinacion">
    </form>
    <?php
    function principal()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $num = 0;
            do {
                $combinacion = $_POST["combinacion"];
                if (isset($combinacion) && is_numeric($combinacion)) {
                    
                }else{
                    echo " <p>Ingresa solamente números </p>";
                    continue;
                }
                $num++;
            } while ($num < 5);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        principal();
    }
    ?>
</body>

</html>