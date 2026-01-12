<?php
/**
 * @author Guillermina Fara 
 */

include "Terminal.php";
class Movil extends Terminal
{
    static private $calculo = 0.0;
    private $coste = 0.0;
    private $tarifas = ["rata" => 0.06, "mono" => 0.12, "bisonte" => 0.3];
    private $tarifa=0.0;
    private $segundos=0;


    function __construct($numero, $tarifa)
    {
        parent::__construct($numero);
        $this->tarifa =$this->tarifas[$tarifa] ;
    }
    function getNumero()
    {
        return $this->numero;
    }
    function llama(Terminal $terminal, $segundosLlamada)
    {
        parent::llama($terminal, $segundosLlamada);
        $costeTarifa= $this ->tarifa/60;

        $this->segundos+=$segundosLlamada;
        self::$calculo= $this->segundos * $costeTarifa;
        $this-> coste= self::$calculo;
    }

    function __toString()
    {
        // return parent::__toString()." por un importe de ". (string)$this-> coste." euros ".self::$segundos;
        return parent::__toString()." por un importe de ". (string)$this-> coste." euros ".$this->segundos;

    }
}