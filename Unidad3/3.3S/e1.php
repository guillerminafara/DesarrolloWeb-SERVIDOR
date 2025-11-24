<?php
// ini_set("session.use_trans_sid", "1");
// ini_set("session.use_cookies", "0");
// ini_set("session.use_only_cookies", 0);
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name_actual = $_POST["nombre"];
    $elegir_actual = $_POST["elegir"];

    // $_SESSION["usuarioAnterior"] = $_SESSION["usuarioActual"] ?? null;
    // $_SESSION["elegirAnterior"] = $_SESSION["elegirActual"] ?? null;

    // $_SESSION["usuarioActual"] =   $user_name_actual;
    // $_SESSION["elegirActual"] = $elegir_actual;

    $_SESSION["usuarioAnterior"] = $user_name_actual ?? null;
    $_SESSION["elegirAnterior"] = $elegir_actual ?? null;
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
    <div id="titulo">
        <h2>Ejercicio 1 - Guillermina Fara </h2>
    </div>
    <form method="POST">

        <label>Indique su nombre <input type="text" name="nombre" required></label> <br><br>
        <label> Qué prefieres?</label><br><br>
        <label><input type="radio" name="elegir" value="saludo" required>Saludo</label><br>
        <label><input type="radio" name="elegir" value="despedida" required>Despedida</label><br><br>

        <button type="submit">Enviar</button>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            echo "<h2>Valor Anteriores</h2>";
            if (!isset($_SESSION["usuarioAnterior"]) && !isset($_SESSION["elegirAnterior"])) {
                echo "Aún no hay datos almacenadas  " . $_SESSION["usuarioAnterior"];
                echo "<br>Aún no hay datos almacenadas  " . $_SESSION["elegirAnterior"];
            } else {
                echo saludar($_SESSION["usuarioAnterior"], $_SESSION["elegirAnterior"]);
            }

            echo "<h2>Valor Actuales</h2>";

            if (isset($user_name_actual) && isset($elegir_actual)) {
                echo saludar($user_name_actual, $elegir_actual);
            } else {
                echo "Aún no hay sessions almacenadas  " . $user_name_actual;
               
            }
        }
        function saludar($nombre, $elegir)
        {
            $salida = "";

            if ($elegir === "saludo") {
                $salida = "Hola $nombre";
                // echo "Hola $nombre";
            } else {
                $salida = "Adiós $nombre";
            }
            return $salida;
        }

        ?>


    </form>
</body>

</html>