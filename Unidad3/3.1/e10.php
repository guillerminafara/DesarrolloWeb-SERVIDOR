 <?php
    if ($_SERVER["REQUEST_METHOD"]) {
        $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        $apellido = isset($_POST["apellido"]) ? $_POST["apellido"] : null;
        $edad = isset($_POST["edad"]) ? $_POST["edad"] : null;
        $peso = isset($_POST["peso"]) ? $_POST["peso"] : null;
        $aficiones = isset($_POST["aficiones"]) ? $_POST["aficiones"] : [];
        $estadoCivil = isset($_POST["estadoCivil"]) ? $_POST["estadoCivil"] : [];
        $sexo = isset($_POST["nombre"]) ? $_POST["nombre"] : null;
        require_once "comprobaciones.php";
        $bandera = comprobarEdad($edad);
        $bandera2 = comprobarPeso($peso);
        $bandera3 = comprobarCasillasAficiones();
        $enviar = [];
        $alertas = [];

        if ($bandera && $bandera2 && $bandera3) {
            $enviar = http_build_query([
                "nombre" => $nombre,
                "apellido" => $apellido,
                "peso" => $peso,
                "aficiones" => $aficiones,
                "estadoCivil" => $estadoCivil,
                "sexo" => $sexo
            ]);
            header('Location: salidaE10.php');
            exit;
        }
    }
    function comprobarPeso($peso)
    {
        $a = $peso > 10 && $peso < 150;
        return is_numeric($peso) && $a ? true : false;
    }
    function comprobarEdad($edad)
    {
        return is_numeric($edad) && comprobarMinMax($edad);
    }
    function comprobarCasillasAficiones()
    {
        $bandera = false;
        if (isset($_POST["aficiones"]) && !empty($_POST["aficiones"])) {

            $bandera = true;
        }
        return $bandera;
    }

    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title>Document</title>
     <style>
         div {
             background-color: #8bfff090;
             position: fixed;
             bottom: 20px;
             right: 20px;
             padding: 20px 40px;
             border: 4px #8bfff0ff solid;
         }
     </style>
 </head>
 <form action="e10.php" method="POST">
     <h2>Formulario ejercicio 10</h2>
     <label>Nombre: <input type="text" name="nombre" required></label>
     <br><br>
     <label>Apellido: <input type="text" name="apellido" required></label>
     <br><br>
     <label>Edad: <input type="text" name="edad"></label><br><br>
     <label>Peso: <input type="text" name="peso" required></label>
     <br><br>
     <h3>Sexo:</h3>
     <label><input type="radio" name="sexo" value="Mujer" required> Mujer</label>
     <br>
     <label><input type="radio" name="sexo" value="Hombre" required> Hombre</label>
     <br>
     <label><input type="radio" name="sexo" value="No responde" required> Prefiero no responder</label>
     <br>
     <h3>Estado Civil:</h3>
     <label><input type="radio" name="EstadoCivil" value="Soltero" required> Soltero</label>
     <br>
     <label><input type="radio" name="EstadoCivil" value="Casado" required> Casado</label>
     <br>
     <label><input type="radio" name="EstadoCivil" value="Divorciado" required> Divorciado</label>
     <br>
     <label><input type="radio" name="EstadoCivil" value="Viudo" required> Viudo</label>

     <h3>Aficiones:</h3>
     <label><input type="checkbox" name="aficiones[]" value="Cine"> Cine</label>
     <br>
     <label><input type="checkbox" name="aficiones[]" value="Deporte"> Deporte</label><br>
     <label><input type="checkbox" name="aficiones[]" value="Literatura"> Literatura</label><br>
     <label><input type="checkbox" name="aficiones[]" value="Musica"> Musica</label><br>
     <label><input type="checkbox" name="aficiones[]" value="Comics"> Comics</label><br>
     <label><input type="checkbox" name="aficiones[]" value="Series"> Series</label><br>
     <label><input type="checkbox" name="aficiones[]" value="Videojuegos"> Videojuegos</label><br> <br>

     <button type="submit" name="valida">Validar</button>
     <button type="submit" id="boton" name="enviar" disabled>Enviar</button>
     <button type="reset">Borrar</button>
 </form>

 <body>


     <div>
         <p>Fara Santeyana María Guillermina · 2do DAW</p>

     </div>


 </body>

 </html>