<?php function calcularMedia($trabajadores)
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

function leerAAsociativos($trabajadores)
{
    echo " <p>-----------------Lectura de salarios:--------------------</p>";
    foreach ($trabajadores as $nombre => $salario) {
        echo "<p> Nombre: $nombre, Salario: $salario \n</p>";
    }
}
