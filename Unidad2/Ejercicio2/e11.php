<?php
function menu()
{
    $arrayPedidos=[];
    do{
        echo "\n";
        echo "      1. Crear pedido: \n
        2. Añadir plato a un pedido: \n
        3. Ver detalle de un pedido: \n
        4. Listar todos los pedidos: \n
        5. Salir.\n";
        echo "-->";
        $resp= (int)trim(fgets(STDIN));
   
        switch($resp){
            case 1:
                echo "Vamos a crear tu pedido :P :";
                $arrayPedidos+=crearPedido();
                break;
            case 2:
                if($arrayPedidos!=null){
                   $arrayPedidos=agregarPlato($arrayPedidos);// ver como
                }else{
                    $arrayPedidos+=crearPedido();
                }

                break;
            case 3: 
                if($arrayPedidos!= null){ 
                    leerArrayPedidos($arrayPedidos);
                }else{
                    echo "No hay pedidos aún \n";
                }
                break;

            case 4: 
                listarTodos($arrayPedidos);
            
                break;
            case 5:
                echo "Saliendoooo \n";
                break;
            default:
                echo "Opción invalida. Vuelve a intentarlo: \n";
                break;

        }

    }while($resp != 5);
    
}
function agregarPlato($arrayPedidos){
    echo "Vamos a agregar un plato a tu pedido :P :";
    $platos= platos();



}
function listarTodos($arrayPedidos){
    $suma=0;
    echo "\n ------------- Listando todos los pedidos:------------- \n";
     foreach($arrayPedidos as $clavePedidos => $pedidos){
        echo "\n num de pedido $pedidos[0]: ";
        echo "\n cliente: $pedidos[1] ";
        foreach ($pedidos as $pedido) {
                if(is_array($pedido)){
                    foreach ($pedido as $nombrePlato => $precio) {
                        $suma=$suma+$precio;
                        echo "\n el plato que ha pedido: $nombrePlato - €$precio  "; 
                        echo "\n";
                    }
                }
        }
    }
}

function leerArrayPedidos($arrayPedidos){
    $suma=0;
    echo "\n Qué pedido quieres ver?: ";
    $resp= trim(fgets(STDIN));
 
    foreach($arrayPedidos as $clavePedidos => $pedidos){
        // echo "\n por las duadas leer ------------> $clavePedidos\n ";
           if($resp==$clavePedidos){
                echo "\n Total de los pedidos: $suma" ; 
                 echo "\n num de pedido $pedidos[0]";
                 echo "\n cliente: $pedidos[1] ";
                 foreach ($pedidos as $pedido) {
                    if(is_array($pedido)){
                        foreach ($pedido as $nombrePlato => $precio) {
                            $suma=$suma+$precio;
                            echo "\n el plato que ha pedido: $nombrePlato - €$precio  "; 
                            
                            echo "\n";
                        }
                    }
             }
            echo "\n Total: $suma";
            }else{
                echo "Resvisa porqu ese pedido no existe: ";
            }
    }
}

function platos()
{
    $i = 0;
    $platos = [
        "Arroz al horno" => 15,
        "Pizza" => 15.2,
        "Desayuno Continental" => 8.99,
        "Pollo al horno" => 7.5,
        "Hamburguesas con papa" => 12
    ];

    foreach ($platos as $clave => $valor) {
        $i++;
        echo "\n $i - $clave............... €$valor";
    }
   
    return $platos;
}


function crearPedido()
{
    echo "\n";
    echo "Indicame tu nombre: ";
    $cliente = trim(fgets(STDIN));
    $platos = platos();
    $ArrayPedidos=[];
    // $i = 0;
    
    do {
        echo "\n Qué vas a comer hoy $cliente ?: \n";

        // foreach ($platos as $clave => $valor) {
        //     $i++;
        //     echo "$i - $clave............... €$valor\n";
        // }
        echo "-->";
        $eleccion = (int)(fgets(STDIN));
        $nombres = array_keys($platos);
        echo "vamos por ese " . $nombres[$eleccion - 1];
        $nombrePlato = $nombres[$eleccion - 1];
        echo "\n Quieres otro plato? s/n: \n";
        $resp = trim(fgets(STDIN));
        //usar funcion agregar pedidos asi es un solo array de pedidos 
        $ArrayPedidos+=cargarPedido($cliente, $nombrePlato);
      
        // $i = 0;
    } while ($resp === "s");

    return $ArrayPedidos;
}
/**
 * clave es el nombre del plato
 */
function cargarPedido( $cliente, $clave)
{
    $platos = platos();
    static $num = 1;
    $plato=[];
    foreach ($platos as $nombre => $precio) {
        if($nombre===$clave){
            $plato[$nombre]=$precio;
        }
    }
    $pedido=[$num,$cliente, $plato];

    $arraypedidos = [$num => [$num, $cliente, $plato]];
    // foreach ($arraypedidos as $num => $arreglopedido) {
        // echo "";
        // echo "\n Las claves: $num \n";
        // foreach ($pedido as $valores) {

        //     if (is_array($valores)) {
        //         foreach ($valores as $subclave => $subvalor) {
        //             echo " $subclave: $subvalor"; //refiere al plato
        //         }
                
        //     } else {
        //         echo "\n El pedido de $cliente incluye: $valor ";
        //     }
        
        // for ($value as $valor) { 
        //     echo $valor;
        // }

    
    //  $num++;
    return $arraypedidos;
}

menu();
