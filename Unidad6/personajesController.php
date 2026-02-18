<?php
require_once 'personajes.php';

class PersonajesController {
    private $model;

    public function __construct() {
        $this->model = new Personajes();
    }

    public function handleRequest() {
        // Asegurar respuesta
        header('Content-Type: application/json; charset=utf-8');

        // Leer el método HTTP
        $method = $_SERVER['REQUEST_METHOD'];

        // Extraer recurso e ID de la URI
        // Asumiendo URL tipo: .../index.php/personajes/1
        $pathInfo = $_SERVER['PATH_INFO'] ?? '/'; 
        $uri = explode('/', trim($pathInfo, '/'));

        // $uri[0] debería ser personajes
        $resource = $uri[0] ?? null;
        // $uri[1] puede ser un ID (1, 2...) o la acción importarSWAPI
        $param = $uri[1] ?? null;

        // Solo gestionamos /personajes
        if ($resource !== 'personajes') {
            http_response_code(404);
            echo json_encode(["error" => "Recurso no encontrado. Usa /personajes"]);
            exit;
        }

        // GESTIÓN DE ENDPOINTS

        switch ($method) {
            case 'GET':
                // Importar desde SWAPI
                if ($param === 'importarSWAPI') {
                    $cantidad = $this->model->importarDesdeSwapi();
                    if ($cantidad !== false) {
                        http_response_code(200);
                        echo json_encode(["mensaje" => "Se han importado $cantidad personajes correctamente."]);
                    } else {
                        http_response_code(502); // Bad Gateway (error externo)
                        echo json_encode(["error" => "Error al conectar con SWAPI."]);
                    }
                } 
                // Obtener por ID
                elseif ($param && is_numeric($param)) {
                    $personaje = $this->model->getById($param);
                    if ($personaje) {
                        http_response_code(200);
                        echo json_encode($personaje);
                    } else {
                        http_response_code(404);
                        echo json_encode(["error" => "Personaje no encontrado"]);
                    }
                } 
                // Obtener todos
                else {
                    $lista = $this->model->getAll();
                    http_response_code(200);
                    echo json_encode($lista);
                }
                break;

            case 'POST':
                // Leer cuerpo
                $input = json_decode(file_get_contents("php://input"), true);
                $nuevo = $this->model->create($input);
                if ($nuevo) {
                    http_response_code(201);
                    echo json_encode($nuevo);
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Datos inválidos"]);
                }
                break;

            case 'PUT':
                if ($param && is_numeric($param)) {
                    $input = json_decode(file_get_contents("php://input"), true);
                    if ($this->model->update($param, $input)) {
                        http_response_code(200);
                        echo json_encode(["mensaje" => "Personaje actualizado"]);
                    } else {
                        http_response_code(404);
                        echo json_encode(["error" => "No se pudo actualizar (ID no existe o datos mal)"]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Falta el ID"]);
                }
                break;

            case 'DELETE':
                if ($param && is_numeric($param)) {
                    if ($this->model->delete($param)) {
                        http_response_code(204);
                        // En 204 no se envía cuerpo
                    } else {
                        http_response_code(404);
                        echo json_encode(["error" => "Personaje no encontrado"]);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Falta el ID"]);
                }
                break;

            default:
                http_response_code(405);
                echo json_encode(["error" => "Método no permitido"]);
                break;
        }
    }
}
?>