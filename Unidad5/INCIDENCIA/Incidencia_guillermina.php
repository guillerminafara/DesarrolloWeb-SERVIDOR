<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
    try {
        $db = new PDO("mysql:host=HOST;port=3306;dbname=guillermina", "", "root");
        // $db = new PDO("mysql:host=192.168.1.200;port=3306;dbname=INCIDENCIAS", "dwes", "dbwespass");

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $mysql = new mysqli("localhost:3306", "root", "root", "INCIDENCIAS");

    function leeTodasIncidencias()
    {

    }
    function leeIncidencia($valor)
    {

    }
  
    function borraIncidencia($valor)
    {
        // if(false){
        //     echo "Incidencia eliminada con exito";
        //listarIncidencias();
        // }else{
        //     echo "Error al eliminar la incidencia"; 
        // }

    }
    function actualizaIncidencia()
    {
        // if(false){
        //     echo "Incidencia modificada con exito";
        //mostrarIncidencia($valor);
        // }else{
        //     echo "Error al modificar la incidencia"; 
        // }
    }
    static function resetearBD(){

    }
}
?>