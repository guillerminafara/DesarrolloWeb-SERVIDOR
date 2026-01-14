<?php
/**
 * @author Silvia Vilar
 * Ej4UD8 - mainPersona.php
 */
include "Persona.php";
//Obtenermos los datos de la persona
print "Introduce el nombre de la persona: ";
$nombre="paquito";//readline();
print "Introduce la edad de la persona: ";
$edad=20;//intval(readline());
print "Introduce el sexo de la persona (H o M): ";
$sexo="h";//readline();
print "Introduce el peso de la persona: ";
$peso=floatval(125);//floatval(readline());
print "Introduce la altura de la persona: ";
$altura=floatval(1.70);//floatval(readline());
//Creamos 3 personas usando cada uno de los constructores
$p1 = Persona::consFull($nombre, $edad, $sexo, $peso, $altura);
$p2 = Persona::consNomEdSex("Maria", 18, 'M');
$p2->setPeso(50);
$p2->setAltura(1.65);
$p3 = new Persona();
$p3->setNombre("Juan");
$p3->setEdad(16);
$p3->setSexo('Z');
$p3->setPeso(70);
$p3->setAltura(1.70);
//Calculamos el IMC
print $p1->mostrarIMC();
print $p2->mostrarIMC();
print $p3->mostrarIMC();
//Indicamos si es mayor de edad
$p1->esMayorDeEdad();
$p2->esMayorDeEdad();
$p3->esMayorDeEdad();
//Imprimimos los datos de las personas
print "\n PERSONA 1 ";
print $p1;
print "\n PERSONA 2 ";
print $p2;
print "\n PERSONA 3 ";
print $p3;
print "\n FIN DEL PROGRAMA ";
?>