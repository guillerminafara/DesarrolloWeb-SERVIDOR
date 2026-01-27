<?php

/**
 * @author Guillermina Fara 
 */
class Incidencia
{
    public $numPuesto;
    public $informacion;
    public static $contador = 0;
    public $codigo = 0;
    public $estado;
    public static $pendientes = 0;

    function __construct($numPuesto, $informacion)
    {
        if (is_int($numPuesto)) {
            $this->numPuesto = $numPuesto;
        }
        if (is_string($informacion)) {
            $this->informacion = $informacion;
        }
        self::$contador++;
        $this->codigo= self::$contador;
        $this->estado = "pendiente";
        self::$pendientes++;
    }

    static function getPendientes()
    {
        return self::$pendientes;
    }
    function resuelve($solucion)
    {
        $this->estado = "resuelta";
        self::$pendientes--;
    }
    function getCodigo(){
        return self::$pendientes;
    }

    function __toString()
    {
        return "Incidencia " . (string)$this->codigo . " -Puesto:" . (string)$this->numPuesto . " - $this->informacion" . "<br>";
    }
}
