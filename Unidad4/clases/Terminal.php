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
        return "Nº $this->numero-" . (string)$this->tiempoConversacion ." de conversación total - Tarificados ";
    }
}
