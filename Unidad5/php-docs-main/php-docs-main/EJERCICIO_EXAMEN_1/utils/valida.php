<?php
/**
 * Fichero: funciones/valida.php
 * Recopilación de funciones de validación extraídas de los documentos [2].
 */

/**
 * Obliga a introducir datos en campos requeridos eliminando espacios en blanco [2].
 */
function validaRequerido($valor) {
    if (trim($valor) == '') {
        return false;
    } else {
        return true;
    }
}

/**
 * Valida que se haya introducido un número entero, opcionalmente dentro de un rango [2].
 */
function validarEntero($valor, $opciones = null) {
    if (filter_var($valor, FILTER_VALIDATE_INT, $opciones) === FALSE) {
        return false;
    } else {
        return true;
    }
}

/**
 * Valida que el formato del email sea correcto (user@ejemplo.com) [2].
 */
function validaEmail($valor) {
    if (filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE) {
        return false;
    } else {
        return true;
    }
}

/**
 * Valida si una cadena es alfanumérica (contiene solo letras o números).
 * Utiliza ctype_alnum que devuelve true si todos los caracteres son letras o dígitos [1].
 */
function validaAlfanumerico($valor) {
    return ctype_alnum($valor);
}

/**
 * Valida que la cadena contenga solo caracteres del alfabeto local.
 * Esto incluye mayúsculas, minúsculas, acentos, ñ y ç.
 * No permite números, espacios ni signos de puntuación.
 */
function validaSoloLetras($valor) {
    // ctype_alpha devuelve true si cada carácter es una letra [1]
    return ctype_alpha($valor);
}

?>