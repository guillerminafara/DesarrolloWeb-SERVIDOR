<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #mal {
            color: red;
        }
    </style>
</head>

<body>
    <form method="POST">
        <fieldset>
            <legend>Números a calcular</legend>
            <label> Qué operación deseas realizar? </label> <br>
            <select name="operacion[]" id="operacion" multiple required>
                <option value="Sumar">Sumar</option>
                <option value="Restar">Restar</option>
                <option value="Multiplicar">Multiplicar</option>
                <option value="Dividir">Dividir</option>

            </select><br><br>
            <label>1er Número <input type="text" name="primerNumero" required></label><br><br>
            <label>2do Número <input type="text" name="segundoNumero" required></label><br><br>
            <button>Enviar</button>
        </fieldset>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $n1 = $_POST["primerNumero"];
        $n2 = $_POST["segundoNumero"];
        $operaciones = $_POST["operacion"];
        print $n1;
        print (gettype($n1));

        if (is_numeric($n1) && is_numeric($n2)) {
            $cookie_name = "num1";
            $cookie_value = $n1;
            $cookie_expires; //= time() + (60 * 60 * 24 * 30);
            $cookie_path = "/";
            setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

            $cookie_name = "num2";
            $cookie_value = $n2;
            $cookie_expires; //time() + (60 * 60 * 24 * 30);
            $cookie_path = "/";
            setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

            $cookie_name = "operaciones";
            $cookie_value = implode(",", $operaciones);
            $cookie_expires; // = time() + (60 * 60 * 24 * 30);
            $cookie_path = "/";
            setcookie($cookie_name, $cookie_value, $cookie_expires, $cookie_path);

            $n1Anterior = $_COOKIE["num1"];
            $n2Anterior = $_COOKIE["num2"];
            $operacioinesAnteriores = $_COOKIE["operaciones"];
            echo "$operaciones, $operacioinesAnteriores";

            echo "<h2>Resultados Actuales</h2>";
            if (isset($n1) && isset($n2) && isset($operaciones)) {
                salidaActual($n1, $n2, $operaciones);
            } else {
                echo "<p>Aún no hay valores almacenados </p>";
            }

            echo "<h2>Resultados Anteriores</h2>";
            if (isset($n1Anterior) && isset($n2Anterior) && isset($operacioinesAnteriores)) {
                salidaAnterior($n1Anterior, $n2Anterior, $operacioinesAnteriores);
            } else {
                echo "<p>Aún no hay valores almacenados </p>";
            }
        } else {
            echo "<p id='mal'>Datos incorrectos, ingresa números</p>";
        }

    }
    function salidaAnterior($n1Anterior, $n2Anterior, $operacioinesAnteriores)
    {
        echo "<p> Primer número: $n1Anterior</p>";
        echo "<p> Segundo Número $n2Anterior </p>";
        echo "<p> Operaciones: $operacioinesAnteriores</p>";

        $operacioinesAnteriores = explode(",", $operacioinesAnteriores);
        foreach ($operacioinesAnteriores as $a) {

            switch ($a) {
                case "Sumar":
                    echo "<h3>sumando</h3>";

                    echo sumar($n1Anterior, $n2Anterior);
                    break;
                case "Restar":
                    echo "<h3>Restando</h3>";
                    echo restar($n1Anterior, $n2Anterior);
                    break;
                case "Multiplicar":
                    echo "<h3>Multiplicando</h3>";
                    echo multiplicar($n1Anterior, $n2Anterior);
                    break;
                case "Dividir":
                    echo "<h3>Dividiendo</h3>";
                    echo dividir($n1Anterior, $n2Anterior);
                    break;
                default:
                    echo "Entra al default";
                    break;
            }
        }
    }
    function salidaActual($n1, $n2, $operaciones)
    {
        echo "<p> Primer número: $n1 </p>";
        echo "<p> Segundo Número $n2 </p>";
        echo "<p> Operaciones: $operaciones</p>";

        foreach ($operaciones as $a) {
            switch ($a) {
                case "Sumar":
                    echo "<h3>sumando</h3>";
                    echo sumar($n1, $n2);
                    break;
                case "Restar":
                    echo "<h3>Restando</h3>";
                    echo restar($n1, $n2);
                    break;
                case "Multiplicar":
                    echo "<h3>Multiplicando</h3>";

                    echo multiplicar($n1, $n2);
                    break;
                case "Dividir":
                    echo "<h3>Dividiendo</h3>";
                    echo dividir($n1, $n2);
                    break;
                default:
                    echo "Entra al default";
                    break;
            }
        }
    }
    function sumar($n1, $n2)
    {
        $suma = $n1 + $n2;
        return "$n1+ $n2 = $suma";
    }
    function restar($n1, $n2)
    {
        $devolver = $n1 - $n2;
        return "$n1 - $n2 = $devolver";
    }
    function multiplicar($n1, $n2)
    {
        $devolver = $n1 * $n2;
        return "$n1 X $n2 = $devolver";
    }

    function dividir($n1, $n2)
    {
        if ($n2 === 0) {
            return "<p> No es posible dividir por 0 </p>";
        } else {
            $devolver = $n1 - $n2;
            return "$n1 - $n2 = $devolver";
        }
    }
    ?>
</body>

</html>