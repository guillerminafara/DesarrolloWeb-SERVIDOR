<?php
session_start();
require_once __DIR__ . '/../app/controller/PersonajesController.php';
/*  TODO: Controlar sesión
*/
// if (!isset($_SESSION["personaje"])) {
//     http_response_code(401);
//     echo "Debe iniciar sesión para acceder a este recurso.";
//     exit;
// }
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
if ($uri === "/" || $uri === "/index.php") {
    $nombre = $_SESSION["personaje"];
    $mensaje = "Bienvenido, $nombre!";
    $endpoints = [
       "Listar personajes"=>"GET /personajes",
       "Ver personaje por ID"=>"GET /personajes/{id}",
       "Crear nuevo personaje"=>"POST /personajes",
        "Actualizar personaje"=>"PUT /personajes/{id}",
       "Eliminar personaje"=>"DELETE /personajes/{id}",
    ];

    echo "<h1>$mensaje</h1>";
    echo "<h2>Consultas disponibles:</h2>";
    echo "<ul>";
    foreach ($endpoints as $clave => $endpoint) {
        echo "<li>$clave: $endpoint</li>";
    }
    echo "</ul>";
    exit();
}

/*
    TODO: Comprobar que la ruta empieza por "/personajes"
    - Si NO empieza por "/personajes":
        - Devolver 404
        - Mostrar mensaje de recurso no encontrado
        - exit;
*/
if (!str_contains($uri, "/personajes")) {
    http_response_code(404);
    echo "$uri Recurso no encontrado";
    exit;
} else {
    /*
    TODO: Incluir el controlador de personajes
   ;
*/

    /*
    TODO: Crear instancia del controlador y llamar a handleRequest()

*/

    $controller = new PersonajesController();
    $controller->handleRequest();
}
