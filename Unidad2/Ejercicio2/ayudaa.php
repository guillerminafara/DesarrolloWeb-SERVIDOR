<?php
// ==============================
//  PROGRAMA: menu_submenu.php
// ==============================
// Crea un menú dinámico con posibles submenús y navegación entre ellos.

// ======== Función para leer datos desde consola ========
function leer($mensaje) {
    echo $mensaje;
    return trim(fgets(STDIN)); // quita salto de línea
}

// ======== Función para mostrar un menú y permitir navegación ========
function mostrarMenu($menu, $fin, $titulo = "MENÚ PRINCIPAL", $nivel = 0) {
    do {
        echo "\n===== $titulo =====\n";

        // Mostrar opciones del menú actual
        foreach ($menu as $clave => $valor) {
         
            if (is_array($valor)) {
                foreach($valor as $subclave => $subvalor){
                    echo " [$clave] Submenú $subclave- $subvalor \n";
                }
            } else {
                echo " [$clave] $valor\n";
            }
        }
        echo " [$fin] Volver/Salir\n";
        echo "=====================\n";

        $opcion = leer("Elige una opción: ");

        if ($opcion === $fin) {
            if ($nivel === 0) {
                echo "\n👋 Has salido del programa.\n";
            }
            break;
        }

        if (!array_key_exists($opcion, $menu)) {
            echo "\n⚠️  Opción no válida. Intenta de nuevo.\n";
            continue;
        }

        // Si la opción elegida es un submenú (array), entramos recursivamente
        if (is_array($menu[$opcion])) {
            echo "\n👉 Entrando al submenú de la opción '$opcion'\n";
            mostrarMenu($menu[$opcion], $fin, "SUBMENÚ de '$opcion'", $nivel + 1);
        } else {
            echo "\n✅ Has elegido la opción '$opcion': {$menu[$opcion]}\n";
        }

    } while (true);
}

// ======== Programa principal ========
echo "===== MENÚ CON SUBMENÚS =====\n\n";

$numOpciones = (int) leer("¿Cuántas opciones tendrá el menú principal? ");
$tipo = strtolower(leer("¿Deseas usar números o letras para las opciones? (n/l): "));
$fin = leer("¿Qué carácter usaremos para salir o volver? ");

// Crear el menú principal
$menuPrincipal = [];

for ($i = 0; $i < $numOpciones; $i++) {
    if ($tipo === 'n') {
        $clave = (string)($i + 1);
    } else {
        $clave = chr(97 + $i); // a, b, c...
    }

    $texto = leer("Introduce el texto para la opción '$clave': ");
    $tieneSubmenu = strtolower(leer("¿La opción '$clave' tendrá un submenú? (s/n): "));

    if ($tieneSubmenu === 's') {
        // Crear submenú dinámicamente
        $numSub = (int) leer("¿Cuántas opciones tendrá el submenú de '$clave'? ");
        $submenu = [];

        for ($j = 0; $j < $numSub; $j++) {
            $subClave = ($tipo === 'n') ? (string)($j + 1) : chr(97 + $j);
            $subTexto = leer("Introduce el texto para la subopción '$subClave' del menú '$clave': ");
            $submenu[$subClave] = $subTexto;
        }
        $menuPrincipal[$clave] = $submenu;
    } else {
        $menuPrincipal[$clave] = $texto;
    }
}

// Mostrar el menú completo
mostrarMenu($menuPrincipal, $fin);
?>
