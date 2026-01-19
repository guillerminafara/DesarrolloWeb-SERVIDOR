<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seniatours-FaraGuillermina</title>
</head>

<body>
    <form action="" method="POST" enctype="multiplatform/form-data">
        <h2>Seniatours- Guillermina Fara</h2>
        <label> Usuario:<input type="text" id="usuario" name="usuario"></label>
        <label> Password:<input type="text" id="password" name="password"></label>
        <label> Email:<input type="text" id="email" name="email"></label>
        <label> Dirección:<input type="text" id="direccion" name="direccion"></label>
        <label> CP:<input type="text" id="cp" name="cp"></label>

        <label>Tipo de Alojamiento
            <select name="tipoAlojamiento" id="tipoAlojamiento">
                <option value="Chalet">Chalet</option>
                <option value="Piso">Piso</option>
                <option value="Apartamento">Apartamento</option>
                <option value="Cabaña">Cabaña</option>
                <option value="Casa Rural">Casa Rural</option>
            </select>
        </label>
        <label> Rol:<input type="radio" name="rol" value="Cuento con usuario">Cuento con usuario
            <input type="radio" name="rol" value="No registrado">No cuento con usuario
        </label>

        <!-- ver, usuario ya creados no rellenan todos los datos  -->
        <label> Preferencia de Servicios:</label>
        <select multiple name="preferencias[]" id="">
            <option value="Zona Comercial">Zona Comercial</option>
            <option value="Piscina">Piscina</option>
            <option value="Parking">Parking</option>
            <option value="Parque Infantil">Parque Infantil</option>
            <option value="Transporte Público">Transporte Público</option>
            <option value="Amueblado">Amueblado</option>
        </select>
        <label> Opción de alquiler:</label>

        <label><input type="radio" name="opciones" values="dias" checked>Días</label>
        <label><input type="radio" name="opciones" values="semanas">Semanas</label>

        <label><input type="radio" name="opciones" values="meses">Meses</label>
        <label>Adjuntar una Foto: <input type="file" id="foto" name="foto"></label>


        <button>Validar</button>
        <button type="reset">Limpiar</button>
        <button type="submit" formaction="alumno_ok.php">Enviar</button>
    </form>

    <?php
    /**
     * @author Guillermina Fara
     */
    require_once("validaciones.php");
    $error[] = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST["usuario"]) && isset($_POST["password"]) && $isset($_POST["direccion"]) && $$isset($_POST["CP"])) {
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $direccion = $_POST["direccion"];
            $cp = $_POST["cp"];
            $foto = $_POST["foto"];
            $nombreFoto = $_FILES["foto"]["name"];
            $extension = $_FILES["foto"]["type"];
            if (!validaAlfanum($usuario)) {
                $error[] = "El usuario solo puede tener letras y números";

            }
            if ((strlen($password) <= 6)) {
                $error[] = "La contraseña debe ser mayor a 6 carácteres y contener al ménos un número";
            }
            if (strlen($cp) !== 5 && validaNumero($cp)) {
                $error[] = "El código postal solo debe tener números y no ser diferente de 5 dígitos ";
            }
            if (!validaEmail($email)) {
                $error[] = "Email invalido";
            }
            if ($extension !== "JPG" || $extension !== "JPEG" || $extension !== "PNG" || $extension !== "GIF") {
                $error[] = "Extensión inválida";
            }
            if (count($error) === 0) {
                $_SESSION["usuario"] = $usuario;
                $_SESSION["password"] = $password;
                $_SESSION["rol"] = $rol;// no entiendo el porqué
                $_SESSION["email"] = $email;
                $_SESSION["cp"]=$cp;
            }
        }
    }
    ?>
</body>

</html>