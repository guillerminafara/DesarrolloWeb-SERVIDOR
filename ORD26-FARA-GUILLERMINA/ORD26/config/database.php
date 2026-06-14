<?php

/**
 * Criterios de evaluación cubiertos en este archivo:
 *
 * RA1.e – Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.
 * RA1.g – Se han reconocido y evaluado las herramientas y frameworks de programación en entorno servidor.
 *
 * RA2.b – Se han identificado las principales tecnologías asociadas.
 * RA2.d – Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.
 * RA2.e – Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.
 * RA2.g – Se han utilizado los distintos tipos de variables y operadores disponibles en el lenguaje.
 * RA2.h – Se han identificado los ámbitos de utilización de las variables.
 *
 * RA5.e – Se han identificado y aplicado los parámetros relativos a la configuración de la aplicación web.
 *
 * RA6.a – Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos.
 * RA6.b – Se han creado aplicaciones que establezcan conexiones con bases de datos.
 *
 * RA9.a – Se han reconocido las ventajas que proporciona la reutilización de código y el aprovechamiento de información ya existente.
 * RA9.e – Se han utilizado librerías de código y frameworks para incorporar funcionalidades específicas a una aplicación web.
 */

// TODO: Completar la cadena de conexión PDO con los datos necesarios
define('DB_HOST', 'localhost');
define('DB_NAME', 'starwars');
define('DB_USER', 'root');
define('DB_PASS', '');
$pdo = new PDO(":host=:;dbname=;charset=utf8", USERNAME, PASSWORD);


$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
