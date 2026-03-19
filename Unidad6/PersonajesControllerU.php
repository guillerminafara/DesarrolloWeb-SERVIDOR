<?php

/*
    TODO: Incluir el archivo Personajes.php 
*/


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
        /*
            TODO: Establecer cabecera Content-Type: application/json
        */

        /*
            TODO: Obtener el método HTTP desde $_SERVER["REQUEST_METHOD"]
        */

        /*
            TODO: Obtener la URI desde $_SERVER["REQUEST_URI"]
            TODO: Dividir la URI en segmentos
            TODO: Extraer el recurso (personajes) y el ID (si existe)
        */

        /*
            TODO: Comprobar que el recurso sea "personajes"
            TODO: Si no lo es, devolver 404 con mensaje JSON
        */

        /*
            ============================================
            RUTA ESPECIAL: GET /personajes/importarSWAPI
            ============================================
            TODO: Detectar esta ruta y llamar a cargarDatosDesdeSWAPI()
        */

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

        /*
            TODO: GET /personajes/{id}
            - Si hay ID, devolver un personaje concreto
            - Llamar a Personajes::getById($id)
        */

        /*
            TODO: POST /personajes
            - Leer JSON desde php://input
            - Llamar a Personajes::create($data)
        */

        /*
            TODO: PUT /personajes/{id}
            - Leer JSON desde php://input
            - Llamar a Personajes::update($id, $data)
        */

        /*
            TODO: DELETE /personajes/{id}
            - Llamar a Personajes::delete($id)
            - Devolver código 204
        */

        /*
            TODO: Si ninguna ruta coincide, devolver 404
        */
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
    }
}
?>
