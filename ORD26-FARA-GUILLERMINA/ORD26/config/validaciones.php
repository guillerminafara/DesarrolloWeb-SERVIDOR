<?php

/**
 * Criterios de evaluación cubiertos en este archivo:
 *
 * RA1.e – Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.
 *
 * RA2.d – Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.
 * RA2.e – Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.
 * RA2.g – Se han utilizado los distintos tipos de variables y operadores disponibles en el lenguaje.
 * RA2.h – Se han identificado los ámbitos de utilización de las variables.
 *
 * RA3.a – Se han utilizado mecanismos de decisión en la creación de bloques de sentencias.
 * RA3.d – Se han creado y utilizado funciones.
 * RA3.g – Se han añadido comentarios al código.
 */


// TODO: Implementar validación que compruebe si un valor requerido está vacío
function validaRequerido($valor){ 
    if( $valor== ''){
        return false;
    }else{
        return true;
    }
}



// TODO: Implementar validación que compruebe si un email tiene formato válido
function validaEmail($valor){ 
    if(filter_var($valor, FILTER_VALIDATE_EMAIL) === false){
        return false;
    }else{
        return true;
    }
}


// TODO: Implementar validación que compruebe si un valor contiene solo letras
function validaAlfabeto ($valor){
    if (ctype_alpha($valor)===FALSE){
        return false;
    }else{
        return true;
    }
}


// TODO: Implementar validación que compruebe si un valor contiene solo caracteres alfanuméricos
function validaAlfanum ($valor){
    if (ctype_alnum($valor) ===FALSE){
        return false;
    }else{
        return true;
    }
}


// TODO: Implementar validación que compruebe si un valor contiene solo números
function validaNumero ($valor){
    if (is_numeric($valor) ===FALSE){
        return false;
    }else{
        return true;
    }
}

    
?>