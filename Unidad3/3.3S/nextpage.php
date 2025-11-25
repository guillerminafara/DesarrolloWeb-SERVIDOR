<?php
session_start(); //iniciamos la sesión
$_SESSION['count'] = $_POST['count'];
if (empty($_SESSION['count'])) {
    echo "No hay dato introducido";
} else {
    echo "El dato introducido es: ", $_SESSION['count'];
}
// Cambia "cliente nuevo" por el valor introducido en el Text
?>