<? php /* CalculadoraTest.php */
use Calculadora;
use PHPUnit\Framework\TestCase;
class CalculadoraTest extends TestCase
{ //El nombre de las funciones de pruebas debe comenzar por test*
public function testSumar(){
    $cal = new Calculadora();
    $this->assertEquals( 6, $cal->sumar(2,4), "2+4 debe dar 6" );
    // más assertEquals tests...
    }
}
?>