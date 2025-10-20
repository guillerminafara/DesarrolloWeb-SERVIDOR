<?php
function comprobarNumeric($valor)
{
   return (is_numeric($valor)) ? true : false;
}

function comprobarMayus($valor)
{
    return ctype_upper($valor) ? true : false;
}
function comprobarMinus($valor)
{
    return ctype_lower($valor) ? true : false;

}

function comprobarDot($valor){
    return false;
   //return chr($valor) === 46 ? true : false;
}
function comprobarEspacio($valor){
    return ctype_space($valor)? true : false;
}
function comprobarCaracter($valor){

    return preg_match($valor,"/[^a-zA-Z0-9]/")? true : false;
   // chr($valor) >=33 && chr($valor)<=45 || chr($valor)>=58&& chr($valor)<=64
}


?>