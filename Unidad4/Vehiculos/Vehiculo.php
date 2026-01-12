<?php
/**
 * @author Guillermina Fara
 */
class Vehiculo
{
  protected static $vehiculosCreados=0;
  protected static $kilometrosTotales;
  protected  $kilometrosRecorridos;

  public function __construct(){
    self::$vehiculosCreados++;
  }
  function avanza($km) {
    if($km>0){
      $this->kilometrosRecorridos+=$km;
      self::$kilometrosTotales+=$km;
    }else{
      echo"\nSolo se admite valores positivos";
    }
  }

  function verKMRecorridos() {
    echo "\nKilómetros recorridos desde vehiculo:  ".$this-> kilometrosRecorridos;
  }
  static function verKMTotales()
  {
    echo "\nKilómetros totales recorridos: ". self::$kilometrosTotales;
  }
  static function verVehiculosCreados()
  {
    echo "\nVehículos creados: ".self::$vehiculosCreados;
  }
}
