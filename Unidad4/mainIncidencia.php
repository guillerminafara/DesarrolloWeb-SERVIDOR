<?php
/**
 * @author Silvia Vilar
 * Ej1UD8 - mainIncidencia.php
 */ 
include "./clases/Incidencia.php";
$inc1 = new Incidencia(105, "No tiene acceso a internet");
$inc2 = new Incidencia(14, "No arranca");
$inc3 = new Incidencia(5, "La pantalla se ve rosa");
$inc4 = new Incidencia(237, "Hace un ruido extraño");
$inc5 = new Incidencia(111, "Se cuelga al abrir 3 ventanas");
$inc2->resuelve("El equipo no estaba enchufado");
$inc3->resuelve("Cambio del cable VGA");
print $inc1;
print $inc2;
print $inc3;
print $inc4;
print $inc5;
print "Incidencias pendientes: " . Incidencia::getPendientes();

?>