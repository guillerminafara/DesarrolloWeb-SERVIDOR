<?php
ini_set("session.use_trans_sid", "1"); //activamos sesión si fallan cookies
ini_set("session.use_cookies", "0"); //desactivamos el uso de cookies
ini_set("session.use_only_cookies", "0"); //No usar sólo cookies
session_start(); //iniciamos la sesión
if (empty($_SESSION['count'])) { //contaremos las veces que visita la página
    $_SESSION['count'] = 1;
} else {
    $_SESSION['count']++;
}
?>
<html>

<body>
    <p>
        Hola visitante, ha visto esta página <?php echo $_SESSION['count']; ?>
        veces.
    </p>
    <p>
        Para continuar, <a href="nextpage.php?<?php echo htmlspecialchars(SID);
        ?>">haga clic aquí</a>.
    </p>
</body>

</html>