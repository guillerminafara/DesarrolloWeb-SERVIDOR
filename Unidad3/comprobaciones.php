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
    return strpos($valor, '.') !== false;
//    return chr($valor) === 46 ? true : false;
}
function comprobarEspacio($valor){
    return ctype_space($valor)? true : false;
}
function comprobarCaracter($valor){
    
    return preg_match("/[^a-zA-Z0-9\s.]/", $valor)? true : false;
 
}
function comprobarMail($mail){
    return preg_match(" /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$mail) ?true : false; 
     
}

?>