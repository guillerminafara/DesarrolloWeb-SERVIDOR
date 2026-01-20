<?php
/**
 * @autor Silvia Vilar
 * Ejercicio 2 UP5. Consultas
 */
include_once __DIR__ . '\..\..\db.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
    

    // Determina el tipo de consulta
  

    switch () {
            //consultas de Clientes
        case 'ClientePorDni':
            //Datos de cliente por DNI
           
            break;

        case 'ListadoClientes':
            //Listado de todos los clientes ordenados por dni de cliente
            
            break;

        case 'ClientesDadapoblacion':
            //Datos de Clientes de una Población seleccionada ordenados por dni de cliente
            
            break;
        case 'ListadoClientesPorPoblacion':
            //Listado de Clientes de una población seleccionada ordenados por población
            
            break;

        case 'NumeroClientesPorPoblacion':
            //Listado de Clientes de una población seleccionada ordenados por población
            
            break;

        case 'ListadoClientesConCompras':
            //Datos de Clientes que han realizado compras ordenados por dni de cliente
            
            break;
        case 'ListadoClientesSinCompras':
            //Datos de Clientes que no han realizado compras ordenados por dni de cliente
           
            break;
        case 'ListadoClientesConComprasDadaPoblacion':
            //Datos de Clientes que han realizado compras de una población seleccionada ordenados por dni de cliente
            
            break;
        case 'ListadoClientesSinComprasDadaPoblacion':
            //Datos de Clientes que no han realizado compras de una población seleccionada ordenados por dni de cliente
            
            break;
        case 'ListadoClientesConComprasValencia':
            //Datos de Clientes que han realizado compras con algún cliente de la población de Valencia ordenados por dni de cliente
            
            break;

        case 'ListadoClientesConTresOMasCompras':
            //Listado de clientes que han realizado 3 o más compras ordenados por dni de cliente
           
            break;
        case 'ListadoClientesConTresComprasOMasPorPoblacion':
            //Listado de clientes que han realizado 3 compras o más de una población seleccionada ordenados por dni de cliente
           
            break;

            //Consultas con proveedores
        case 'ProveedorPorNif':
            //Datos de proveedor por NIF
           
            break;

        case 'ListadoProveedores':
            //Listado de todos los proveedores ordenados por nif de proveedor
            
            break;

        case 'ProveedoresEmpiezanPorTexto':
            //Datos de proveedores que empiezan por un texto seleccionado ordenados por nif de proveedor
           
            break;

        case 'ProveedoresProductosPvpMayor1000':
            //Datos de proveedores con productos con precio mayor a 1000€ ordenados por nif de proveedor
            
            break;

            //Consultas con productos
        case 'ProductoPorCodProd':
            //Datos de producto por COD_PROD
            
            break;

        case 'ListadoProductos':
            //Listado de todos los productos ordenados por codigo de producto
           
            break;

        case 'ProductosPvpMenorOIgual100':
            //Datos de productos con precio menor a 100 ordenados por codigo de producto
            
            break;

        case 'ProductosPVPMayorPromedio':
            //Productos con precio mayor al promedio ordenados por codigo de producto
            
            break;

        case 'PvpMaximoProductos':
            //PVP máximo de los productos
           
            break;

        case 'PvpMinimoProductos':
            //PVP mínimo de los productos
          
            break;

        case 'PvpPromedioProductos':
            //PVP promedio de los productos
           
            break;

        case "ProductosNombreContieneTexto":
            //Productos cuyo nombre contiene un texto dado ordenados por codigo de producto
           
            break;

        //consultas con compras
        case 'ListadoCompras':
            //Listado de todas las compras mostrando nombre y apellidos de cliente, código y nombre de producto, nombre de proveedor, fecha y unidades ordenados por dni de cliente y código de producto
            
            break;

        case 'ComprasDeAnyo':
            //Datos de compras a partir de un año dado ordenados por fecha
            
            break;

        case 'ComprasDeCliente':
            //Datos de compras de un cliente dado ordenados por dni de cliente
            
            break;

        case 'ComprasDeProducto':
            //Datos de compras de un producto dado ordenados por código de producto
            
            break;

        case 'ComprasDeProveedor':
            //Datos de compras de un proveedor dado ordenados por nif de proveedor
           
            break;

        case 'ComprasDePoblacion':
            //Datos de compras de una población dada ordenados por población
            
            break;

        case 'ComprasDeClientesValencia':
            //Datos de compras con algún cliente de la población de Valencia ordenados por dni de cliente   
           
            break;

        case 'ComprasConIgualOMasDe2Unidades':
            //Datos de compras con igual o más de 2 unidades ordenados por dni de cliente
           
            break;

        case 'ComprasConMasDe3productos':
            //Datos de compras con más de 3 productos ordenados por dni de cliente
          
            break;

        case 'ComprasMinimo10Unidades':
            //Datos de compras con un mínimo de 10 unidades ordenados por dni de cliente
            
            break;

        default:
            break;
    }

    // Ejecuta la consulta si está definida
    if (isset($consulta)) {
        //ejecutamos la consulta con los parámetros (si los hay) y obtenemos un vector asociativo

    }

    // Cierra la conexión (iguala a null)
    

    // Devuelve los resultados como JSON si hay resultados
    
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
            <option value="ClientePorDni">Cliente dado dni</option>
            <option value="ListadoClientes">Listado clientes</option>
            <option value="ClientesDadapoblacion">Clientes de una población</option>
            <option value="ListadoClientesPorPoblacion">Listado de clientes por población</option>
            <option value="NumeroClientesPorPoblacion">Número de clientes por población</option>
            <option value="ListadoClientesConCompras">Clientes con compras</option>
            <option value="ListadoClientesSinCompras">Clientes sin compras</option>
            <option value="ListadoClientesConComprasDadaPoblacion">Clientes con compras de una población</option>
            <option value="ListadoClientesSinComprasDadaPoblacion">Clientes sin compras de una población</option>
            <option value="ListadoClientesConComprasValencia">Clientes con compras de Valencia</option>
            <option value="ListadoClientesConTresOMasCompras">Clientes con 3 compras o más</option>
            <option value="ListadoClientesConTresComprasOMasPorPoblacion">Clientes con 3 compras o más de una población</option>
            <option value="ProveedorPorNif">Proveedor dado NIF</option>
            <option value="ListadoProveedores">Listado de proveedores</option>
            <option value="ProveedoresEmpiezanPorTexto">Proveedores que empiezan por un texto</option>
            <option value="ProveedoresProductosPvpMayor1000">Proveedores con productos con precio mayor a 1000€</option>
            <option value="ProductoPorCodProd">Producto dado codigo</option>
            <option value="ListadoProductos">Listado de productos</option>
            <option value="ProductosPvpMenorOIgual100">Productos con precio menor a 100</option>
            <option value="ProductosPVPMayorPromedio">Productos con precio mayor al promedio</option>
            <option value="PvpMaximoProductos">PVP máximo de los productos</option>
            <option value="PvpMinimoProductos">PVP mínimo de los productos</option>
            <option value="PvpPromedioProductos">PVP promedio de los productos</option>
            <option value="ProductosNombreContieneTexto">Productos cuyo nombre contiene un texto</option>
            <option value="ListadoCompras">Listado de compras</option>
            <option value="ComprasDeAnyo">Compras a partir de un año dado</option>
            <option value="ComprasDeCliente">Compras de un cliente dado</option>
            <option value="ComprasDeProducto">Compras de un producto dado</option>
            <option value="ComprasDeProveedor">Compras de un proveedor dado</option>
            <option value="ComprasDePoblacion">Compras de una población dada</option>
            <option value="ComprasDeClientesValencia">Compras con algún cliente de la población de Valencia</option>
            <option value="ComprasConIgualOMasDe2Unidades">Compras con 2 unidades o más</option>
            <option value="ComprasConMasDe3productos">Compras con más de 3 productos</option>
            <option value="ComprasMinimo10Unidades">Compras con un mínimo de 10 unidades</option>
        </select>
        </select>
        <label for="dni">dni:</label>
        <select name="dni" id="dni">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            

            // Obtiene los dnis de la base de datos
            
            // Recorre y muestra los dnis en el select simple como opciones
            
            ?>
        </select>
        <label for="poblacion">población:</label>
        <select name="poblacion" id="poblacion">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            

            // Obtiene los dnis de la base de datos
           

            // Recorre y muestra poblaciones en el select simple como opciones
            
            ?>
        </select>
        <label for="proveedor">proveedor:</label>
        <select name="proveedor" id="proveedor">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            

            // Obtiene los proveedores de la base de datos
            
            // Recorre y muestra los dnproveedores en el select simple como opciones
           
            ?>
        </select>
        <label for="producto">producto:</label>
        <select name="producto" id="producto">
            <?php
            // Conecta a la base de datos (ajusta los detalles de la conexión según tu configuración)
            

            // Obtiene los productos de la base de datos
            
            // Recorre y muestra los productos en el select simple como opciones
            
            ?>
        </select>
        <label for="parametro">Parámetro de consulta:</label>
        <input type="text" name="parametro" id="parametro">
        <br>
        <input type="submit" value="Consultar">

</body>

</html>