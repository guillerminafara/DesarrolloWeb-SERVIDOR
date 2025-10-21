<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <h2>Comprobacion de duración de llamadas </h2>
        <label> Ingresa la duración para la Primera llamada: <input type="text" name="primera"></label>
        <br><br>
        <label> Ingresa la duración para la Segunda llamada: <input type="text" name="Segunda"></label>
        <br><br>
        <label> Ingresa la duración para la Tercera llamada: <input type="text" name="Tercera"></label>
        <br><br>
        <label> Ingresa la duración para la Cuarta llamada: <input type="text" name="Cuarta"></label>
        <br><br>
        <label> Ingresa la duración para la Quinta llamada: <input type="text" name="Quinta"></label>
        <br><br>
        <button type="submit">Calcula</button>
    </form>
    <?php
    require_once "comprobaciones.php";

    function principal()
    {
        $suma = 0;
        $sumaMinutos = 0;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $vector = [
                "primera" => $_POST["primera"],
                "segunda" => $_POST["Segunda"],
                "tercera" => $_POST["Tercera"],
                "cuarta" => $_POST["Cuarta"],
                "quinta" => $_POST["Quinta"],

            ];
            // $primera = $_POST["primera"];
            // $segunda = $_POST["Segunda"];
            // $tercera = $_POST["Tercera"];
            // $cuarta = $_POST["Cuarta"];
            // $quinta = $_POST["Quinta"];
            foreach ($vector as $key => $value) {
                if (!comprobarNumeric($value)) {
                    echo "<p> Debes ingresar un número</p>\n";
                } else {

                    $sumaMinutos += $value;
                    if (!comprobarTiempo($value)) {
                        echo "<p> por la llamada de duración $value minutos, se te cobrará 10 céntimos</p>\n";
                        $suma += 10;
                    } else {
                        echo "<p> por la llamada de duración $value minutos, se te cobrará" . 10 + masDe3minutos($value) . "céntimos \n";
                        $suma += (10 + masDe3minutos($value));
                    }
                    echo "<p>Para las 5 llamadas realizadas en total hemos acumulado $sumaMinutos minutos \n por tanto deberemos abonar $suma</p>";
                }
            }
        }
    }
    function comprobarTiempo($llamada)
    {
        return $llamada > 3 ? true : false;
    }
    function menosDe3($llamada)
    {
        return $llamada < 3 ? 10 : false;
    }

    function masDe3minutos($llamada)
    {
        $llamada = $llamada - 3;
        return $llamada * 5;
    }
    principal();
    ?>
</body>

</html>