<?php

/**
 * Criterios de evaluación cubiertos en este archivo:
 *
 * RA1.a – Se han caracterizado y diferenciado los modelos de ejecución de código en el servidor y en el cliente web.
 * RA1.b – Se han reconocido las ventajas que proporciona la generación dinámica de páginas.
 * RA1.c – Se han identificado los mecanismos de ejecución de código en los servidores web.
 * RA1.d – Se han reconocido las funcionalidades que aportan los servidores de aplicaciones y su integración con los servidores web.
 * RA1.e – Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.
 * RA1.f – Se han verificado los mecanismos de integración de los lenguajes de marcas con los lenguajes de programación en entorno servidor.
 * RA1.g – Se han reconocido y evaluado las herramientas y frameworks de programación en entorno servidor.
 *
 * RA2.a – Se han reconocido los mecanismos de generación de páginas web a partir de lenguajes de marcas con código embebido.
 * RA2.b – Se han identificado las principales tecnologías asociadas.
 * RA2.c – Se han utilizado etiquetas para la inclusión de código en el lenguaje de marcas.
 * RA2.d – Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.
 * RA2.e – Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.
 * RA2.f – Se han utilizado directivas para modificar el comportamiento predeterminado.
 * RA2.g – Se han utilizado los distintos tipos de variables y operadores disponibles en el lenguaje.
 * RA2.h – Se han identificado los ámbitos de utilización de las variables.
 *
 * RA3.a – Se han utilizado mecanismos de decisión en la creación de bloques de sentencias.
 * RA3.b – Se han utilizado bucles y se ha verificado su funcionamiento.
 * RA3.c – Se han utilizado matrices (arrays) para almacenar y recuperar conjuntos de datos.
 * RA3.d – Se han creado y utilizado funciones.
 * RA3.f – Se han empleado métodos para recuperar la información introducida en el formulario.
 * RA3.g – Se han añadido comentarios al código.
 *
 * RA4.a – Se han identificado los mecanismos disponibles para el mantenimiento de la información que concierne a un cliente web concreto y se han señalado sus ventajas.
 * RA4.b – Se han utilizado mecanismos para mantener el estado de las aplicaciones web.
 * RA4.c – Se han utilizado mecanismos para almacenar información en el cliente web y para recuperar su contenido.
 * RA4.d – Se han identificado y caracterizado los mecanismos disponibles para la autentificación de usuarios.
 * RA4.e – Se han escrito aplicaciones que integren mecanismos de autentificación de usuarios.
 * RA4.f – Se han utilizado herramientas y entornos para facilitar la programación, prueba y depuración del código.
 *
 * RA5.a – Se han identificado las ventajas de separar la lógica de negocio de los aspectos de presentación de la aplicación.
 * RA5.b – Se han analizado y utilizado mecanismos y frameworks que permiten realizar esta separación y sus características principales.
 * RA5.c – Se han utilizado objetos y controles en el servidor para generar el aspecto visual de la aplicación web en el cliente.
 * RA5.d – Se han utilizado objetos y controles del servidor para generar contenido dinámico.
 * RA5.e – Se han identificado y aplicado los parámetros relativos a la configuración de la aplicación web.
 * RA5.f – Se han escrito aplicaciones web con mantenimiento de estado y separación de la lógica de negocio.
 * RA5.g – Se han aplicado los principios y patrones de diseño de la programación orientada a objetos.
 * RA5.h – Se ha probado y documentado el código.
 *
 * RA6.a – Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos.
 * RA6.b – Se han creado aplicaciones que establezcan conexiones con bases de datos.
 * RA6.c – Se ha recuperado información almacenada en bases de datos.
 * RA6.d – Se ha publicado en aplicaciones web la información recuperada.
 * RA6.e – Se han utilizado conjuntos de datos para almacenar la información.
 * RA6.f – Se han creado aplicaciones web que permitan la actualización y la eliminación de información disponible en una base de datos.
 * RA6.g – Se han probado y documentado las aplicaciones web.
 *
 * RA7.a – Se han reconocido las características propias y el ámbito de aplicación de los servicios web.
 * RA7.b – Se han reconocido las ventajas de utilizar servicios web para proporcionar acceso a funcionalidades incorporadas a la lógica de negocio de una aplicación.
 * RA7.c – Se han identificado las tecnologías y los protocolos implicados en el consumo de servicios web.
 * RA7.d – Se han utilizado los estándares y arquitecturas más difundidos e implicados en el desarrollo de servicios web.
 * RA7.e – Se ha programado un servicio web.
 * RA7.f – Se ha verificado el funcionamiento del servicio web.
 * RA7.g – Se ha consumido el servicio web.
 * RA7.h – Se ha documentado un servicio web.
 *
 * RA8.a – Se han identificado las diferencias entre la ejecución de código en el servidor y en el cliente web.
 * RA8.b – Se han reconocido las ventajas de unir ambas tecnologías en el proceso de desarrollo de programas.
 * RA8.c – Se han identificado las tecnologías y frameworks relacionadas con la generación por parte del servidor de páginas web con guiones embebidos.
 * RA8.d – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan interacción con el usuario.
 * RA8.f – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan modificación dinámica de su contenido y su estructura.
 * RA8.g – Se han aplicado estas tecnologías y frameworks en la programación de aplicaciones web.
 *
 * RA9.a – Se han reconocido las ventajas que proporciona la reutilización de código y el aprovechamiento de información ya existente.
 * RA9.b – Se han identificado tecnologías y frameworks aplicables en la creación de aplicaciones web híbridas.
 * RA9.c – Se ha creado una aplicación web que recupere y procese repositorios de información ya existentes.
 * RA9.d – Se han creado repositorios específicos a partir de información existente en almacenes de información.
 * RA9.e – Se han utilizado librerías de código y frameworks para incorporar funcionalidades específicas a una aplicación web.
 * RA9.f – Se han programado servicios y aplicaciones web utilizando como base información y código generados por terceros.
 * RA9.g – Se han analizado y utilizado librerías de código relacionadas con Big Data e inteligencia de negocios, para incorporar análisis e inteligencia de datos proveniente de repositorios.
 * RA9.h – Se han probado, depurado y documentado las aplicaciones generadas.
 */


// TODO: Cargar el modelo necesario para gestionar los planetas
require_once __DIR__ . "../../app/models/Planeta.php";


/**
 * Controlador para manejar las solicitudes HTTP relacionadas con los 
 * planetas de Star Wars.
 */
class ApiController
{
    /**
     * Maneja los endpoints de la API RESTful para planetas.
     * Procesa las solicitudes HTTP: GET, POST, PUT, DELETE.
     */
    public function handleRequest()
    {

        // TODO: Especificar el tipo de contenido devuelto por la API
        header("Content-Type: application/json");


        // TODO: Obtener el método HTTP de la petición
        $method = $_SERVER['REQUEST_METHOD'];


        // TODO: Obtener la URI actual y dividirla en segmentos
        $uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));


        // TODO: Obtener el recurso solicitado
        $resource = isset($uri[0]) ? $uri[0] : null;

        // TODO: Obtener el ID si existe
        $id = isset($uri[1]) ? $uri[1] : null;


        // TODO: Comprobar si el recurso solicitado NO es 'planetas'
        if ($resource !== "planetas") {
            http_response_code(404);
            echo json_encode(["error" => "Resource not found"]);
            return;
        }

        /**
         * Ruta para importar datos desde SWAPI
         * GET /planetas/importarSWAPI
         */

        // TODO: Detectar si se solicita la importación desde SWAPI
        if ($method === "GET" && empty($id)) {
            $planeta = new Planeta();
            echo json_encode($planeta->getAll(), JSON_PREETY_PRINT);
            exit;
        }

        /**
         * Rutas CRUD para /planetas
         */

        // GET /planetas

        if ($method === "GET") {
            // TODO: Crear planeta
            $planeta = new Planeta();
            // TODO: Devolver todos los planetas en formato JSON
            echo json_encode($planeta->getAll(), JSON_PRETTY_PRINT);
            exit;
        }

        // GET /planetas/{id}

        if ($method === "GET" && !empty($id)) {
            // TODO: Crear planeta
            $planeta = new Planeta();
            // TODO: Devolver el planeta en formato JSON
            echo json_encode($planeta, JSON_PRETTY_PRINT);
            exit;
        }

        // POST /planetas

        if ($method === "POST") {
            $raw = file_get_contents("php://input");
            // TODO: Convertir JSON recibido en array asociativo
            $data = json_decode($raw, true);
            // TODO: Crear un nuevo planeta
            $planeta = new Planeta();
            $planeta->create($data);
            echo json_encode(["mensaje" => "Planeta creado correctamente"]);
            exit;
        }

        // PUT /planetas/{id}

        if ($method === "PUT" && !empty($id)) {
            $raw = file_get_contents("php://input");
            // TODO: Convertir JSON recibido en array asociativo
            $data = json_decode($raw, true);
            // TODO: Crear planeta
            $planeta = new Planeta();
            // TODO: Actualizar el planeta indicado
            $planeta->update($id, $planeta);
            echo json_encode(["mensaje" => "Planeta actualizado correctamente"]);
            exit;
        }

        // DELETE /planetas/{id}

        if ($method === "DELETE" && !empty($id)) {
            // TODO: Crear planeta
            $planeta = new Planeta();
            $planeta->delete($id);
            http_response_code(204); // No Content
            exit;
        }

        // CE RA3.a: Uso de estructuras de decisión
        // Si no se cumple ninguna ruta válida
        //++++ si no se cumple 404 not found
        http_response_code(404);
        echo json_encode(["error" => "Student not found"]);
        exit;
    }

    /**
     *  Carga los datos JSON del ordenador del profesor
     *  y los inserta en la base de datos local.
     */
    public function cargarDatosDesdeSWAPI()
    {
        // CE RA1.e: Consumo de servicios web
        // TODO: Especificar la URL del archivo JSON
        $url = __DIR__ . "/../../config/users.son";

        // CE RA6.c: Se ha recuperado información almacenada en bases de datos.
        // TODO: Obtener el contenido del archivo JSON
        $response = file_get_contents($url);

        // TODO: Convertir el JSON en array asociativo
        $data = json_decode($response, true);

        // CE RA3.a: Uso de estructuras de decisión
        // TODO: Comprobar si la respuesta no contiene datos válidos
        if (!$data) {
            http_response_code(400);
            echo json_encode(["error" => "not valid request"]);
            return;
        }

        // CE RA6.f: Inserción de información
        // TODO: Crear planeta
        $planeta = new Planeta();

        // CE RA3.b: Uso de bucles
        // TODO: Recorrer los datos obtenidos e insertarlos en la base de datos
        foreach ($data as $plane) {

            $planeta->create($plane);
        }

        http_response_code(200);
        echo json_encode(["mensaje"=>"Datos importados correctamente"]);
    }
}
