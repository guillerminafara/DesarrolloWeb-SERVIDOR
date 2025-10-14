<?php
function menu2()
{
    $menu = [];
    echo "Cuántas opciones quieres que tenga el menú? ";
    $num = (int) fgets(STDIN);
    echo "Deseas usar números o letras para las opciones? (n/l): ";
    $tipo = trim(fgets(STDIN));
    echo "Qué caracter prefieres para finalizar el programa?: ";
    $fin = trim(fgets(STDIN));
    $menu = cargaMenu($num, $tipo);
    leerMenu($menu, $fin);
}

menu2();
function cargaMenu($num, $tipo)
{
    $mapa = [];
    $clave = "";
    for ($i = 1; $i <= $num; $i++) {
        echo "Introduce el texto para la opción " . ($i ) . ": ";
        $texto = trim(fgets(STDIN));

        if ($tipo === "1") {
            $clave = trim((string)($i ));
        } else if ($tipo === "n") {
            $clave = trim(chr(96+$i ));
        } else {
            echo "entra en ninguno";
        }
        $mapa[$clave] = $texto;
    }
    return $mapa;
}


function leerMenu($menu, $fin)
{
    do {
        echo "------------> Menú: <---------------\n ";
        foreach ($menu as $clave => $texto) {
            echo "opción $clave\n";
        }
        echo " Salir $fin \n";
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
}
