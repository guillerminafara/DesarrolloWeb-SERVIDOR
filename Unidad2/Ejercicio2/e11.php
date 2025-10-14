<?php
function menu()
{
    echo "   1. Crear pedido: \n
    2. Añadir plato a un pedido: \n
    3. Ver detalle de un pedido: \n
    4. Listar todos los pedidos: \n
    5. Salir.\n";

    echo "Vamos a crear tu pedido :P :";
    crearPedido();
}
function platos()
{
    $platos = [
        "Arroz al horno" => 15,
        "Pizza" => 15.2,
        "Desayuno Continental" => 8.99,
        "Pollo al horno" => 7.5,
        "Hamburguesas con papa" => 12
    ];
    return $platos;
}
function pedido()
{
    $num = 0;
    $cliente = "";
    $platos = [];

    // $arrayPedidos = [$num, $pedido];
}

function crearPedido()
{
    $platos = platos();
    $pedido = [];
    $i = 0;
    echo "\n";
    echo "Indicame tu nombre: ";
    $cliente = trim(fgets(STDIN));
    // $cliente = "paquito";
    // $cantidad=
    // echo "clear";
    do {
        echo "\n Qué vas a comer hoy $cliente ?: \n";

        foreach ($platos as $clave => $valor) {
            $i++;
            echo "$i - $clave............... $valor\n";
        }
        echo "-->";
        $eleccion = (int)(fgets(STDIN));
        $nombres = array_keys($platos);
        echo "vamos por ese " . $nombres[$eleccion - 1];
        $nombrePlato = $nombres[$eleccion - 1];
        echo "\n Quieres otro plato? s/n: \n";
        $resp = trim(fgets(STDIN));
        cargarPedido($pedido, $cliente, $nombrePlato);
        $i = 0;
    } while ($resp !== "n");


    // pedido();
}
function cargarPedido($pedido, $cliente, $clave)
{
    $platos = platos();
    static $num = 1;
  $plato=[];
    foreach ($platos as $nombre => $precio) {
        if($nombre===$clave){
            $plato[$nombre]=$precio;
        }
    }

    $pedido = [$num => [$num, $cliente, $plato]];
    foreach ($pedido as $num => $arreglo) {
        echo "";
        echo "\n Las claves: $num \n";
        foreach ($arreglo as $valor) {

            if (is_array($valor)) {
                foreach ($valor as $subclave => $subvalor) {
                    echo " $subclave: $subvalor";
                }
                
            } else {
                echo "\n El pedido de $cliente incluye: $valor ";
            }
        }
        // for ($value as $valor) { 
        //     echo $valor;
        // }

    }
    $num++;
}

menu();
