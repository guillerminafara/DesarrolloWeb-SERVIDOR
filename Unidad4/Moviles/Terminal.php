<?php

class Terminal
{
    protected $numero;
    protected $tiempoConversacion;

    function __construct($numero)
    {
        $this->numero = $numero;
    }

    function llama(Terminal $terminal, $segundosLlamada)
    {
        $this->tiempoConversacion += $segundosLlamada;
        $terminal->tiempoConversacion += $segundosLlamada;
        
    }
   
    function __toString()
    {
        return "Nº $this->numero -- " . (string)intval($this->tiempoConversacion/60)." minutos y ".($this->tiempoConversacion%60)." segundos de conversación total - Tarificados ";
    }
}
