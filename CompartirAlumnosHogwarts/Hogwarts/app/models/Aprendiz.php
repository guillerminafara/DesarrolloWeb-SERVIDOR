<?php
require_once(__DIR__ . "/../database/Database.php");
class Aprendiz
{
    /**
     * Clase modelo para representar un aprendiz de Hogwarts
     * Atributos: nombre, casa, varita, asignaturas, nivel, foto
     * Métodos: __construct, guardar()
     */

    public $nombre;
    public $casa;
    public $varitas;
    public $asignaturas;
    public $nivelMagico;
    public $foto;
    public $fecha;
    static public $pdo; // pdo statico a modo patrón de diseño singleton para evitar repetir conexiones
    public function __construct($nombre, $casa, $varitas, $asignaturas, $nivelMagico, $foto)
    {
        /**
         * Inicializa un nuevo aprendiz con los datos proporcionados
         */
        $this->nombre = $nombre;
        $this->casa = $casa;
        $this->varitas = is_array($varitas) ? implode(",", $varitas) : $varitas;
        $this->asignaturas = is_array($asignaturas) ? implode(",", $asignaturas) : $asignaturas;
        $this->nivelMagico = $nivelMagico;
        $this->foto = $foto;
        $this->fecha = date('Y-m-d H:i:s');
        self::conectarA();
    }
    //funcion estática para conectar con base de datos y obtener el pdo
    private static function conectarA()
    {
        if (self::$pdo === null) {
            self::$pdo = new Database();
            self::$pdo  = self::$pdo->conectar();
        }
    }
//función para crear alumnos en la base de datos
    public function guardar()
    {
        /**
         * Guarda el aprendiz en la base de datos
         * Devuelve el ID del aprendiz insertado
         */
        $result = self::$pdo->prepare("INSERT INTO aprendices (nombre, casa, varita, asignaturas, nivel, foto, fecha_registro)values(?,?,?,?,?,?,?)");
        $result->execute(array(
            $this->nombre,
            $this->casa,
            $this->varitas,
            $this->asignaturas,
            $this->nivelMagico,
            $this->foto,
            $this->fecha
        ));
        $rowsAffected = $result->rowCount();
        if ($rowsAffected > 0) {
            return self::$pdo->lastInsertId();
        }
    }
//funcioon para buscar aprendices por id, devuelde un aprendiz
    static function buscarAprendizById($id)
    {
        self::conectarA();
        $sql = "SELECT * FROM aprendices where id=?";
        $result = self::$pdo->prepare($sql);
        $result->execute([$id]);
        $rowsAffected = $result->rowCount();

        $data = $result->fetch();

        if ($rowsAffected === 0) {
            return "no se pudo encontrar al aprendiz";
        } else {
            $aprendiz = new Aprendiz(
                $data["nombre"],
                $data["casa"],
                explode(",", $data["varita"]),
                explode(",", $data["asignaturas"]),
                $data["nivel"],
                $data["foto"]
            );
            return $aprendiz ?: null;
        }
    }
}
