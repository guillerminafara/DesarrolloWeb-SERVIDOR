<?php
class Trabajador {
    private string $nombre;
    private float $salario;

    private static array $registro = [];

    public function __construct(string $nombre, float $salario) {
        $this->nombre  = $nombre;
        $this->salario = $salario;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getSalario(): float {
        return $this->salario;
    }
    public static function inicializarRegistro(): void {
        if (!empty(self::$registro)) {
            return;
        }

        self::$registro = [
            new Trabajador("Ana",    1500),
            new Trabajador("Luis",   1800),
            new Trabajador("María",  2100),
            new Trabajador("Carlos", 1200),
            new Trabajador("Elena",  3000),
        ];
    }
    public static function obtenerTodos(): array {
        self::inicializarRegistro();
        return self::$registro;
    }
    public static function setRegistro(array $trabajadores): void {
        self::$registro = $trabajadores;
    }
}

function salarioMinimo(array $trabajadores): float {
    $min = PHP_FLOAT_MAX;
    foreach ($trabajadores as $t) {
        if ($t->getSalario() < $min) {
            $min = $t->getSalario();
        }
    }
    return $min;
}

function salarioMaximo(array $trabajadores): float {
    $max = 0.0;
    foreach ($trabajadores as $t) {
        if ($t->getSalario() > $max) {
            $max = $t->getSalario();
        }
    }
    return $max;
}

function salarioMedio(array $trabajadores): float {
    $n = count($trabajadores);
    if ($n === 0) {
        return 0;
    }
    $suma = 0.0;
    foreach ($trabajadores as $t) {
        $suma += $t->getSalario();
    }
    return $suma / $n;
}