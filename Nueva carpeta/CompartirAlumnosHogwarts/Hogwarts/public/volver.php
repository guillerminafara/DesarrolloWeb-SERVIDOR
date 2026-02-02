<?php
/***
 * Script para limpiar la sesión y volver al formulario
 */

// Iniciamos la sesión para poder destruirla y volver al formulario index.php
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit(); 
?>