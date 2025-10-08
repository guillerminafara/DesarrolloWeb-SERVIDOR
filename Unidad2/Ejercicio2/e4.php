<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // ,11,12,13,14,15,16,17,18,19,20
    $numero=[];
    $cuadrado=[];
    $cubo=[];
    function generar20() {
        for($i=0; $i <20 ; $i++) { 
            $numero[]= rand(0,100);
        } 
        calcular($numero);
    }
    function calcular($numero){
          foreach ($numero as $num) {
            $cuadrado[]= $num*$num;
            $cubo[]=$num ** 3; 
        }
           matriz($numero,$cuadrado, $cubo);
    }
    function matriz($numero,$cuadrado, $cubo){
        for ($i=0; $i < 10; $i++) { 
            echo "   ". $numero[$i] ." ";
            echo " => ";
            for ($j=$i; $j <=$i; $j++) { 
                echo "   ".  $cuadrado[$j];
                echo " => ";

            }
            for ($k=$i; $k <=$i; $k++) { 
               echo "   ".$cubo[$k]." ";
                echo "  · ";
            }
            echo "<br>";
        }
     
    }
    generar20();
    
 
    
    ?>
</body>
</html>