<?php

class AprendizController {

    public function guardar($datosFormulario) {
        /***
         * Crear una instancia del modelo Aprendiz 
         * y guardar el aprendiz en la base de datos
         */

        $aprendiz= new Aprendiz($datosFormulario);

    }
}
