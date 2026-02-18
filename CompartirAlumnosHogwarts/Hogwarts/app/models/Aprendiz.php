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
        $this->fecha = time('Y-m-d H:i:s');
    }



    public function guardar()
    {
        /**
         * Guarda el aprendiz en la base de datos
         * Devuelve el ID del aprendiz insertado
         */

        $pdo = new Database();
        $pdo = $pdo->conectar();
        $result = $pdo->prepare("INSERT INTO aprendices (nombre, casa, varita, asignaturas, nivel, foto, fecha_registro)values(?,?,?,?,?,?,?)");

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
            echo "Aprendiz agregado exitosamente";
            return $pdo->lastInsertId();
        }
    }
}
