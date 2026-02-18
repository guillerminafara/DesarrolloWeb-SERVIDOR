<?php
require_once __DIR__ . "/../models/Aprendiz.php";
class AprendizController {

    public function guardar($nombre, $casa, $varita, $asignaturas, $nivel, $foto) { // guardar($datosformulario)
        /***
         * Crear una instancia del modelo Aprendiz 
         * y guardar el aprendiz en la base de datos
         */
        $aprendiz = new Aprendiz($nombre, $casa, $varita, $asignaturas, $nivel, $foto);
        return $aprendiz->guardar();
    }
}
