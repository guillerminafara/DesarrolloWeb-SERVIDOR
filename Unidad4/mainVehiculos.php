<?php
/**
 * author Silvia Vilar
 * Ej3UD8 - mainVehiculos.php
 */
include "Bicicleta.php";
include "Coche.php";

$bicicleta = new Bicicleta();
$coche = new Coche();

 do{
	echo "MENU PRINCIPAL<br>\n";
	echo "==============<br>\n";
	echo "1. Avanza con la bicicleta<br>\n";
	echo "2. Haz el caballito con la bicicleta<br>\n";
	echo "3. Poner cadena de la bicicleta<br>\n";
	echo "4. Avanza con el coche<br>\n";
	echo "5. Quema rueda con el coche<br>\n";
	echo "6. Llenar depósito del coche<br>\n";
	echo "7. Ver kilometraje de la bicicleta<br>\n";
	echo "8. Ver kilometraje del coche<br>\n";
	echo "9. Ver kilometraje total<br>\n";
	echo "10. Ver número de vehículos<br>\n";
	echo "11. Añade una bicicleta<br>\n";
	echo "12. Añade un coche<br>\n";
	echo "X. Salir<br>\n";
	echo "Elige una opción:<br>\n";
	$opcion=readline();
	switch (strtoupper($opcion)) {
		case '1': //avanza con la bicicleta
			echo "Cuantos km quieres recorrer:<br>\n";
			$km=intval(readline());
			$bicicleta->avanza($km);
			break;

		case '2': //haz el caballito con la bicicleta	
			$bicicleta->hacerCaballito();
			break;
			
		case '3': //poner cadena de la bicicleta
			$bicicleta->ponerCadena();
			break;	

		case '4': //avanza con el coche
			echo "Cuantos km quieres recorrer:<br>\n";
			$km=intval(readline());
			$coche->avanza($km);
			break;	

		case '5': //quema rueda con el coche
			$coche->quemaRueda();
			break;

		case '6':	//llenar depósito del coche
			echo $coche->llenarDeposito();
			break;

		case '7': //ver kilometraje de la bicicleta
			echo $bicicleta->verKMRecorridos();
			break;

		case '8': //ver kilometraje del coche
			echo $coche->verKMRecorridos();
			break;

		case '9': //ver kilometraje total
			echo Vehiculo::verKMTotales();
			break;

		case '10': //ver número de vehículos
			echo Vehiculo::verVehiculosCreados();
			break;

		case '11': //añade una bicicleta
			$nombrebici = readline("Introduce el nombre de la bicicleta: ");
			$$nombrebici = new Bicicleta();
			break;

		case '12': //añade un coche
			$nombrecoche = readline("Introduce el nombre del coche: ");
			$$nombrecoche = new COche();
			break;

		case 'X':
			echo "Programa finalizado";
			break;
			
		default:
			echo "Opción no válida";
			break;
	} 

} while ($opcion!='X');

?>