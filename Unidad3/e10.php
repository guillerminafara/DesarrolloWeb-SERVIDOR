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
<form action="" method="">
    <h2>Formulario ejercicio 10</h2>
    <label>Nombre:<input type="text" name="nombre" required></label>
    <br><br>
    <label>Apellido:<input type="text" name="apellido" required></label>
    <br><br>
    <label>Edad:<input type="text" name="edad"></label>
    <label>Peso:<input type="text" name="peso" required></label>
    <br><br>
    <label>Sexo:</label>
    <br><br>
    <label><input type="radio" name="sexo" value="Mujer" required> Mujer</label>
    <br><br>
    <label><input type="radio" name="sexo" value="Hombre" required> Hombre</label>
    <br><br>
    <label><input type="radio" name="sexo" value="No responde" required> Prefiero no responder</label>
    <br><br>
    <label>Estado Civil:</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Soltero" required> Soltero</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Casado" required> Casado</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Divorciado" required> Divorciado</label>
    <br><br>
    <label><input type="radio" name="EstadoCivil" value="Viudo" required> Viudo</label>

    <button type="submit" name="valida">Validar</button>
    <button type="submit" name="enviar" formaction="salidaE9.php">Enviar</button>
    <button type="reset">Borrar</button>
</form>

<body>
    <div>
        <p>Fara Santeyana María Guillermina · 2do DAW</p>

    </div>
</body>

</html>