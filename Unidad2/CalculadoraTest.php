<?php /* CalculadoraTest.php */

require_once 'Calculadora.php';
use PHPUnit\Framework\TestCase;


class CalculadoraTest extends TestCase
{ //El nombre de las funciones de pruebas debe comenzar por test*
    public function testSumar()
    {
        $cal = new Calculadora();
        $this->assertEquals(6, $cal->sumar(2, 4), "2+4 debe dar 6");
        $this->assertTrue(true, 6 === $cal->sumar(2, 4), "2+4==6 debe devolver true");
        // $this->assertEquals(5, $cal->sumar(2, 4), "2+4 debe dar 6");

    }
    public function testRestar()
    {
        $cal = new Calculadora();
        $this->assertEquals(1, $cal->restar(5, 4), "5-4 debe dar 1");  
        $this->assertTrue(true,-1=== $cal->restar(2, 3), "2-3 =-1 debe devolver true"); 
        // $this->assertEquals(9, $cal->restar(10, 3));
    }
      public function testMultiplicar()
    {
        $cal = new Calculadora();
        $this->assertEquals(6, $cal->multiplicar(2, 3),"2*3 debe dar 6");   
        $this->assertTrue(true, 0, $cal->multiplicar(0, 5), );   
        // $this->assertEquals(10, $cal->multiplicar(3, 3));  
    }

    public function testDividir()
    {
        $cal = new Calculadora();
        $this->assertEquals(2, $cal->dividir(6, 3));  
        $this->assertTrue(true, 1.5, $cal->dividir(3, 2)); 
        // $this->assertEquals(5, $cal->dividir(6, 3));   
    }
}
?>