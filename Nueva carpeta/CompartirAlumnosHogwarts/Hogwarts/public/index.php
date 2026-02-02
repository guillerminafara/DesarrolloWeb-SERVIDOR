<?php
session_start();

// Si hay POST, procesamos el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . "/../app/Views/form.php";
    exit;
}

// Si NO hay POST, mostramos el formulario vacío
require_once __DIR__ . "/../app/Views/form.php";
require_once __DIR__ . "/../app/validaciones.php";
