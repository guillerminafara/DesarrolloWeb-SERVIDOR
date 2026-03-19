<?php

/*
    TODO: Incluir el archivo Personajes.php 
*/

include_once __DIR__ . "/../models/Personajes.php";
/**
 * Controlador para manejar las solicitudes HTTP relacionadas con los 
 * personajes de Star Wars.
 */
class PersonajesController
{
    /**
     * Maneja los endpoints de la API RESTful para personajes.
     * Procesa las solicitudes HTTP: GET, POST, PUT, DELETE.
     */
    public function handleRequest()
    {
        $personajes = new Personajes();
        /*
            TODO: Establecer cabecera Content-Type: application/json
        */
        header("Content-Type: application/json");
        /*
            TODO: Obtener el método HTTP desde $_SERVER["REQUEST_METHOD"]
        */
        $metodo = $_SERVER["REQUEST_METHOD"];


        /*
            TODO: Obtener la URI desde $_SERVER["REQUEST_URI"]
            TODO: Dividir la URI en segmentos
            TODO: Extraer el recurso (personajes) y el ID (si existe)
        */
        $uri = $_SERVER["REQUEST_URI"];
        $uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
        $resource = isset($uri[1]) ? $uri[1] : null; // para conseguir el usuario, no su nombre
        $id = isset($uri[2]) ? $uri[2] : null; // si existe el dentro de la uri, cargamos variable id
 

        /*
            TODO: Comprobar que el recurso sea "personajes"
            TODO: Si no lo es, devolver 404 con mensaje JSON
        */
        if ($resource !== "personajes") {
            http_response_code(404);
            echo json_encode(["error" => " character not found"]);
        }

        /*
            ============================================
            RUTA ESPECIAL: GET /personajes/importarSWAPI
            ============================================
            TODO: Detectar esta ruta y llamar a cargarDatosDesdeSWAPI()
        */
        if ($metodo === "GET") { // si es GET
            if ($id === "importarSWAPI") {
                $this->cargarDatosDesdeSWAPI();
                return;
            }
        }

        /*
            ============================
            RUTAS CRUD
            ============================
        */

        /*
            TODO: GET /personajes
            - Si no hay ID, devolver todos los personajes
            - Llamar a Personajes::getAll()
        */
        if ($metodo === "GET") {

            if (!$id) {
                echo json_encode(Personajes::getAll());
                return;
            }
            /*
            TODO: GET /personajes/{id}
            - Si hay ID, devolver un personaje concreto
            - Llamar a Personajes::getById($id)
        */
            if ($id && $id !== "importarSWAPI") {
                echo json_encode($personajes::getById($id));
                return;
            }
        }

        /*
            TODO: POST /personajes
            - Leer JSON desde php://input
            - Llamar a Personajes::create($data)
        */
        if ($metodo === "POST") {
            $raw = file_get_contents("php://input");
            $data = json_decode($raw, true);
            Personajes::create($data);
            return;
        }
        /*
            TODO: PUT /personajes/{id}
            - Leer JSON desde php://input
            - Llamar a Personajes::update($id, $data)
        */
        if ($metodo === "PUT") {
            $raw = file_get_contents("php://input");
            $data = json_decode($raw, true);
            Personajes::update($id, $data);
            return;
        }
        /*
            TODO: DELETE /personajes/{id}
            - Llamar a Personajes::delete($id)
            - Devolver código 204
        */
        if ($metodo === "DELETE") {
            $elimina=$personajes::delete($id);
            if($elimina){
                http_response_code(204);
            } else {
                http_response_code(500);
                echo json_encode(["error" => "Error al eliminar el personaje"]);
            }
       
            return;
        }
        /*
            TODO: Si ninguna ruta coincide, devolver 404
        */ else {
            http_response_code(404);
        }
    }

    /**
     * Carga los datos JSON de la API SWAPI (personajes)
     * y los inserta en la base de datos local.
     */
    public function cargarDatosDesdeSWAPI()
    {
        /*
            TODO: Obtener datos desde la URL https://swapi.dev/api/people/
            TODO: Leer contenido JSON
            TODO: Decodificar JSON
            TODO: Comprobar que existe 'results'
            TODO: Recorrer los personajes recibidos
            TODO: Insertar cada uno usando Personajes::create()
            TODO: Devolver mensaje JSON de éxito o error
        */

        $swapi = __DIR__ . "/../../swapi.json";
        $datosDesdeAPI = json_decode(file_get_contents($swapi), true);
        if (!isset($datosDesdeAPI["results"])) {
            echo json_encode(["error" => "No se encontraron personajes en la respuesta de SWAPI"]);
            exit;
        }
        foreach ($datosDesdeAPI["results"] as $datos) {
            echo "\n viendo que entra" . $datos["name"];
            $personaje = new Personajes();
            $personaje::create($datos);
        }

    }
}
