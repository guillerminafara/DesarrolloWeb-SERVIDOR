<?php
/**
 * @author Guillermina Fara 
 */

class Movil extends Terminal{

    private $tarifa;
    private $coste=0.0;

    private $tarifas=["rata"=>0.06, "mono"=>0.12, "bisonte"=>0.3];
    function __construct($numero, $tarifa)
    {
        parent::__construct($numero);
        $this->tarifa=$tarifa;
    }
    function getNumero(){
        return $this->numero;
    }
    function llama(Terminal $terminal, $segundosLlamada){

    }

}