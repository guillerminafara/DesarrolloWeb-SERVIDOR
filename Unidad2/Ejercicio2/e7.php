<?php
echo "Cuántas opciones quieres que tenga el menú? ";
$num = (int) fgets(STDIN);
echo "Deseas usar números o letras para las opciones? (n/l): ";
$tipo = trim(fgets(STDIN));
echo "Qué caracter prefieres para finalizar el programa?: ";
$fin = trim(fgets(STDIN));

$menu = [];
$clave = "";
for ($i = 0; $i < $num; $i++) {
    echo "Introduce el texto para la opción " . ($i + 1) . ": ";
    $texto = trim(fgets(STDIN));

    if ($tipo === "1") {
        echo "entra en numero";
        $clave = trim((string)($i + 1));
    } else if ($tipo === "n") {
        echo "entra en letra";
        $clave = trim(chr(97 + $i));
    } else {
        echo "entra en ninguno";
    }
    $menu[$clave] = $texto;
}


do {
    echo "------------> Menú: <---------------\n ";
    foreach ($menu as $clave => $texto) {
        echo "opción $clave\n";
    }
    echo " Salir - $fin\n";
    echo "\n";

    echo "Qué opción quieres leer? ";

    $opcion = trim(fgets(STDIN));

    if ($opcion === $fin) {
        echo "\n Saliendo\n";
        break;
    }

    if (array_key_exists($opcion, $menu)) {
        echo "\n Mostrando $opcion: {$menu[$opcion]}\n";
    } else {
        echo "\n Opción no válida\n";
    }
} while (true);
