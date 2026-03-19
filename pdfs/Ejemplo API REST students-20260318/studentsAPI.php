<?php
//Indicamos el nombre del JSON con los estudiantes
$file="students.json";

// Cargamos el JSON students
$students =json_decode(file_get_contents($file),true);

// Detectar método HTTP en el servidor
$method = $_SERVER['REQUEST_METHOD'];

// Detectar recurso e ID /students/3 → resource=students, id=3
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$resource = isset($uri[0]) ? $uri[0] : null;
$id = isset($uri[1]) ? $uri[1] : null;

// Solo gestionamos /students
if ($resource !== 'students') {
    http_response_code(404);
    echo json_encode(["error" => "Resource not found"]);
    exit;
}

/**
 * MÉTODO GET → INDEX Y SHOW
 * */
if ($method === 'GET') {

    // GET /students → INDEX (mostrar todos los estudiantes)
    if (!$id) {
        http_response_code(200);
        echo json_encode($students);
        exit;
    }

    // GET /students/{id} → SHOW (mostrar un estudiante)
    foreach ($students as $student) {
        if ($student["id"] == $id) {
            http_response_code(200);
            echo json_encode($student);
            exit;
        }
    }
    // Si no se encuentra el estudiante
    http_response_code(404);
    echo json_encode(["error" => "Student not found"]);
    exit;
}

/**
 * MÉTODO POST → STORE
 *  */     
if ($method === 'POST') {

    // Leemos el JSON enviado por el cliente
    // php://input permite leer el cuerpo de la petición
    $raw = file_get_contents("php://input");
    $input = json_decode($raw, true); // true para obtener un array asociativo

    // Calcular nuevo ID
    // Obtenemos el último elemento del array y le sumamos 1
    // Los IDs pueden no ser consecutivos, así que buscamos el máximo
    $ids = array_column($students, 'id'); // Extraemos los IDs
    $newId = max($ids) + 1; // Calculamos el nuevo ID

    $newStudent = [
        "id" => $newId,
        "name" => isset($input["name"]) ? $input["name"] : "Unnamed"
    ];

    $students[]=$newStudent;
    file_put_contents($file, json_encode($students, JSON_PRETTY_PRINT));

    http_response_code(201); // Created
    echo json_encode($newStudent);
    exit;
}

/**
 * MÉTODO PUT → UPDATE
 * */
if ($method === 'PUT') {

    // Leemos el JSON enviado por el cliente
    $input = json_decode(file_get_contents("php://input"), true);

    // Buscamos el estudiante
    foreach ($students as $index => $student) {
        if ($student["id"] == $id) {

            $updatedName=isset($input["name"]) ? $input["name"] : $student["name"];
            $students[$index]["name"] = $updatedName;
            
           //guardamos el cambio en el fichero         
            file_put_contents($file, json_encode($students,JSON_PRETTY_PRINT ));

            http_response_code(200);
            echo json_encode($students[$index]);
            exit;
        }
    }

    // Si no existe el ID
    http_response_code(404);
    echo json_encode(["error" => "Student not found"]);
    exit;
}


/**
 * MÉTODO DELETE → DESTROY
 * */
if ($method === 'DELETE') {

    foreach ($students as $index => $student) {
        if ($student["id"] == $id) {
            unset($students[$index]); //Eliminamos el student
            file_put_contents($file, json_encode($students,JSON_PRETTY_PRINT));
            http_response_code(204); // No Content
            exit;
        }
    }
    // Si no existe el ID
    http_response_code(404);
    echo json_encode(["error" => "Student not found"]);
    exit;
}
