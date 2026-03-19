<?php
    function validaRequerido($valor){ //Obliga a introducir datos en campos requeridos
        if(trim($valor) == ''){
            return false;
        }else{
            return true;
        }
    }

    function validaEmail($valor){ //valida que se haya introducido un email user@ejemplo.com
        if(filter_var($valor, FILTER_VALIDATE_EMAIL) === FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaAlfabeto ($valor){
        if (ctype_alpha($valor)===FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaAlfanum ($valor){
        if (ctype_alnum($valor)===FALSE){
            return false;
        }else{
            return true;
        }
    }

    function validaNumero ($valor){
        if (ctype_digit($valor)===FALSE){
            return false;
        }else{
            return true;
        }
    }

    
?>