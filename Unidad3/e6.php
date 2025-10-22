<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: sans-serif;
        }

        #bien {
            color: green;
        }

        #mal {
            color: red;
        }
    </style>
</head>

<body>
    <!-- echo " <p></p>"; -->
    <h2>Comprobación de la caja Fuerte </h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $codigoRan = $_POST["codigoRan"];
        $contador = 0;
    } else {
        $codigoRan = strval(rand(0, 9999));
        $contador = intval($_POST["contador"]);
    }
    echo "<p>Contraseña no tan secreta: <strong>$codigoRan</strong></p>";

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["combinacion"])) {
        $combinacion = $_POST["combinacion"];
        $contador++;
        if (!is_numeric($combinacion)) {
            echo " <p id='mal'>Ingresa solamente números </p>";
        } elseif ($combinacion === $codigoRan) {
            echo "<p id='bien'>Has acertado la contraseña</p>";
            echo " <p>Lo has hecho en $num intentos</p>";
            // $contador=0;
            // $codigoRan =strval(rand(0,9999));
        } else {
            echo "<p id='mal'>Contraseña incorrecta</p>";
            echo "LLevas $num/4 intentos";
            if ($contador >= 4) {
                echo "<p id='mal'> Has agotado los intentos :C </p>";
                // $contador=0;
                // $codigoRan =strval(rand(0,9999));
            }
        }
    }

    ?>


    <!-- <p>Contraseña no tan secreta: <?= htmlspecialchars($codigoRan) ?></p> -->
    <form method="POST">
        <p type="text" name="codigoRan" value="<?= htmlspecialchars($codigoRan) ?>">a: </p>
        <br><br>
        <label>Ingresa la combinación:</label>
        <input type="password" name="combinacion">
        <input type="hidden" name="codigoRan"value="<?=htmlspecialchars($codigoRan)?>">
        <input type="hidden" name="intentos"value="<?=htmlspecialchars($contador)?>">
        
        <br><br>
        <button type="submit">Adivinar</button>
    </form>

</body>

</html>