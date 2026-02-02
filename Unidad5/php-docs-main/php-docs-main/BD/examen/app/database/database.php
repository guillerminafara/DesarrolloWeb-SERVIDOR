<?php
//aqui se crea el PDO
//PHP Data Objects, trabajar como si los datos fuesen un objeto
//
require_once "config.php";

$dsn = "mysql:host=$host;
        dbname=$db;
        charset=$charset";
        
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "error: ".$e->getMessage();
    /*http_response_code(500);
    echo json_encode(['error' => 'Error de 
                  conexión a la base de datos']);*/
    exit;
}
