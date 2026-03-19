<?php
/*  TODO: Controlar sesión
*/

/*
    TODO: Comprobar si el usuario está autenticado.
    - Si NO está autenticado:
        - Devolver código 401
        - Mostrar mensaje indicando que debe iniciar sesión
        - exit;
*/

// TODO: Obtener la URI solicitada
$uri = $_SERVER["REQUEST_URI"];

/*
    TODO: Si la URI es "/" o "/index.php":
        - Preparar un mensaje de bienvenida usando el nombre almacenado en sesión
        - Crear un array con los endpoints disponibles
        - Mostrar el mensaje y los endpoints en formato HTML (lista)
        - exit;
*/

/*
    TODO: Comprobar que la ruta empieza por "/personajes"
    - Si NO empieza por "/personajes":
        - Devolver 404
        - Mostrar mensaje de recurso no encontrado
        - exit;
*/

/*
    TODO: Incluir el controlador de personajes
    require_once 'PersonajesController.php';
*/

/*
    TODO: Crear instancia del controlador y llamar a handleRequest()
    $controller = new PersonajesController();
    $controller->handleRequest();
*/
