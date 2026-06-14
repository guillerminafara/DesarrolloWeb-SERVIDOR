<?php

// Obtener la ruta solicitada
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// La  ruta "/" e "/index.php" son la misma
if ($uri === '/' || $uri === '/index.php') {
    require __DIR__ . '/index.php';
    exit;
}


// Ruta física solicitada
$path = __DIR__ . $uri;

// Si existe un archivo real, lo sirve directamente
if (file_exists($path) && !is_dir($path)) {
    return false;
}

// Si no existe, cargar index.php
require __DIR__ . '/index.php';

?>