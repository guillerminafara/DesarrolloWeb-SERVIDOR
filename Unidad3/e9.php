<!-- 9.Escribe un formulario de recogida de datos que conste de dos páginas: 
    En la primera página se solicitan los datos y se muestran errores 
    tras validarlos (botones Validar y Enviar). En la segunda página 
    se muestra toda la información introducida por el usuario si no
     hay errores (tendrá botón Volver a la página inicial). 
     Los datos a recoger son datos personales, nivel de estudios (desplegable), 
     situación actual (selección múltiple: estudiando, trabajando, 
     buscando empleo, desempleado) y hobbies (marcar de varios mostrados y
      poner otro con opción a introducir texto). -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div {
            background-color: #8bfff090;
            position: fixed;
            bottom: 20px;
            padding: 20px 40px;
            border: 4px #8bfff0ff solid;
        }
    </style>
</head>

<body>
    <form action="formularioE9.php">
        <label>Nombre:<input type="text" name="nombre"></label>
        <label>Edad:<input type="text" name="edad"></label>

        <h3>Nivel de estudios:</h3>
        <select name="nivelEstudios">
            <option value="">Nivel de estudios</option>
            <option value="primaria">Primaria</option>
            <option value="ESO">ESO</option>
            <option value="bachiller">Bachiller</option>
            <option value="formacion profesional">Formacion Profesional</option>
            <option value="universitario">Universitario</option>
        </select>
        <h3>Situación Actual:</h3>
        <br><br>
        <label><input type="text" name="situacion[]" value="Estudiante"></label>
        <br><br>
        <label><input type="text" name="situacion[]" value="Trabajador"></label>
        <br><br>
        <label><input type="text" name="situacion[]" value="En busca de empleo"></label>
        <br><br>
        <label><input type="text" name="situacion[]" value="Desempleado"></label>


        <label><input type="text" name="hobbies[]" value="Leer">Leer</label>
        <br><br>
        <label><input type="text" name="hobbies[]" value="Tejer">Tejer</label>
        <br><br>
        <label><input type="text" name="hobbies[]" value="Deportes">Deportes</label>
        <br><br>
        <label><input type="text" name="hobbies[]" value="Videojuegos">Videojuegos</label>
        <br><br>
        <label><input type="text" name="hobbies[]" value="Viajar">Viajar</label>
        <br><br>
        <label><input type="text" name="hobbies[]" value="Otros">Otros:</label>

        <button>Validar</button> <button>Enviar</button>
    </form>
<p></p>
    <?php
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $nombre=$_POST["nombre"];
            $edad=$_POST["edad"];
            echo "<p>$nombre </p>";     
        }

    ?>
    <div>
        <p>Fara Santeyana María Guillermina · 2do DAW</p>

    </div>
</body>

</html>