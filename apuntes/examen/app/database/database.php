<?php
//aqui se crea el PDO
//PHP Data Objects, trabajar como si los datos fuesen un objeto
//
require_once "config.php";

// Opciones comunes de PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Si está disponible pdo_sqlite, usamos SQLite con archivo .db
    if (extension_loaded('pdo_sqlite')) {
        $dsn = 'sqlite:' . $db_sqlite_path;
        $pdo = new PDO($dsn, null, null, $options);

        // Inicializamos la estructura básica si no existe.
        // En el examen solo hay una tabla con los datos del formulario
        // (aprendiz / personaje), sin tabla de roles separada.
        $pdo->exec("CREATE TABLE IF NOT EXISTS aprendiz (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            apellido TEXT NOT NULL,
            email TEXT NOT NULL,
            edad INTEGER NULL,
            rol TEXT NULL,
            varita TEXT NULL,
            patronus TEXT NULL,
            habilidades TEXT NULL,
            comentario TEXT NULL,
            foto TEXT NULL,
            creado_en TEXT DEFAULT CURRENT_TIMESTAMP
        );");


    } else {
        // Si no hay SQLite, intentamos con MySQL (requiere pdo_mysql y servidor MySQL)
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $pdo = new PDO($dsn, $user, $pass, $options);
    }
} catch (\PDOException $e) {
    echo "error: " . $e->getMessage();
    exit;
}
