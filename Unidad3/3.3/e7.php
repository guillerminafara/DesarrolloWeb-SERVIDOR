<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigoRan = $_POST["codigoRan"];
    $contador = intval($_POST["contador"]);
} else {
    $codigoRan = strval(rand(0, 9999));
    $contador = 0;
}

$cookie_value = $condigoRan;
$cookie_expires = time() + (60 * 60 * 24 * 30);
$cookie_path = "/";
setcookie("codigo", $cookie_value, $cookie_expires, $cookie_path);

$cookie_value = $contador;
$cookie_expires = time() + (60 * 60 * 24 * 30);
$cookie_path = "/";
setcookie("contador", $cookie_value, $cookie_expires, $cookie_path);

$cookie_value = $combinacion;
$cookie_expires = time() + (60 * 60 * 24 * 30);
$cookie_path = "/";
setcookie("historial", $cookie_value, $cookie_expires, $cookie_path);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["combinacion"])) {
    $combinacion = $_POST["combinacion"];
    $contador++;
 
    if (!is_numeric($combinacion)) {
        echo " <p id='mal'>Ingresa solamente números </p>";
    } elseif ($combinacion === $codigoRan) {
        echo "<p id='bien'>Has acertado la contraseña</p>";
        echo " <p>Lo has hecho en $contador intentos</p>";
        // $contador=0;
        // $codigoRan =strval(rand(0,9999));
    } else {
        echo "<p id='mal'>Contraseña incorrecta</p>";
        echo "LLevas $contador/4 intentos";
        if ($contador >= 4) {
            echo "<p id='mal'> Has agotado los intentos :C </p>";
            // $contador=0;
            // $codigoRan =strval(rand(0,9999));
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    echo "<p>Contraseña no tan secreta: <strong>$codigoRan</strong></p>";
    ?>
    <form method="POST">
        <p type="text" name="codigoRan" value="<?= htmlspecialchars($codigoRan) ?>"> </p>
        <br><br>
        <label>Ingresa la combinación:</label>
        <input type="password" name="combinacion">
        <input type="hidden" name="codigoRan" value="<?= htmlspecialchars($codigoRan) ?>">
        <input type="hidden" name="contador" value="<?= htmlspecialchars($contador) ?>">

        <br><br>
        <button type="submit">Adivinar</button>
    </form>
</body>

</html>