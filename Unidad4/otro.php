<?php

trait DNI
{
    public function generarDNI(): string
    {
        $numero = rand(10000000, 99999999);
        $resto = $numero % 23;
        $letra = $this->generaLetraDNI($resto);

        return $numero . $letra;
    }

    // No visible fuera de la clase
    private function generaLetraDNI(int $idLetra): string
    {
        $letras = [
            'T','R','W','A','G','M','Y','F','P','D','X',
            'B','N','J','Z','S','Q','V','H','L','C','K','E'
        ];

        return $letras[$idLetra];
    }
}
<?php

include_once "DNI.php";

class Persona
{
    use DNI;

    // Constantes IMC
    public const INFRAPESO = -1;
    public const PESO_IDEAL = 0;
    public const SOBREPESO = 1;

    // Atributos
    private string $nombre = "";
    private int $edad = 0;
    private string $dni;
    private string $sexo = "H";
    private float $peso = 0.0;
    private float $altura = 0.0;

    // Constructor por defecto
    public function __construct()
    {
        $this->dni = $this->generarDNI();
    }

    // "Constructor" nombre, edad y sexo
    public static function consNomEdSex(string $nombre, int $edad, string $sexo): Persona
    {
        $p = new Persona();
        $p->nombre = $nombre;
        $p->edad = $edad;
        $p->sexo = $p->comprobarSexo($sexo);
        return $p;
    }

    // "Constructor" completo
    public static function consFull(
        string $nombre,
        int $edad,
        string $sexo,
        float $peso,
        float $altura
    ): Persona {
        $p = new Persona();
        $p->nombre = $nombre;
        $p->edad = $edad;
        $p->sexo = $p->comprobarSexo($sexo);
        $p->peso = $peso;
        $p->altura = $altura;
        return $p;
    }

    // ====================
    // Getters y setters
    // ====================
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setEdad(int $edad): void { $this->edad = $edad; }
    public function setSexo(string $sexo): void { $this->sexo = $this->comprobarSexo($sexo); }
    public function setPeso(float $peso): void { $this->peso = $peso; }
    public function setAltura(float $altura): void { $this->altura = $altura; }

    // ====================
    // Métodos privados
    // ====================
    private function comprobarSexo(string $sexo): string
    {
        return ($sexo === 'M' || $sexo === 'H') ? $sexo : 'H';
    }

    // ====================
    // Métodos IMC
    // ====================
    private function calcularIMC(): int
    {
        if ($this->altura <= 0) return self::INFRAPESO;

        $imc = $this->peso / ($this->altura ** 2);

        if ($imc < 20) {
            return self::INFRAPESO;
        } elseif ($imc <= 25) {
            return self::PESO_IDEAL;
        } else {
            return self::SOBREPESO;
        }
    }

    private function strIMC(): string
    {
        $resultado = $this->calcularIMC();

        return match ($resultado) {
            self::INFRAPESO => "{$this->nombre} está por debajo de su peso ideal\n",
            self::PESO_IDEAL => "{$this->nombre} está en su peso ideal\n",
            self::SOBREPESO => "{$this->nombre} tiene sobrepeso\n",
        };
    }

    public function mostrarIMC(): string
    {
        return $this->strIMC();
    }

    // ====================
    // Otros métodos
    // ====================
    public function esMayorDeEdad(): bool
    {
        return $this->edad >= 18;
    }

    public function __toString(): string
    {
        return "Nombre: {$this->nombre}
Edad: {$this->edad}
DNI: {$this->dni}
Sexo: {$this->sexo}
Peso: {$this->peso}
Altura: {$this->altura}\n";
    }
}
