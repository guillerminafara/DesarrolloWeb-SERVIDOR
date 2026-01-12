<?php
include_once "Vehiculo.php";
/**
 * @author Guillermina Fara
 */
class Bicicleta extends Vehiculo
{
    private $cadena = false;

    function hacerCaballito() {
        echo "\nHaciendo caballito ";
    }
    function ponerCadena()
    {
        if ($this->cadena) {
            echo "\nLa cadena ya se encuentra puesta";
        } else {
            $this->cadena = true;
            echo "\nPoniendo cadena";
            sleep(3);
            echo "\nCadena Puesta con éxito";
        }
    }
    function vrKMRecorridos()
    {
        // parent::verKMRecorridos();
        return "\nKms recorridos en bicicleta: ". $this-> kilometrosRecorridos;
    }
}
