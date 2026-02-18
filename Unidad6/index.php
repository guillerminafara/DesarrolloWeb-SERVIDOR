<?php
// Punto de entrada de la API
require_once 'personajesController.php';

$controller = new PersonajesController();

$controller->handleRequest();
?>