<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $vectorAsociativo= [
        'Paco' => 1300,
        'Tito' => 1184,
        'Tuca' => 1200,
        'Suru' => 1500,
        'Mou' => 2100,
        'Doggie' => 870
    ];
    function leer($vectorAsociativo){
        foreach ($vectorAsociativo as $key => $value) {
            echo $key. " : ".$value;
             echo "<br>";
        }
    }
    function salarioMaximo($vectorAsociativo){
        $mayor=0;
        $nombre="";
        foreach($vectorAsociativo as $key => $value){
            if($value>$mayor){
                $mayor= $value;
                $nombre=$key;
            }
        }
        echo "el salario más grande €$mayor y le corresponde a $nombre";
    };
  
    function salarioMinimo($vectorAsociativo){
        $menor= 2100;
        $nombre="";
        foreach($vectorAsociativo as $key => $value){
            if($value<$menor){
                $menor= $value;
                $nombre=$key;
            }
        }
        echo "el salario más bajo €$menor y le corresponde a $nombre";
    }

    function media($vectorAsociativo){
        $media=0;
        $suma=0;
        foreach($vectorAsociativo as $key => $value){
            $suma+=$value;
        }
        $media= $suma/count($vectorAsociativo);
        echo "la media de salarios es: €$media";
    }

    function incremento($vectorAsociativo, $porcentaje){
        echo "<br>";
        echo "Los nuevos salarios con el incremento del: $porcentaje% " ;
        $vectorAsociativo2=$vectorAsociativo;
        foreach($vectorAsociativo2 as $key => $value){
            $vectorAsociativo2[$key]= $value+($value*15)/100 ;
        }
        echo "<br>";   
        leer($vectorAsociativo2);
        salarioMaximo($vectorAsociativo2);
        echo "<br>";
        salarioMinimo($vectorAsociativo2);
        echo "<br>";
        media($vectorAsociativo2);
        echo "<br>";
    }
    leer($vectorAsociativo);
    salarioMaximo($vectorAsociativo);
    echo "<br>";
    salarioMinimo($vectorAsociativo);
    echo "<br>";
    media($vectorAsociativo);
    echo "<br>";
    $porcentaje=15;
    incremento($vectorAsociativo, $porcentaje);

    ?>

</body>

</html>