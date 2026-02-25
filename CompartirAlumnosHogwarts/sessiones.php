if (isset($_SESSION["alumnos"])): ?>

    <h1>Datos del aprendiz-Guillermina Fara</h>

    <p><strong>Nombre:</strong>
        <?php echo htmlspecialchars($_SESSION["alumnos"]["nombre"]); ?>
    </p>

    <p><strong>Casa:</strong>
        <?php echo htmlspecialchars($_SESSION["alumnos"]["casa"]); ?>
    </p>

    <p><strong>Nivel mágico:</strong>
        <?php echo htmlspecialchars($_SESSION["alumnos"]["nivel"]); ?>
    </p>

    <p><strong>Asignaturas favoritas:</strong>
        <?php foreach ($_SESSION["alumnos"]["varitas"] as $varita): ?>
            <span><?php echo htmlspecialchars($varita); ?></span><br>
        <?php endforeach; ?>
    </p>
    <p><strong>Asignaturas favoritas:</strong>
        <?php foreach ($_SESSION["alumnos"]["asignaturas"] as $asignatura): ?>
            <span><?php echo htmlspecialchars($asignatura); ?></span><br>
        <?php endforeach; ?>
    </p>

    <p>
        <?php if(!empty($_SESSION["alumnos"]["foto"]) ): ?>
        <strong>Foto:</strong>
            <?php echo htmlspecialchars($foto);?>

    </p>
<?php else: ?>
    <p>No hay datos en sesión.</p>
<?php endif; ?>