<?php
/**
 * @author Silvia Vilar
 * Ej1UD9 - mainIncidencia.php
 */ 
include_once "Incidencia.php";
Incidencia::resetearBD();
$inc1 = Incidencia::creaIncidencia(105, "No tiene acceso a internet");
$inc2 = Incidencia::creaIncidencia(14, "No arranca");
$inc3 = Incidencia::creaIncidencia(5, "La pantalla se ve rosa");
$inc4 = Incidencia::creaIncidencia(237, "Hace un ruido extraño");
$inc5 = Incidencia::creaIncidencia(111, "Se cuelga al abrir 3 ventanas");
$inc2->resuelve("El equipo no estaba enchufado");
$inc3->resuelve("Cambio del cable VGA");
print $inc1;
print $inc2;
print $inc3;
print $inc4;
print $inc5;
print "Incidencias pendientes: " . Incidencia::getPendientes();
Incidencia::leeIncidencia($inc1->getCodigo());
Incidencia::leeIncidencia($inc2->getCodigo());
Incidencia::leeIncidencia($inc5->getCodigo());
Incidencia::leeTodasIncidencias();
$inc3->actualizaIncidencia("","La pantalla se ve AZUL","","");
$inc4->actualizaIncidencia("","El ruido es del ventilador","","");
$inc4->resuelve("Se ha limpiado el ventilador");
$inc5->actualizaIncidencia("","Se cuelga al abrir 2 programas","","");
$inc2->borraIncidencia();  
Incidencia::leeTodasIncidencias();  

?>