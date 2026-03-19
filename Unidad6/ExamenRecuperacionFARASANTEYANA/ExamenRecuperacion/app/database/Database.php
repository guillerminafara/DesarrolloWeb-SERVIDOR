<?php

class Database {
    /**
     * Configuración de la base de datos
     */

    private $host = "127.0.0.1:3306";
    // private $db = "guillermina";
    private $db = "starwars";

    // private $usuario = "dwes";
    private $usuario = "root";

    // private $contrasena = "dbdwespass";
    private $contrasena = "1234";

    private $charset = "utf8mb4";

    public function conectar() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $opciones = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        return new PDO($dsn, $this->usuario, $this->contrasena, $opciones);
    }
}
