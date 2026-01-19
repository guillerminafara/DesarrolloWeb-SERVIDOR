<?php

// Validar que un campo no esté vacío
function validaRequerido($valor) {
    return trim($valor) !== '';
}

// Validar formato de email
function validaEmail($valor) {
    return filter_var($valor, FILTER_VALIDATE_EMAIL) !== FALSE;
}

// Validar longitud de contraseña (mínimo 6 caracteres)
function validaContrasena($valor) {
    // El enunciado dice "mínimo 6", así que si mide menos de 6 devuelve false
    return strlen(trim($valor)) >= 6;
}

// Validar Nacionalidad (Lógica especial para "Otra")
function validaNacionalidad($radioValue, $textoOtra) {
    if ($radioValue === 'espanola') {
        return true;
    }
    // Si seleccionó otra (vacío en el value del radio) y escribió texto
    if ($radioValue === '' && trim($textoOtra) !== '') {
        return true;
    }
    return false;
}

/**
 * Función potente para validar y guardar la imagen.
 * Devuelve un array con 'correcto' (bool), 'mensaje' (string) y 'ruta' (string).
 */
function validarYGuardarImagen($archivo) {
    // 1. Comprobar si se ha subido fichero (Error 0 es OK, Error 4 es que no hay fichero)
    if (!isset($archivo) || $archivo['error'] === UPLOAD_ERR_NO_FILE) {
        return ['correcto' => false, 'mensaje' => "No se ha subido ninguna imagen."];
    }

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return ['correcto' => false, 'mensaje' => "Error al subir el archivo (Código: " . $archivo['error'] . ")."];
    }

    // 2. Comprobar tamaño (Máximo 50 KB = 50 * 1024 bytes)
    $max_tamano = 50 * 1024; 
    if ($archivo['size'] > $max_tamano) {
        return ['correcto' => false, 'mensaje' => "El archivo es demasiado grande. Máximo 50KB."];
    }

    // 3. Comprobar extensión usando explode() como pide el enunciado
    $nombre_fichero = $archivo['name'];
    $partes_nombre = explode('.', $nombre_fichero);
    
    // Obtenemos el último elemento del array (la extensión) y lo pasamos a minúsculas
    $extension = strtolower(end($partes_nombre));
    
    $extensiones_validas = ['jpg', 'gif', 'png'];

    if (!in_array($extension, $extensiones_validas)) {
        return ['correcto' => false, 'mensaje' => "Extensión no válida. Solo jpg, gif y png."];
    }

    // 4. Comprobar directorio y generar nombre único
    $directorio_destino = 'subidas/'; // Asegúrate de crear esta carpeta o que el código la cree
    
    // Si no existe el directorio, lo creamos
    if (!is_dir($directorio_destino)) {
        mkdir($directorio_destino, 0777, true);
    }

    // Generar nombre único: tiempo actual + número aleatorio + extensión
    $nombre_unico = 'img_' . time() . '_' . uniqid() . '.' . $extension;
    $ruta_destino = $directorio_destino . $nombre_unico;

    // 5. Mover el archivo de la carpeta temporal a la definitiva
    if (move_uploaded_file($archivo['tmp_name'], $ruta_destino)) {
        return [
            'correcto' => true, 
            'mensaje' => "Imagen subida correctamente.", 
            'ruta' => $ruta_destino
        ];
    } else {
        return ['correcto' => false, 'mensaje' => "Error al mover el archivo al directorio de destino."];
    }
}
?>