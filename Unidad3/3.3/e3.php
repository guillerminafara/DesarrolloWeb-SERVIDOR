<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <fieldset>
            <legend>Números a calcular</legend>
            <label> Qué operación deseas realizar? </label>
            <select name="operacion[]" id="operacion" multiple required>
                <option value="Sumar">Sumar</option>
                <option value="Restar">Restar</option>
                <option value="Multiplicar">Multiplicar</option>
                <option value="Dividir">Dividir</option>

            </select>
            <label>1er Número <input type="text" name="primerNumero" required></label>
            <label>2do Número <input type="text" name="segundoNumero" required></label>

        </fieldset>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $n1 = $_POST["primerNumero"];
        $n2 = $_POST["segundoNumero"];
        $operaciones = $_POST["operacion"];


        $cookie_name = "num1";
        $cookie_value = $n1;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $cookie_name = "num2";
        $cookie_value = $n2;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $cookie_name = "operaciones";
        $cookie_value = $n2;
        $cookie_expires = time() + (60 * 60 * 24 * 30);
        $cookie_path = "/";
        setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

        $n1Anterior = $_COOKIE["num1"];
        $n2Anterior = $_COOKIE["num2"];
        $operacioinesAnteriores = $_COOKIE["operaciones"];


        echo "<h2>Resultados Actuales</h2>";
        echo "<p> $n1 $n2</p>";

        echo "<h2>Resultados Anteriores</h2>";

    }
    function sumar($n1, $n2){
        $suma= $n1+ $n2;
        return "$n1+ $n2 = $suma";
    }
    ?>
</body>

</html>