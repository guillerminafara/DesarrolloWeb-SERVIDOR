<?php
    session_start();

    $correo = $_POST['correo'] ?? null;
    $confirmacion = $_POST['confirmacion'] ?? null;
    $publicidad = isset($_POST['publicidad']) ? "Si" : "No";

    $correo_anterior = $_SESSION['correo'] ?? "No hay datos anteriores";
    $publicidad_anterior = $_SESSION['publicidad'] ?? "No hay datos anteriores";
    
    if ($correo !== $confirmacion) {
        echo "Ambos correos no coinciden.<br><br>";
    } else {

        $_SESSION['correo'] = $correo;
        $_SESSION['publicidad'] = $publicidad;
    }

?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejer10</title>
</head>
<body>

    <h3>Datos de la ejecución actual</h3>
    <?php 
        if ($correo !== $confirmacion) {
            echo "Ambos correos no coinciden. <br>";
        } else {
            // Cerrar php
    ?> 
            
    <p>
        Correo: <?php echo $correo; ?><br>
        Acepta publicidad: <?php echo $publicidad; ?>
    </p>

    <?php 
        // 3. Volver a abrir para cerrar la llave del else
        }
    ?>

    <h3>Datos de la ejecución anterior</h3>
    <p>
        Correo: <?php echo $correo_anterior; ?><br>
        Acepta publicidad: <?php echo $publicidad_anterior; ?>
    </p>


<p><a href="index.html">Volver</a></p>

</body>
</html> 