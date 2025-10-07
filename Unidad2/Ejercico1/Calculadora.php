<?php /* Calculadora.php */
class Calculadora
{
    public function sumar($a = 0, $b = 0)
    {
        return $a + $b;
    }
    public function restar($a = 0, $b = 0)
    {
        return $a - $b;
    }
    public function multiplicar($a = 1, $b = 1)
    {
        return $a * $b;
    }
    public function dividir($a = 1, $b = 1)
    {
       if($b==0){
        throw new Exception("No es posible dividir por 0");
       }
        return $a / $b;
    }
}
?>