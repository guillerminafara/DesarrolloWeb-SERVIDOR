<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method="POST">
        <br>
        <br>
        <label>Ingresa un caracter: <input type="text" name="caracter" required></label>
        <br>
        <br>
        <button type="submit">Comprobar</button>
    </form>

    <?php
    function ejercicio()
    {
        require_once "comprobaciones.php";
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $caracter = $_POST["caracter"];

            if (strlen($caracter) != 1) {
                echo "<p>Ingresa solo 1 caracter >:( </p>";
                return;
            }

            if ($caracter !== null) {
                if (comprobarNumeric($caracter)) {
                    echo "<p> El carácter que has ingresado es un Número</p>";
                }
                if (comprobarMayus($caracter)) {
                    echo "<p> El carácter que has ingresado es una letra Mayúscula</p>";
                }
                if (comprobarMinus($caracter)) {
                    echo "<p> El carácter que has ingresado es una letra Minúscula</p>";
                }
                if (comprobarDot($caracter)) {
                    echo "<p> El carácter que has ingresado es un punto</p>";
                }
                if (comprobarCaracter($caracter)) {
                    echo "<p> El carácter que has ingresado es un caracter especial</p>";
                }
                if (comprobarEspacio($caracter)) {
                    echo "<p> El carácter que has ingresado es un Espacio</p>";
                }
            } else {
                echo "Es null";
            }
        }
    }

    ejercicio()
    ?>
</body>

</html>