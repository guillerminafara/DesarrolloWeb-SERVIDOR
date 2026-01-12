<?php

/**@author Guillermina Fara */
class Persona
{
    public $nombre;
    public $edad;
    public $dni;

    public $sexo;
    public $peso;
    public $altura;
    public const INFRAPESO = -1;
    public const PESO_IDEAL = 0;
    public const SOBREPESO = 1;

    function __construct()
    {
        $this->nombre = "";
        $this->edad = 0;
        $this->sexo = "H";
        $this->peso = 0;
        $this->altura = 0;
    }
    //el metodo devuelve un objeto persona porque lo estoy creando desde dentro del objeto, no desde fuera.
    public static function consNomEdSex(string $nombre, int $edad, string $sexo)
    {
        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->edad = $edad;
        $persona->sexo = $sexo;
        $persona->peso = 0;
        $persona->altura = 0;
        return $persona;
    }
    public static function consFull(string $nombre, int $edad, string $sexo, float $peso, float $altura)
    {
        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->edad = $edad;
        $persona->sexo = $persona->comprobarSexo($sexo);
        $persona->peso = $peso;
        $persona->altura = $altura;
        return $persona;
    }
    function comprobarSexo($sexo)
    {
        return (strtoupper($sexo) === "M") ? $sexo : "H";
    }
    function setPeso($peso)
    {
        $this->peso = $peso;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function setAltura($altura)
    {
        $this->altura = $altura;
    }
    function setEdad($edad)
    {
        $this->edad = $edad;
    }
    function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }
    function mostrarIMC()
    {
        $devolver = "";
        $valor = $this->peso / fpow($this->altura, 2);
        if ($valor === self::INFRAPESO) {
            $this ->devolver = "IMC: ".self::INFRAPESO;
        }else{

        }
        return "IMC: ";
    }

    function esMayorDeEdad()
    {
        $this->edad = abs($this->edad);
        return $this->edad >= 18 && $this->edad < 100 ? "Es mayor de edad" : "No es mayor de edad";
    }
}
