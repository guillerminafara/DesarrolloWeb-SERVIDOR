<?php

/**
 * Criterios de evaluación cubiertos en este archivo:
 *
 * RA1.a – Se han caracterizado y diferenciado los modelos de ejecución de código en el servidor y en el cliente web.
 * RA1.b – Se han reconocido las ventajas que proporciona la generación dinámica de páginas.
 * RA1.c – Se han identificado los mecanismos de ejecución de código en los servidores web.
 * RA1.d – Se han reconocido las funcionalidades que aportan los servidores de aplicaciones y su integración con los servidores web.
 * RA1.e – Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.
 * RA1.f – Se han verificado los mecanismos de integración de los lenguajes de marcas con los lenguajes de programación en entorno servidor.
 * RA1.g – Se han reconocido y evaluado las herramientas y frameworks de programación en entorno servidor.
 *
 * RA2.a – Se han reconocido los mecanismos de generación de páginas web a partir de lenguajes de marcas con código embebido.
 * RA2.b – Se han identificado las principales tecnologías asociadas.
 * RA2.c – Se han utilizado etiquetas para la inclusión de código en el lenguaje de marcas.
 * RA2.d – Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.
 * RA2.e – Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.
 * RA2.f – Se han utilizado directivas para modificar el comportamiento predeterminado.
 * RA2.g – Se han utilizado los distintos tipos de variables y operadores disponibles en el lenguaje.
 * RA2.h – Se han identificado los ámbitos de utilización de las variables.
 *
 * RA3.a – Se han utilizado mecanismos de decisión en la creación de bloques de sentencias.
 * RA3.b – Se han utilizado bucles y se ha verificado su funcionamiento.
 * RA3.c – Se han utilizado matrices (arrays) para almacenar y recuperar conjuntos de datos.
 * RA3.d – Se han creado y utilizado funciones.
 * RA3.e – Se han utilizado formularios web para interactuar con el usuario del navegador web.
 * RA3.f – Se han empleado métodos para recuperar la información introducida en el formulario.
 * RA3.g – Se han añadido comentarios al código.
 *
 * RA4.a – Se han identificado los mecanismos disponibles para el mantenimiento de la información que concierne a un cliente web concreto.
 * RA4.b – Se han utilizado mecanismos para mantener el estado de las aplicaciones web.
 * RA4.c – Se han almacenado datos en el cliente o en el servidor para mantener la información.
 * RA4.f – Se han utilizado herramientas y entornos para facilitar la programación, prueba y depuración del código.
 *
 * RA5.a – Se han identificado las ventajas de separar la lógica de negocio de los aspectos de presentación de la aplicación.
 * RA5.b – Se han analizado y utilizado mecanismos y frameworks que permiten realizar esta separación y sus características principales.
 * RA5.c – Se han utilizado objetos y controles en el servidor para generar el aspecto visual de la aplicación web en el cliente.
 * RA5.d – Se han utilizado formularios generados de forma dinámica para responder a los eventos de la aplicación web.
 * RA5.e – Se han identificado y aplicado los parámetros relativos a la configuración de la aplicación web.
 * RA5.f – Se han escrito aplicaciones web con mantenimiento de estado y separación de la lógica de negocio.
 * RA5.g – Se han aplicado los principios y patrones de diseño de la programación orientada a objetos.
 * RA5.h – Se ha probado y documentado el código.
 *
 * RA6.a – Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos.
 * RA6.b – Se han creado aplicaciones que establezcan conexiones con bases de datos.
 * RA6.c – Se ha recuperado información almacenada en bases de datos.
 * RA6.d – Se ha publicado en aplicaciones web la información recuperada.
 * RA6.e – Se han utilizado conjuntos de datos para almacenar la información.
 * RA6.f – Se han creado aplicaciones web que permitan la actualización y la eliminación de información disponible en una base de datos.
 * RA6.g – Se han probado y documentado las aplicaciones web.
 *
 * RA8.a – Se han identificado las diferencias entre la ejecución de código en el servidor y en el cliente web.
 * RA8.b – Se han reconocido las ventajas de unir ambas tecnologías en el proceso de desarrollo de programas.
 * RA8.c – Se han identificado las tecnologías y frameworks relacionadas con la generación por parte del servidor de páginas web con guiones embebidos.
 * RA8.d – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan interacción con el usuario.
 * RA8.e – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan verificación de formularios.
 * RA8.f – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan modificación dinámica de su contenido y su estructura.
 * RA8.g – Se han aplicado estas tecnologías y frameworks en la programación de aplicaciones web.
 * 
 * RA9.a – Se han reconocido las ventajas que proporciona la reutilización de código y el aprovechamiento de información ya existente.
 * RA9.b – Se han identificado tecnologías y frameworks aplicables en la creación de aplicaciones web híbridas.
 * RA9.c – Se ha creado una aplicación web que recupere y procese repositorios de información ya existentes.
 * RA9.d – Se han creado repositorios específicos a partir de información existente en almacenes de información.
 * RA9.e – Se han utilizado librerías de código y frameworks para incorporar funcionalidades específicas a una aplicación web.
 * RA9.f – Se han programado servicios y aplicaciones web utilizando como base información y código generados por terceros.
 * RA9.h – Se han probado, depurado y documentado las aplicaciones generadas.
 * 
 */


// TODO: Gestión de sesión
session_start();

// TODO: Cargar el controlador necesario para gestionar los planetas
require_once __DIR__."../../../app/controllers/PlanetaController.php";

// TODO: Crear una instancia del controlador para gestionar la lógica de negocio
$controller = new PlanetaController();
$errores=[];
$nombre= isset($_POST["nombre"])?$_POST["nombre"]:null;


// Si viene de listado.php con EDITAR
// TODO: Detectar si se ha solicitado editar un planeta
if (isset($_POST["editar"])) {
    // TODO: Cargar los datos del planeta seleccionado
    $planetas=$controller->mostrar($_POST["id"]);
    // TODO: Indicar que el modo es edición
    $modo="editar";
}

// Si viene de listado.php con NUEVO
elseif (isset($_POST['nuevo'])) {
    // TODO: Limpiar los datos del planeta para formulario vacío
    unset($_SESSION["planeta"]); 
    // TODO: Indicar que el modo es nuevo
    $modo = "nuevo";
}

// Si viene del propio formulario con GUARDAR
elseif (isset($_POST["guardar"])) {


    // TODO: Recuperar el id enviado en el formulario
    $id = $_POST["id"]??null;

    // TODO: Construir el array con los datos enviados por el formulario
    $datos = ["nombre"=>$_POST["nombre"]??'',
    "horasDia"=>$_POST["horasDia"]??'',
    "diasAnyo"=>$_POST["diasAnyo"]??'',
    "clima"=>$_POST["clima"]??'',
    "terreno"=>$_POST["terreno"]??'',
    ];
   
    if (!empty($id)) {
        // Si el ID existe, es una actualización
        $resultado = $controller->actualizar($id, $datos);
    } else {
        // Si no hay ID, es una creación
        $resultado = $controller->crear($datos);
    }

    // Si hay errores, los guardamos para mostrarlos en el formulario
    if (!empty($errores)) {
        // TODO: Guardar errores 
            $_SESSION["erorres"]=$errores;
        // TODO: Guardar los datos introducidos para no perderlos
            $_SESSION["datos"]=$datos;
        // TODO: Redirigir de nuevo al formulario
        header("Location: detalle.php");
        exit;
    }

    // TODO: Redirigir al listado si no hay errores
    header("Location:listado.php");
    exit;
}

// Si pulsa CANCELAR
elseif (isset($_POST["cancelar"])) {

    // TODO: Redirigir al listado
    header("Location: listado.php");
    exit;
}

// Datos para el formulario
// TODO: Recuperar los datos del planeta o crear array vacío
$datos =$_SESSION["planeta"]?? ($_SESSION["datos"]?? []) ;
unset($_SESSION["datos"]);
//Distinguir si es nuevo o editar para mostrar el título correcto en el formulario

// TODO: Determinar el modo según si existe id
$modo = !empty($datos['id']) ?'editar'  :'nuevo' ;

?>

<html>

<head>
    <title><?= ucfirst($modo) ?> planeta</title>
</head>

<body>

    <h2><?= ucfirst($modo) ?> planeta</h2>
    
    <!-- Mostrar errores de validación -->
    <?php if (isset($errores)): ?>
        <ul style="color:red;">
            <?php foreach ($errores as $e): ?>
                
                <!-- TODO: Mostrar cada error de validación -->
                <li><?php echo $e?></li>
            <?php endforeach; ?>
        </ul>
        
        <!-- TODO: Eliminar los errores de la sesión -->
        <?php unset($_SESSION["errores"]); ?>
    <?php endif; ?>
    
    <!-- TODO: Especificar el enctype adecuado -->
    <form method="post" action="detalle.php" enctype="multipart/form-data">
        
        <!-- TODO: Insertar el id del planeta en el campo hidden -->
       <input type="hidden" name="id" value="<?php echo $datos['id'] ?? ''; ?>">
        
        
        <!-- TODO: Insertar el valor del nombre -->
        Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($datos["nombre"]??'') ?>"><br><br>
        <!-- TODO: Insertar el valor de horasDia -->
        Horas día: <input type="text" name="horasDia" value="<?php echo htmlspecialchars($datos["horasDia"]??'') ?>"><br><br>
        <!-- TODO: Insertar el valor de diasAnyo -->
        Días año: <input type="text" name="diasAnyo" value="<?php echo htmlspecialchars($datos["diasAnyo"]??'') ?>"><br><br>
        <!-- TODO: Insertar el valor de clima -->
        Clima: <input type="text" name="clima" value="<?php echo htmlspecialchars($datos["clima"]??'') ?>"><br><br>
        <!-- TODO: Insertar el valor de terreno -->
        Terreno: <input type="text" name="terreno" value="<?php echo htmlspecialchars($datos["terreno"]??'') ?>"><br><br>
        <!-- TODO: Insertar el valor de imagen -->
        Imagen: <input type="file" name="imagen"><br><br>
        <?php if (!empty($errores)): ?>
            
            <!-- TODO: Mostrar la imagen actual del planeta -->
            <img src="/public/uploads/<?php echo htmlspecialchars($datos['imagen']); ?>" width="120"><br><br>
        <?php endif; ?>


        <button type="submit" name="guardar">Guardar</button>
        <button type="submit" name="cancelar">Cancelar</button>

    </form>

</body>

</html>