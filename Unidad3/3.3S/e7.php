<?php
$historial = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigoRan = $_POST["codigoRan"];
    $contador = intval($_POST["contador"]);
} else {
    $codigoRan = strval(rand(0, 9999));
    $contador = 0;
}
if (isset($_COOKIE["historial"])) {
    $historial = explode(",", $_COOKIE["historial"]);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $combinacion = trim($_POST["combinacion"]);
    $historial[] = $combinacion;
    $cookie_value = $codigoRan;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie("codigo", $cookie_value, $cookie_expires, $cookie_path);

    $cookie_value = $contador;
    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie("contador", $cookie_value, $cookie_expires, $cookie_path);


    $cookie_expires = time() + (60 * 60 * 24 * 30);
    $cookie_path = "/";
    setcookie("historial", implode(",", $historial), $cookie_expires, $cookie_path);


    $contador++;

    if (!is_numeric($combinacion)) {
        $mensaje = " <p id='mal'>Ingresa solamente números </p>";
    } elseif ($combinacion === $codigoRan) {
        $mensaje = "<p id='bien'>Has acertado la contraseña</p> <p>Lo has hecho en $contador intentos</p>";
        setcookie("historial", "", time(), "/");
        setcookie("contador", "", time(), "/");

        // $contador=0;
        // $codigoRan =strval(rand(0,9999));
    } else {
        $mensaje = "<p id='mal'>Contraseña incorrecta</p><p> LLevas $contador/4 intentos </p>";
        if ($contador >= 4) {
            $mensaje = "<p id='mal'> Has agotado los intentos :C </p>";
            setcookie("historial", "", time(), "/");
            setcookie("contador", "", time(), "/");

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

    <h2>Ejercicio 7 Caja Fuerte - Guillermina Fara </h2>

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
    <?php
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    echo "<h3>Intentos Anteriores: </h3>";
    if (!empty($historial)) {
        echo "<ul>";

        foreach ($historial as $inten) {

            echo "<li>$inten</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aún no hay cookies almacenadas </p>";
    }

    ?>
</body>

</html>