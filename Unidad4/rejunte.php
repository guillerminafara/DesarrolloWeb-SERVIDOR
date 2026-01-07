<?php

class Vehiculo
{
    protected int $kilometrosRecorridos = 0;

    protected static int $vehiculosCreados = 0;
    protected static int $kilometrosTotales = 0;

    public function __construct()
    {
        self::$vehiculosCreados++;
    }

    public function avanza(int $km): void
    {
        if ($km > 0) {
            $this->kilometrosRecorridos += $km;
            self::$kilometrosTotales += $km;
        }
    }

    public function verKMRecorridos(): string
    {
        return "Kilómetros recorridos: {$this->kilometrosRecorridos}\n";
    }

    public static function verKMTotales(): string
    {
        return "Kilómetros totales recorridos: " . self::$kilometrosTotales . "\n";
    }

    public static function verVehiculosCreados(): string
    {
        return "Vehículos creados: " . self::$vehiculosCreados . "\n";
    }
}
<?php
include_once "Vehiculo.php";

class Coche extends Vehiculo
{
    private bool $depositoLleno = false;

    public function llenarDeposito(): string
    {
        $this->depositoLleno = true;
        return "Depósito lleno\n";
    }

    public function quemaRueda(): void
    {
        echo "El coche está quemando rueda 🔥\n";
    }

    // Redefinición
    public function verKMRecorridos(): string
    {
        return "Soy un COCHE y he recorrido {$this->kilometrosRecorridos} km\n";
    }
}
<?php
include_once "Vehiculo.php";

class Bicicleta extends Vehiculo
{
    private bool $cadenaPuesta = true;

    public function hacerCaballito(): void
    {
        echo "La bicicleta hace un caballito 🚲\n";
    }

    public function ponerCadena(): void
    {
        $this->cadenaPuesta = true;
        echo "Cadena puesta correctamente\n";
    }

    // Redefinición
    public function verKMRecorridos(): string
    {
        return "Soy una BICICLETA y he recorrido {$this->kilometrosRecorridos} km\n";
    }
}
