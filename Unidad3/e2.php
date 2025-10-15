<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Cálculo del salario by Guillermina</h2>
    <form method="POST" >
         <label >Ingresa tus horas semanales: <input type="text" name="horas" ></label> 
         <br><br>
         <label><input type="checkbox" name="mensual" value="marcado"> Calculo de horario mensual</label>
         <br><br> 
         <button type="submit">Calcula tu salario</button>
    </form>
        
    <?php

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        if(isset($_POST["mensual"])){
             $mensual= $_POST["mensual"]; 
             echo "deuvuelve marcadoo";
        }else{
            echo "deuvuelve false";
             calcula();
        }
       
    }
  
        function calcula(){
            $salario=0;
             $horas= $_POST["horas"];
             if(comprueba($horas)){
                $salario=$horas*12;
                echo "<p>El salario semanal será: </p>";
                echo "$salario";
                echo "mas raro";

             }else{
                echo "<p>Ingresa un salario válido</p>";
                echo "Ingresa un salario válido";

               
             }
        }
        function comprueba($horas){
          $bandera= false;
            if(is_numeric($horas)&& $horas>0){
                $bandera=true;
                return $bandera;
            }else{
                echo "entra mal ";
            }
            return $bandera;
        }
        function calculaHoras($horas){
        
        }
       
    ?>
</body>
</html>