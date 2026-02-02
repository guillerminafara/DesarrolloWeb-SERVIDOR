<?php
//se encarga de hacer la conexion con la base de datos mediante el PDO
require_once "config.php";  

class Database{
    private $PDO = null;
    
    public function __construct(){
        try{
            $this->PDO = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PASS);
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    function getPDO(){
        return $this->PDO;
    }
}