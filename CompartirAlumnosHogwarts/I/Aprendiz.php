<?php
require_once __DIR__ . "/../database/Database.php";

class Aprendiz {
    /**
     * Clase modelo para representar un aprendiz de Hogwarts
     * Atributos: nombre, casa, varita, asignaturas, nivel, foto
     * Métodos: __construct, guardar()
    */
    private $nombre;
    private $casa;
    private $varita;
    private $asignaturas;
    private $nivel;
    private $foto;
    

    public function __construct($nombre, $casa, $varita, $asignaturas, $nivel, $foto) {
    /**
    * Inicializa un nuevo aprendiz con los datos proporcionados
    */
        $this->nombre = $nombre;
        $this->casa = $casa;
        $this->varita = $varita;
        $this->asignaturas = $asignaturas;
        $this->nivel = $nivel;
        $this->foto = $foto;
    }

    public function guardar() {
        try {
            $pdo = (new Database())->conectar();

            $sqlCreate = "CREATE TABLE IF NOT EXISTS aprendices (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100),
                casa VARCHAR(50),
                varita VARCHAR(100),
                asignaturas TEXT,
                nivel INT,
                foto_registro VARCHAR(255)
            )";
            $pdo->exec($sqlCreate);

            // 2. INSERTAR
            $sql = "INSERT INTO aprendices (nombre, casa, varita, asignaturas, nivel, foto_registro) VALUES (:nombre, :casa, :varita, :asignaturas, :nivel, :foto_registro)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                ':nombre'       => $this->nombre,
                ':casa'         => $this->casa,
                ':varita'       => $this->varita,
                ':asignaturas'  => $this->asignaturas,
                ':nivel'        => $this->nivel,
                ':foto_registro'=> $this->foto
            ]);

            // Devolvemos el ID para la sesión
            return $pdo->lastInsertId();

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}
