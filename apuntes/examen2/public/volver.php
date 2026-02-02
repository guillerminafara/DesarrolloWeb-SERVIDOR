<?php
// Limpia la sesión relacionada con el examen y redirige al formulario.

session_start();

require_once __DIR__ . '/../validaciones.php';

limpiarSesionFormulario();

header('Location: index.php');
exit;
