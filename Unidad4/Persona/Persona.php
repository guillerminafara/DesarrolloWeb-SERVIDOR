<?php

/**
 * @author Guillermina Fara 
 * 
 */
class Persona
{
    use DNI;
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
        // self::comprobarSexo($this->sexo);
        $this->peso = 0;
        $this->altura = 0;
        $this->dni = $this->generarDNI();
    }
    //el metodo devuelve un objeto persona porque lo estoy creando desde dentro del objeto, no desde fuera.
    public static function consNomEdSex(string $nombre, int $edad, string $sexo)
    {
        $persona = new Persona();
        $persona->nombre = $nombre;
        $persona->edad = $edad;
        $persona->sexo = $persona->comprobarSexo($sexo);
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
    private function comprobarSexo($sexo)
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

        $this->sexo = self::comprobarSexo($sexo);
    }
    function calcularIMC()
    {
        $valor = ($this->peso / pow($this->altura, 2));
        if ($valor < 20) {
            return self::INFRAPESO;
        } else if ($valor >= 20 && $valor <= 25) {
            return self::PESO_IDEAL;

        } else {
            return self::SOBREPESO;
        }
    }

    function strIMC()
    {
        $valor = self::calcularIMC();

        if ($valor === self::INFRAPESO) {
            return "\n $this->nombre  Se encuentra bajo peso";
        } else if ($valor === self::PESO_IDEAL) {
            return "\n $this->nombre  Se encuentra en su peso ideal";

        } else {
            return " \n $this->nombre Se encuentra sobre peso";
        }

    }
    function mostrarIMC()
    {
        print self::strIMC();// hacer print
    }

    function esMayorDeEdad()
    {
        $this->edad = abs($this->edad);
        if ($this->edad >= 18 && $this->edad < 110) {
            print ("\n $this->nombre con DNI: $this->dni es mayor de Edad");
        } else if ($this->edad >= 0 && $this->edad < 18) {
            print ("\n $this->nombre con DNI: $this->dni es menor de edad");

        }
        return $this->edad >= 18 && $this->edad < 110 ? true : false;
    }

    function __toString()
    {
        return " La persona: $this->nombre, $this->sexo de $this->edad años DNI $this->dni . Con altura $this->altura y peso $this->peso kgs ";
    }

}
trait DNI
{
    public function generarDNI()
    {
        $numeroAleatorio = rand(10000000, 99999999);
        $resto = $numeroAleatorio % 23;
        $letra = $this->generarLetraDNI($resto);
        return $numeroAleatorio . $letra;
    }
    private function generarLetraDNI($idLetra)
    {
        $letras = [
            'T',
            'R',
            'W',
            'A',
            'G',
            'M',
            'Y',
            'F',
            'P',
            'D',
            'X',
            'B',
            'N',
            'J',
            'Z',
            'S',
            'Q',
            'V',
            'H',
            'L',
            'C',
            'K',
            'E'
        ];
        print ("Ejemplo de letra " . $letras[$idLetra]);
        return $letras[$idLetra];
    }

}
