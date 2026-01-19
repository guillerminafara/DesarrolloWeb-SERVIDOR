<?php
require_once 'funciones.php';

if (!isset($_GET['token'])) {
    print('No se ha encontrado token en la URL de logout');
    exit;
}

if (!tokenEsValido($_GET['token'])) {
    print('El token no coincide en logout!');
    exit;
}

limpiarSesionUsuario();

echo "Sesión cerrada correctamente.<br>";
echo '<a href="index.php">Volver al formulario</a>';