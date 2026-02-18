<?php

class AprendizController
{

    public function guardar($nombre, $casa, $varitas, $asignaturas, $nivel, $foto)
    {
        /***
         * Crear una instancia del modelo Aprendiz 
         * y guardar el aprendiz en la base de datos
         */

        $aprendiz = new Aprendiz($nombre, $casa, $varitas, $asignaturas, $nivel, $foto);

        return $aprendiz->guardar();
    }
}
