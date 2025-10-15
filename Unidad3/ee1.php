<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>
        Conversor de Pesetas - Euros by Guillermina
    </h2>

    <form method="post">
        <br>
        <br>
        <label>Cantidad:<input type="text" name="idCantidad" required></label>
        <br>
        <br>
        <input type="radio" name="divisa" value="euros" required> De Euros a Pesetas<br>
        <input type="radio" name="divisa" value="pesetas" required> De Pesetas a Euros<br><br>

        <button type="submit">Calcula</button>

    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"=== "POST"]){
        $cambio = 166.386;
        $cantidad =(int)$_POST["idCantidad"];
        $moneda=$_POST["divisa"];
        if(is_numeric($cantidad) && $cantidad >0 ){
           if($moneda === "euros"){
            $resultado=$cantidad * $conversion;
            echo "<p>En son $resultado $moneda  </p>";
            echo "<p>En son  </p>";


           }else if($moneda === "pesetas"){
            $resultado=$cantidad / $conversion;
            echo "<p>En son $resultado $moneda  </p>";
           }else{
              echo "<p>Debes seleccionar una de las opciones de conversión</p>";
           }
        }else{
            echo "<p>Imgresa una cantidad válida</p>";
        }
    }
    
    ?>
</body>

</html>