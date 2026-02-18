<?php
require_once 'database.php';

class Personajes {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::conectar();
    }

    // GET /personajes
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM characters");
        return $stmt->fetchAll();
    }

    // GET /personajes/{id}
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM characters WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // POST /personajes
    public function create($data) {
        $sql = "INSERT INTO characters (name, gender, height) VALUES (:name, :gender, :height)";
        $stmt = $this->pdo->prepare($sql);
        
        // Verificamos que lleguen los datos mínimos
        $name = $data['name'] ?? 'Desconocido';
        $gender = $data['gender'] ?? 'n/a';
        $height = $data['height'] ?? 0;

        if ($stmt->execute([':name' => $name, ':gender' => $gender, ':height' => $height])) {
            // Devolvemos el objeto creado con su nuevo ID
            return [
                'id' => $this->pdo->lastInsertId(),
                'name' => $name,
                'gender' => $gender,
                'height' => $height
            ];
        }
        return false;
    }

    // PUT /personajes/{id}
    public function update($id, $data) {
        // Primero comprobamos si existe
        if (!$this->getById($id)) return false;

        $sql = "UPDATE characters SET name = :name, gender = :gender, height = :height WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':gender' => $data['gender'],
            ':height' => $data['height']
        ]);
    }

    // DELETE /personajes/{id}
    public function delete($id) {
        if (!$this->getById($id)) return false;

        $stmt = $this->pdo->prepare("DELETE FROM characters WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // GET /personajes/importarSWAPI
    public function importarDesdeSwapi() {
        // Obtenemos datos de la API pública usando file_get_contents [cite: 821]
        $json = @file_get_contents('https://swapi.dev/api/people/');
        
        if ($json === false) return false;

        $data = json_decode($json, true); // Decodificamos a array asociativo [cite: 1126]
        $contador = 0;

        $sql = "INSERT INTO characters (name, gender, height) VALUES (:name, :gender, :height)";
        $stmt = $this->pdo->prepare($sql);

        // Recorremos los resultados de SWAPI
        foreach ($data['results'] as $char) {
            // Limpiamos datos (height en SWAPI a veces es "unknown")
            $height = is_numeric($char['height']) ? $char['height'] : 0;
            
            $stmt->execute([
                ':name' => $char['name'],
                ':gender' => $char['gender'],
                ':height' => $height
            ]);
            $contador++;
        }
        return $contador;
    }
}
?>