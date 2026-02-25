<?php
include_once __DIR__ . "/../models/Aprendiz.php";
class AprendizController
{
    //función del controlador que recibe la información desde las vistas y se la pasa al modelo
    public function guardar($nombre, $casa, $varitas, $asignaturas, $nivel, $foto)
    {
        /***
         * Crear una instancia del modelo Aprendiz 
         * y guardar el aprendiz en la base de datos
         */

        $aprendiz = new Aprendiz($nombre, $casa, $varitas, $asignaturas, intval($nivel), $foto);

        return $aprendiz->guardar();
    }
// función que recibe el id y devuelve el aprendiz que tiene ese id
    public function buscarAprendizById($id)
    {
        return Aprendiz::buscarAprendizById($id);
    }
}
