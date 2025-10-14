<?php
function menu2()
{
    $menu = [];
    echo "\n Cuántas opciones quieres que tenga el menú? ";
    $num = (int) fgets(STDIN);
    // $num = 2;
    echo "\n Deseas usar números o letras para las opciones? (n/l): ";
    $tipo = trim(fgets(STDIN));
    // $tipo = "1";
    echo "\n Qué caracter prefieres para finalizar el programa?: ";
    $fin = trim(fgets(STDIN));
    // $fin = "*";
    cargaMenu($num, $tipo, $fin);
    // leerMenu($menu, $fin);
}

menu2();
function cargaMenu($num, $tipo, $fin)
{
    $mapa = [];
    $clave = "";
    $submenu = [];
    $paraMenu = "";
    for ($i = 1; $i <= $num; $i++) {
        echo "Introduce el texto para la opción " . ($i) . ": ";
        $texto = trim(fgets(STDIN));
        // $texto = "gaseosa";

        if ($tipo === "1") {
            $clave = trim((string)($i));
        } else if ($tipo === "n") {
            $clave = trim(chr(96 + $i));
        } else {
            echo "entra en ninguno";
        }
        echo "La opción $clave, tendrá submenú? s/n: ";
        $smenu = strtolower(trim(fgets(STDIN)));

        if ($smenu === "s") {
            $submenu = submenu($clave, $texto);
            $paraMenu = $texto;
            $texto = $submenu;
            
        }
        $mapa[$clave] = $texto;
    }
    leerMenu($mapa, $fin, $paraMenu);
}
function submenu($clave, $text0o)
{
    $submenu = [];
    // $texto = "";
    echo "cuantas opciones tendrá el submenu?";
    $num = fgets(STDIN);
    if (is_numeric($clave)) {
        for ($i = 1; $i <= $num; $i++) {
            $subClave1 = trim("$clave-" . chr(96 + $i));
            echo "Texto para la opción $text0o $subClave1: ";
            $texto = fgets(STDIN);
            $submenu[$subClave1] = $texto;
        }
    } else {
        for ($i = 1; $i <= $num; $i++) {
            $subclave2 = "$clave-" . $i;
            echo "\n ";
            echo "Texto para la opción $subclave2: ";
            $texto = fgets(STDIN);
            $submenu[$subclave2] = $texto;
        }
    }

    return $submenu;
}

function leerMenu($menu, $fin, $vector)
{
    do {
        echo "------------> Menú: <---------------\n ";

        foreach ($menu as $clave => $valor) {
            if (is_array($valor)) {
                echo "$clave - $vector Subclase \n";
                // foreach ($valor as $subclave => $subvalor) {

                //     echo "---------$subclave - $subvalor \n";
                // }
            } else {
                echo "$clave - $valor \n";
            }
        }
        echo "$fin - Salir\n";
        echo "\n";

        echo "Qué opción quieres leer? ";
        $opcion = trim(fgets(STDIN));

        if ($opcion === $fin) {
            echo "\n Saliendo\n";
            break;
        }

        if (array_key_exists($opcion, $menu)) {
            $clavepaver = $menu[$opcion];
            if (is_array($clavepaver)) {
                echo "\n Mostrando $vector opción $opcion:\n";
                foreach ($clavepaver as $subclave => $subvalor) {
                    echo "---------$subclave - $subvalor \n";
                }
        
            } else {
                echo "\n Mostrando $opcion: {$menu[$opcion]}\n";
            }
        } else if (!array_key_exists($opcion, $menu)) {
            echo "\n Opción no válida\n";
            continue;
        }
    } while (true);
}
