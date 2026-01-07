<?php
/** 
 * @author Silvia Vilar  
 * Ej2UD8 - mainMoviles.php
 */   
include "Movil.php";

$m1 = new Movil("678 11 22 33", "rata");
$m2 = new Movil("644 74 44 69", "mono");
$m3 = new Movil("622 32 89 09", "bisonte");
print $m1 . "<br>\n";
print $m2 . "<br>\n";
$m1->llama($m2, 320);
$m1->llama($m3, 200);
$m2->llama($m3, 550);
print $m1 . "<br>\n";
print $m2 . "<br>\n";
print $m3 . "<br>\n";
?>  
