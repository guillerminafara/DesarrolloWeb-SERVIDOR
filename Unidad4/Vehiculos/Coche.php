<?php
include_once "Vehiculo.php";
/**
 * @author Guillermina Fara
 */
class Coche extends Vehiculo
{

  private $deposito = false;
  function llenarDeposito()
  {
    if ($this->deposito) {
      echo "\nEl depósito ya se encuentra lleno";
    } else {
      echo "\nLlenando el depósito";
      sleep(3);
      echo "\nDepósito lleno!";
      $this->deposito = true;
    }
  }
  function quemaRueda()
  {
    echo "\nQuemando ruedas";
  }
  function vrKMRecorridos()
  {
    // parent::verKMRecorridos();
    return "\nkms recorridos desde el coche: " . $this->kilometrosRecorridos;
  }
}
