<?php

function validar_cadena($nombre, $patron, $cadena) {

    if (preg_match($patron, $cadena)) {

        echo "Cadena válida para $nombre: $cadena<br>";
        return true;

    } else {
        
        echo "Cadena no válida para $nombre: $cadena<br>";
        return false;

    }
}



$nombre_a = "Código Postal C.  Valenciana";
$patron_a = '/^(03|12|46)\d{3}$/';
validar_cadena($nombre_a, $patron_a, "46002");
validar_cadena($nombre_a, $patron_a, "08001");

$nombre_b = "NIF";
$patron_b = '/^\d{8}[A-Z]$/';
validar_cadena($nombre_b, $patron_b, "12345678X");
validar_cadena($nombre_b, $patron_b, "12345678x");

$nombre_c = "Fecha";
$patron_c = '/^\d{2}[-\/]\d{2}[-\/]\d{4}$/';
validar_cadena($nombre_c, $patron_c, "31/12/2025");
validar_cadena($nombre_c, $patron_c, "01-01-2024");
validar_cadena($nombre_c, $patron_c, "2025/12/31");

$nombre_d = "Contiene 'enviado'";
$patron_d = '/enviado/i';
validar_cadena($nombre_d, $patron_d, "El paquete ha sido EnviAdO.");
validar_cadena($nombre_d, $patron_d, "El pedido está en camino.");

$nombre_e = "Texto";
$patron_e = '/^[a-zA-Z\s]+$/';
validar_cadena($nombre_e, $patron_e, "Esto es Texto Valido");
validar_cadena($nombre_e, $patron_e, "Texto con 1 número");

$nombre_f = "Solamente números";
$patron_f = '/^\d+$/';
validar_cadena($nombre_f, $patron_f, "1234567890");
validar_cadena($nombre_f, $patron_f, "123 456");

$nombre_g = "Números con espacios";
$patron_g = '/^[\d\s]+$/';
validar_cadena($nombre_g, $patron_g, "123 456 789");
validar_cadena($nombre_g, $patron_g, "123a456");

$nombre_h = "Alfanumérico, espacios y acentos";
$patron_h = '/^[\p{L}\d\s]*$/u';
validar_cadena($nombre_h, $patron_h, "Dirección 123 Ñúñez");
validar_cadena($nombre_h, $patron_h, "Cadena con #símbolo");

$nombre_i = "Alfanumérico, acentos y puntuación específica";
$patron_i = '/^[\p{L}\d\s.,;:\'"-]*$/u';
validar_cadena($nombre_i, $patron_i, "La dirección es: Calle Colón, n.º 1; 'Piso' - 5.");
validar_cadena($nombre_i, $patron_i, "Texto con un ! no permitido");

$nombre_j = "Dirección de Email";
$patron_j = '/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/';
validar_cadena($nombre_j, $patron_j, "usuario.prueba@dominio.com");
validar_cadena($nombre_j, $patron_j, "email_invalido@dominio");

$nombre_k = "URL Sencilla";
$patron_k = '/^https?:\/\/[a-zA-Z0-9\.\/-]+\?[\d]+$/';
validar_cadena($nombre_k, $patron_k, "http://www.ieslasenia.org/ejercicio?16");
validar_cadena($nombre_k, $patron_k, "ftp://servidor.com");

$nombre_l = "Contraseña Segura";
$patron_l = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/';
validar_cadena($nombre_l, $patron_l, "P4ssw0rd");
validar_cadena($nombre_l, $patron_l, "Corta1");
validar_cadena($nombre_l, $patron_l, "Corta");

$nombre_m = "IPv4";
$patron_m = '/^(\d{1,3}\.){3}\d{1,3}$/';
validar_cadena($nombre_m, $patron_m, "192.168.1.1");
validar_cadena($nombre_m, $patron_m, "192.168.1");

$nombre_n = "Dirección MAC";
$patron_n = '/^([0-9A-Fa-f]{2}:){5}[0-9A-Fa-f]{2}$/';
validar_cadena($nombre_n, $patron_n, "00:A0:C9:14:C8:29");
validar_cadena($nombre_n, $patron_n, "00-A0-C9-14-C8-29");



?>