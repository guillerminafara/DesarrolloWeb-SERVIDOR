<?php
// Punto de entrada: muestra el formulario del examen.
session_start();

require_once __DIR__ . '/../validaciones.php';

// Simplemente incluimos la vista del formulario.
require_once __DIR__ . '/../app/views/form.php';

