<?php
session_start();

if (isset($_POST["token"]) && hash_equals($_SESSION["token"], $_POST["token"])) {
    $CookieInfo = session_get_cookie_params();
    if ((empty($CookieInfo['domain'])) && (empty($CookieInfo['secure']))) { //Si no hay valores específicos para domain y secure, no se indican 
        setcookie(session_name(), '', time() - 3600, $CookieInfo['path']);
    } elseif (empty($CookieInfo['secure'])) { //No se indican valores para secure 

        setcookie(session_name(), '', time() - 3600, $CookieInfo['path'], $CookieInfo['domain']);
    } else { //se indican todos los valores que tenía la cookie de sesión 

        setcookie(session_name(), '', time() - 3600, $CookieInfo['path'], $CookieInfo['domain'], $CookieInfo['secure']);
    }
    session_destroy();

    header("Location:e1.php");
    exit;
}
