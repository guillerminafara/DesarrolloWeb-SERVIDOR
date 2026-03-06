<?php

/**
 * @autor Silvia Vilar
 * Ejercicio 2 UP5. Consultas
 */
include_once __DIR__ . "/BDConfig.php";

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // Determina el tipo de consulta
    $tipoConsulta = $_POST["tipoConsulta"] ?? "";
    $parametros = [];
    $query = null;


    switch ($tipoConsulta) {
        //consultas de Clientes
        case 'ClientePorDni':
            //Datos de CLIENTE por DNI
            $query = "select * from CLIENTE where DNI=?";
            $parametros = [$_POST["dni"]];
            break;

        case 'ListadoClientes':
            //Listado de todos los Clientes ordenados por DNI de CLIENTE
            $query = "select * from CLIENTE order by DNI";

            break;

        case 'ClientesDadaPoblacion':
            //Datos de Clientes de una Población seleccionada ordenados por DNI de CLIENTE

            $query = "select * from CLIENTE where POBLACION=? order by DNI";
            $parametros = [$_POST["poblacion"]];
            break;
        case 'ListadoClientesPorPoblacion':
            //Listado de Clientes de una población seleccionada ordenados por población
            $query = "select * from CLIENTE where POBLACION=? order by POBLACION";
            $parametros = [$_POST["poblacion"]];
            break;

        case 'NumeroClientesPorPoblacion':
            //Listado de Clientes de una población seleccionada ordenados por población
            $query = "select POBLACION, count(*) as Cantidad from CLIENTE group by POBLACION order by POBLACION";

            break;

        case 'ListadoClientesConCompras':
            //Datos de Clientes que han realizado Compras ordenados por DNI de CLIENTE
            $query = "SELECT CLIENTE.DNI, CLIENTE.NOMBRE FROM CLIENTE JOIN COMPRA ON (CLIENTE.DNI = COMPRA.CLIENTE) ORDER BY DNI";

            break;
        case 'ListadoClientesSinCompras':
            //Datos de Clientes que no han realizado Compras ordenados por DNI de CLIENTE
            $query = "SELECT CLIENTE.* FROM CLIENTE LEFT JOIN COMPRA ON (CLIENTE.DNI=COMPRA.CLIENTE) WHERE COMPRA.CLIENTE IS NULL ORDER BY CLIENTE.DNI";


            break;
        case 'ListadoClientesConCompraDadaPoblacion':
            //Datos de Clientes que han realizado Compras de una población seleccionada ordenados por DNI de CLIENTE
            $query = "SELECT * FROM CLIENTE JOIN COMPRA ON(CLIENTE.DNI=COMPRA.CLIENTE) WHERE CLIENTE.POBLACION = ? ORDER BY CLIENTE.DNI ";
            $parametros = [$_POST["poblacion"]];
            break;
        case 'ListadoClientesSinCompraDadaPoblacion':
            //Datos de Clientes que no han realizado Compras de una población seleccionada ordenados por DNI de CLIENTE
            $query = "SELECT CLIENTE.* FROM CLIENTE left JOIN COMPRA ON(CLIENTE.DNI=COMPRA.CLIENTE) WHERE COMPRA.CLIENTE is null AND POBLACION=? ORDER BY CLIENTE.DNI";
            $parametros = [$_POST["poblacion"]];
            break;
        case 'ListadoClientesConComprasValencia':
            //Datos de Clientes que han realizado Compras con algún CLIENTE de la población de Valencia ordenados por DNI de CLIENTE
            $query = "SELECT CLIENTE.* FROM CLIENTE inner JOIN COMPRA ON(CLIENTE.DNI=COMPRA.CLIENTE) WHERE POBLACION='Valencia' ORDER BY CLIENTE.DNI";
            break;

        case 'ListadoClientesConTresOMasCompras':
            //Listado de Clientes que han realizado 3 o más Compras ordenados por DNI de CLIENTE
            $query = "SELECT CLIENTE.*, count(COMPRA.CLIENTE) as Cantidad FROM CLIENTE inner JOIN COMPRA ON(CLIENTE.DNI=COMPRA.CLIENTE) group by COMPRA.CLIENTE having count(COMPRA.CLIENTE)>3 order by CLIENTE.DNI";
            break;
        case 'ListadoClientesConTresComprasOMasPorPoblacion':
            //Listado de Clientes que han realizado 3 Compras o más de una población seleccionada ordenados por DNI de CLIENTE
            $query = "SELECT cl.*, count(co.CLIENTE) as Cantidad FROM CLIENTE cl inner JOIN COMPRA co ON(cl.DNI=co.CLIENTE) where cl.POBLACION =? group by co.CLIENTE having count(co.CLIENTE)>3 order by cl.DNI ";
            $parametros = [$_POST["poblacion"]];
            break;

        //Consultas con Proveedores
        case 'ProveedorPorNif':
            //Datos de PROVEEDOR por NIF
            $query = "select * from PROVEEDOR where NIF=?";
            $parametros = [$_POST["proveedor"]];
            break;

        case 'ListadoProveedores':
            //Listado de todos los Proveedores ordenados por NIF de PROVEEDOR
            $query = "select * from PROVEEDOR order by NIF";

            break;

        case 'ProveedoresEmpiezanPorTexto':
            //Datos de Proveedores que empiezan por un texto seleccionado ordenados por NIF de PROVEEDOR
            $query = 'select * from PROVEEDOR where NOMBRE like ? order by NIF';
            $parametros = ["%" . $_POST["parametro"] . "%"];
            break;

        case 'ProveedoresProductosPvpMayor1000':
            //Datos de Proveedores con Productos con precio mayor a 1000€ ordenados por NIF de PROVEEDOR
            $query = "select * from PROVEEDOR pr join PRODUCTO pto on (pr.NIF=pto.PROVEEDOR) where pto.PVP >1000 order by NIF";

            break;

        //Consultas con Productos
        case 'ProductoPorCodProd':
            //Datos de PRODUCTO por COD_PROD
            $query = "select * from PRODUCTO where COD_PROD=?";
            $parametros = [$_POST["producto"]];
            break;

        case 'ListadoProductos':
            //Listado de todos los Productos ordenados por codigo de PRODUCTO
            $query = "select * from PRODUCTO order by COD_PROD";
            $parametros = [$_POST["producto"]];
            break;

        case 'ProductosPvpMenorOIgual100':
            //Datos de Productos con precio menor a 100 ordenados por codigo de PRODUCTO
            $query = "select * from PRODUCTO WHERE PVP< 100 order by COD_PROD";

            break;

        case 'ProductosPvpMayorPromedio':
            //Productos con precio mayor al promedio ordenados por codigo de PRODUCTO
            $query = "select * from PRODUCTO WHERE PVP > (select AVG(PVP) from PRODUCTO) ORDER by COD_PROD";

            break;

        case 'PvpMaximoProductos':
            //PVP máximo de los Productos
            $query = "select max(PVP) from PRODUCTO";

            break;

        case 'PvpMinimoProductos':
            //PVP mínimo de los Productos
            $query = "select MIN(PVP) from PRODUCTO";

            break;

        case 'PvpPromedioProductos':
            //PVP promedio de los Productos
            $query = "select avg(PVP) as promedio from PRODUCTO;";

            break;

        case "ProductosNombreContieneTexto":
            //Productos cuyo NOMBRE contiene un texto dado ordenados por codigo de PRODUCTO
            $query = "select * from PRODUCTO where NOMBRE like ? order by COD_PROD";
            $parametros = ["%" . $_POST["parametro"] . "%"];
            break;

        //consultas con Compras
        case 'ListadoCompras':
            //Listado de todas las Compras mostrando NOMBRE y APELLIDOS de CLIENTE, código y NOMBRE de PRODUCTO, NOMBRE de PROVEEDOR, FECHA y unidades ordenados por DNI de CLIENTE y código de PRODUCTO
            $query = "select cl.DNI,cl.NOMBRE, cl.APELLIDOS, pto.COD_PROD, pto.NOMBRE as Produto , pr.NOMBRE as 'NOMBRE PROVEEDOR', co.FECHA, co.UDES from COMPRA co inner join CLIENTE cl on (co.CLIENTE= cl.DNI) inner join PRODUCTO pto on (co.PRODUCTO =pto.COD_PROD) inner join PROVEEDOR pr on(pto.PROVEEDOR = pr.NIF) order by cl.DNI and pto.COD_PROD";

            break;

        case 'ComprasDeAnyo':
            //Datos de Compras a partir de un año dado ordenados por FECHA
            $query = "select * from COMPRA where FECHA < date_sub(CURRENT_DATE(), interval 1 year ) order by FECHA "; //COMPRA con mas de 1 año de antigüedad
            $query = "select * from COMPRA where FECHA between date_sub(CURRENT_DATE(), interval 1 year ) and current_date() order by FECHA"; //Compras a partir de un año en adelante

            break;

        case 'ComprasDeCliente':
            //Datos de Compras de un CLIENTE dado ordenados por DNI de CLIENTE
            $query = "select cl.NOMBRE, cl.APELLIDOS, co.* from COMPRA co join CLIENTE cl ON(co.CLIENTE= cl.DNI) where co.CLIENTE = ? ";
            $parametros = [$_POST["dni"]];
            break;

        case 'ComprasDeProducto':
            //Datos de Compras de un PRODUCTO dado ordenados por código de PRODUCTO
            $query = "select cl.NOMBRE, cl.APELLIDOS, pto.NOMBRE as Producto, pto.PVP, co.UDES, co.FECHA from COMPRA co JOIN CLIENTE cl on(cl.DNI=co.CLIENTE)JOIN PRODUCTO pto on(co.PRODUCTO=pto.COD_PROD) where PRODUCTO =?";
            $parametros = [$_POST["producto"]];
            break;

        case 'ComprasDeProveedor':
            //Datos de Compras de un PROVEEDOR dado ordenados por NIF de PROVEEDOR 
            // si damos el PROVEEDOR, el NIF sera el mismo siempre, pierde sentido ordenarlo por NIF de PROVEEDOR. lo ordene por NIF de CLIENTE
            // $query = "select co.*, pr.NOMBRE as PROVEEDOR from COMPRA co join PRODUCTO pto on (pto.COD_PROD= co.PRODUCTO) join PROVEEDOR pr on(pr.NIF=pto.PROVEEDOR) where pr.NOMBRE= 'APP INFORMÁTICA'order by co.CLIENTE";
            $query = "select co.*, pto.NOMBRE as 'Nombre Producto', pto.PVP, pr.NOMBRE as PROVEEDOR from COMPRA co join PRODUCTO pto on (pto.COD_PROD= co.PRODUCTO) join PROVEEDOR pr on(pr.NIF=pto.PROVEEDOR) where pr.NOMBRE= 'APP INFORMÁTICA'order by co.CLIENTE";
            break;

        case 'ComprasDePoblacion':
            //Datos de Compras de una población dada ordenados por población
            $query = "select co.*, cl.POBLACION from COMPRA co join CLIENTE cl on(cl.DNI= co.CLIENTE) where cl.POBLACION=? order by cl.POBLACION";
            $parametros = [$_POST["poblacion"]];
            break;

        case 'ComprasDeClientesValencia':
            //Datos de Compras con algún CLIENTE de la población de Valencia ordenados por DNI de CLIENTE   
            $query = "select co.*, cl.POBLACION from COMPRA co join CLIENTE cl on(cl.DNI= co.CLIENTE) where cl.POBLACION='Valencia' order by cl.DNI";

            break;

        case 'ComprasConIgualOMasDe2Unidades':
            //Datos de Compras con igual o más de 2 unidades ordenados por DNI de CLIENTE
            $query = "select * from COMPRA where UDES>=2 order by CLIENTE";

            break;

        case 'ComprasConMasDe3Productos':
            //Datos de Compras con más de 3 Productos ordenados por DNI de CLIENTE
            $query = "select * from COMPRA where UDES>2 order by CLIENTE";

            break;

        case 'ComprasMinimo10Unidades':
            //Datos de Compras con un mínimo de 10 unidades ordenados por DNI de CLIENTE
            $query = "select * from COMPRA where UDES>9 order by CLIENTE";

            break;

        default:
            break;
    }

    // Ejecuta la consulta si está definida
    if (isset($query)) {
        //ejecutamos la consulta con los parámetros (si los hay) y obtenemos un vector asociativo
        $db =  new Database();
        $pdo = $db->conectar();
        echo $query; // pongo la query de respaldo para saber que estoy consultando
        $result = $pdo->prepare($query);
        $result->execute($parametros);
        $salida = $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cierra la conexión (iguala a null)
    $pdo = null;

    // Devuelve los resultados como JSON si hay resultados
    if ($salida != null) {
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($salida, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        echo "<p style='color:red'>No se ha encontrado ese dato en la bbdd</p>"; //Salida de error en rojo 
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <title>Ejercicios Consulta</title>
</head>

<body>
    <h1>Consultas de la BD Empresa</h1>
    <form action="consultas.php" method="post">
        <label for="tipoConsulta">Tipo de consulta:</label>
        <select name="tipoConsulta" id="tipoConsulta">
            <option value="ClientePorDni">Cliente dado DNI</option>
            <option value="ListadoClientes">Listado Clientes</option>
            <option value="ClientesDadaPoblacion">Clientes de una población</option>
            <option value="ListadoClientesPorPoblacion">Listado de Clientes por población</option>
            <option value="NumeroClientesPorPoblacion">Número de Clientes por población</option>
            <option value="ListadoClientesConCompras">Clientes con Compras</option>
            <option value="ListadoClientesSinCompras">Clientes sin Compras</option>
            <option value="ListadoClientesConCompraDadaPoblacion">Clientes con Compras de una población</option>
            <option value="ListadoClientesSinCompraDadaPoblacion">Clientes sin Compras de una población</option>
            <option value="ListadoClientesConComprasValencia">Clientes con Compras de Valencia</option>
            <option value="ListadoClientesConTresOMasCompras">Clientes con 3 Compras o más</option>
            <option value="ListadoClientesConTresComprasOMasPorPoblacion">Clientes con 3 Compras o más de una población
            </option>
            <option value="ProveedorPorNif">PROVEEDOR dado NIF</option>
            <option value="ListadoProveedores">Listado de Proveedores</option>
            <option value="ProveedoresEmpiezanPorTexto">Proveedores que empiezan por un texto</option>
            <option value="ProveedoresProductosPvpMayor1000">Proveedores con Productos con precio mayor a 1000€</option>
            <option value="ProductoPorCodProd">Producto dado codigo</option>
            <option value="ListadoProductos">Listado de Productos</option>
            <option value="ProductosPvpMenorOIgual100">Productos con precio menor a 100</option>
            <option value="ProductosPvpMayorPromedio">Productos con precio mayor al promedio</option>
            <option value="PvpMaximoProductos">Pvp máximo de los Productos</option>
            <option value="PvpMinimoProductos">Pvp mínimo de los Productos</option>
            <option value="PvpPromedioProductos">Pvp promedio de los Productos</option>
            <option value="ProductosNombreContieneTexto">Productos cuyo Nombre contiene un texto</option>
            <option value="ListadoCompras">Listado de Compras</option>
            <option value="ComprasDeAnyo">Compras a partir de un año dado</option>
            <option value="ComprasDeCliente">Compras de un Cliente dado</option>
            <option value="ComprasDeProducto">Compras de un Producto dado</option>
            <option value="ComprasDeProveedor">Compras de un Proveedor dado</option>
            <option value="ComprasDePoblacion">Compras de una población dada</option>
            <option value="ComprasDeClientesValencia">Compras con algún Cliente de la población de Valencia</option>
            <option value="ComprasConIgualOMasDe2Unidades">Compras con 2 unidades o más</option>
            <option value="ComprasConMasDe3Productos">Compras con más de 3 Productos</option>
            <option value="ComprasMinimo10Unidades">Compras con un mínimo de 10 unidades</option>
        </select>
        </select><br>
        <label for="dni">dni:</label>
        <select name="dni" id="dni">

            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            $db =  new Database(); 
            $pdo = $db->conectar();
            // Obtiene los DNIs de la base de datos
            $query = "select * from CLIENTE";
            // Recorre y muestra los DNIs en el select simple como opciones
            $result = $pdo->prepare($query);
            $result->execute();
            $clientes = $result->fetchAll();
            $i = 1;
            foreach ($clientes as $c => $valor) {
                $dni = $valor["DNI"];
                echo "<option value='$dni'>" . $dni . '</option>';
            }
            ?>
        </select><br>
        <label for="poblacion">población:</label>
        <select name="poblacion" id="poblacion">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            $query = "select distinct(POBLACION) from cliente";
            $result = $pdo->prepare($query);
            $result->execute();
            $poblaciones = $result->fetchAll();
            // Obtiene los DNIs de la base de datos
            foreach ($poblaciones as $c => $valor) {
                $poblacion = $valor["POBLACION"];
                echo "<option value='$poblacion'>" . $poblacion . '</option>';
            }

            // Recorre y muestra POBLACIONes en el select simple como opciones

            ?>
        </select><br>
        <label for="proveedor">proveedor:</label>
        <select name="proveedor" id="proveedor">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)


            // Obtiene los Proveedores de la base de datos
            $query = "select * from PROVEEDOR";
            // Recorre y muestra los DNIs en el select simple como opciones
            $result = $pdo->prepare($query);// reutilizo la conexion ya creada
            $result->execute();
            $proveedor = $result->fetchAll();
            // Recorre y muestra los dnProveedores en el select simple como opciones
            foreach ($proveedor as $p => $valor) {
                $nombre = $valor["NOMBRE"];
                $nif = $valor["NIF"];
                echo "<option value='$nif'>" . $nombre . '</option>';
            }
            ?>
        </select> <br>
        <label for="producto">Producto:</label>
        <select name="producto" id="producto">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)

            $query = "select * from PRODUCTO ";
            // $query = "select * from PRODUCTO where";


            // Obtiene los Productos de la base de datos
            $result = $pdo->prepare($query);// reutilizo la conexion ya creada
            $result->execute();
            $producto = $result->fetchAll();
            // Recorre y muestra los Productos en el select simple como opciones
            foreach ($producto as $p => $valor) {
                $nombre = $valor["NOMBRE"];
                $cod_prod = $valor["COD_PROD"];
                echo "<option value='$cod_prod'>" . $nombre . '</option>';
            }
            ?>
        </select><br>
        <label for="parametro">Parámetro de consulta:</label>
        <input type="text" name="parametro" id="parametro">
        <br>
        <input type="submit" value="Consultar">

</body>

</html>