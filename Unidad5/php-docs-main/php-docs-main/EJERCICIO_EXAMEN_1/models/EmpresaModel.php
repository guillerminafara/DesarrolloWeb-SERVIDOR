<?php
//esta clase se centra en tratar de forma ORM los datos obtenidos de la base de datos
require_once "Database.php";

class EmpresaModel{
    private $db;
    
    public function __construct($conexion){
        $this->db = $conexion;
    }

    function getPDO(){
        return $this->db->getPDO();
    }

    public function consultaCompras() {
        $sql = "SELECT COD_PROD, NOMBRE, PROVEEDOR, PVP FROM PRODUCTO"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function consultaMarketing() {
        $sql = "SELECT NOMBRE, PVP FROM PRODUCTO ORDER BY NOMBRE ASC"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function consultaUsuario() {
        $sql = "SELECT NOMBRE, PVP FROM PRODUCTO WHERE PVP <= 100"; 
        
        $stmt = $this->db->prepare($sql); 
        $stmt->execute(); 
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}