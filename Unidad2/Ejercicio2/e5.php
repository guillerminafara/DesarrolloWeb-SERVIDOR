<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function llenarMatriz(){
        $filas=[];
        $columnas=[];

        for ($m=0; $m<5 ; $m++) { 
            $filas=$m;
              echo $filas;
            for ($n=0; $n<5 ; $n++) { 
                $columnas=$n;
                echo $columnas;
            }
             echo "<br>";
        }
        
    }
    llenarMatriz();
    ?>
</body>
</html>