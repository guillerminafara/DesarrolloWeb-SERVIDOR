<?php
require_once("../database/Database.php");
class Aprendiz {
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

    public function __construct($nombre, $casa, $varitas, $asignaturas, $nivelMagico, $foto) {
    /**
    * Inicializa un nuevo aprendiz con los datos proporcionados
    */
        $this->nombre = $nombre;   
        $this->casa = $casa;
        $this->varitas = $varitas;
        $this->asignaturas = $asignaturas;
        $this->nivelMagico = $nivelMagico;
        $this->foto = $foto;
        $this->fecha = new DateTime();

    }   

   

    public function guardar() {
    /**
     * Guarda el aprendiz en la base de datos
     * Devuelve el ID del aprendiz insertado
     */
 
    $pdo= conectar();
    $result= $pdo->prepare("INSERT INTO aprendices (nombre, casa, varita, asignaturas, nivel, foto, fecha_registro)values(?,?,?,?,?,?)"); 
    $result->execute(array($this->nombre, $this->casa, $this->varitas, $this->asignaturas, $this->nivelMagico));    
    $rowsAffected= $result->rowCount();
    if($rowsAffected>0) {
        echo "Aprendiz agregado exitosamente";
    }else{
        echo "Error al agregar al aprendiz";
    }

}
    
}
