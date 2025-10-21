<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Calculando a salarios</h2>
    <form method="POST">
        <input type="checkbox" name="seleccion" value="media"><label>Calcula la media salarial</label>
        <br><br>
        <input type="checkbox" name="seleccion" value="maximo"><label>Calcula el salario máximo</label>
        <br><br>
        <input type="checkbox" name="seleccion" value="minimo"><label>Calcula el salario mínimo</label>
        <br><br>
        <label>Quieres aumentarles el salario a tus compañeros?</label>
        <br><br>
        <label>Sí </label><input type="radio" name="aumento" value="si" required>
        <label>No </label> <input type="radio" name="aumento" value="no" checked>
        <br><br>
        <label>Ingresa el porcentaje a aumentar: <input type="text" name="porcentaje"> </label>
        <br><br>
        <button type="submit">Calcula </button>
    </form>

    <?php
    echo " <p></p>";
    function principal()
    {
        $trabajadores = [
            "Pepito" => 1000,
            "Paquito" => 1200,
            "Beto" => 1400,
            "Cachito" => 2000,
            "Manolito" => 600,
        ];
        $trabajadoresAumento = [];



        $aumento = $_POST["aumento"];
        $porcentaje = $_POST["porcentaje"];
        $seleccion=[];
        $seleccion = $_POST["seleccion"];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            leerAAsociativos($trabajadores);
            
            echo "<h3>----------------Salida de calculos ----------------</h3> \n ";

            if ($seleccion === "media") {
                $media = calcularMedia($trabajadores);
                echo " <p>----->La media salarial es: €$media</p>";
            }
            if ($seleccion === "minimo") {
                $menor = calculaSalarioMinimo($trabajadores);
                echo "<p>----->El salario más bajo es: €$menor</p>";
            }

            if ($seleccion === "maximo") {
                $mayor = calculaSalarioMaximo($trabajadores);
                echo " <p>----->El salario más alto es: €$mayor</p>";
            }


            if ($aumento == "si") {
                if (isset($porcentaje) && is_numeric($porcentaje)) {
                    echo "<h3>----------------Salarios aumentados:----------------</h3>";
                    $trabajadoresAumento = calcularAumento($trabajadores, $porcentaje);
                    leerAAsociativos($trabajadoresAumento);
                } else {
                    echo " <p>Debes ingresar el porcentaje a aumentar</p>";
                }
            }
        }
    }
    function leerAAsociativos($trabajadores)
    {
        echo " <p>-----------------Lectura de salarios:--------------------</p>";
        foreach ($trabajadores as $nombre => $salario) {
            echo "<p> Nombre: $nombre, Salario: $salario \n</p>";
        }
    }
    function calcularMedia($trabajadores)
    {
        $calcular = 0;
        foreach ($trabajadores as $nombre => $salario) {
            $calcular += $salario;
        }
        return $calcular / count($trabajadores);
    }
    function calculaSalarioMaximo($trabajadores)
    {
        $mayor = 0;
        $mayor = max(array_values($trabajadores));
        return $mayor;
    }

    function calculaSalarioMinimo($trabajadores)
    {
        $menor = 0;
        $menor = min(array_values($trabajadores));
        return $menor;
    }

    function calcularAumento($trabajadores, $aumento)
    {
        foreach ($trabajadores as $nombre => $salario) {
            $trabajadores[$nombre] = (($salario * $aumento) / 100) + $salario;
           
        }
        return $trabajadores;
    }
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        principal();
    }
    ?>
</body>

</html>