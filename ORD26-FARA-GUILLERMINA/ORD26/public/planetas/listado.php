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
 * RA4.a – Se han identificado los mecanismos disponibles para el mantenimiento de la información que concierne a un cliente web concreto y se han señalado sus ventajas.
 * RA4.b – Se han utilizado mecanismos para mantener el estado de las aplicaciones web.
 * RA4.c – Se han utilizado mecanismos para almacenar información en el cliente web y para recuperar su contenido.
 * RA4.d – Se han identificado y caracterizado los mecanismos disponibles para la autentificación de usuarios.
 * RA4.e – Se han escrito aplicaciones que integren mecanismos de autentificación de usuarios.
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
 */


// TODO: Gestión de sesión
session_start();

// TODO: Cargar el controlador necesario para gestionar los planetas
require_once __DIR__."../../../app/controllers/PlanetaController.php";

// TODO: Recuperar el usuario almacenado en la sesión (si existe)
$usuario = $_SESSION["usuario"];

// TODO: Determinar si el usuario es invitado
$es_invitado = !isset($_SESSION["usuario"]);

// TODO: Crear una instancia del controlador para gestionar la lógica de negocio
$controller = new PlanetaController();


/**
 * El usuario elige MOSTRAR
 */
// TODO: Detectar si el usuario ha solicitado mostrar un planeta
    if (isset($_POST["mostrar"])) {
    $controller->mostrar($_POST["id"]);
}

/**
 * El usuario elige BORRAR
 */
// TODO: Detectar si el usuario ha solicitado borrar un planeta
if (isset($_POST["borrar"])) {
    $idBorrar= $_SESSION["planeta"]["id"];
    
    //Si hay un planeta mostrado, se borra ese planeta
    if (isset($idBorrar)) {
        $idBorrar =$_SESSION["planeta"]["id"];
    } else {
        // Si no, borrar el seleccionado en el select
        $idBorrar = $_POST["id"];
    }


    // TODO: Llamar al método del controlador para eliminar el planeta
    $controller->eliminar($idBorrar);


    // TODO: Limpiar los datos del planeta mostrado
    unset($_SESSION["planeta"]);


    // TODO: Redirigir de nuevo al listado
    header("Location: listado.php");
    exit;
}

/**
 * El usuario elige EDITAR
 */
// TODO: Detectar si el usuario ha solicitado editar un planeta
if (isset($_POST["editar"])) {
    header("Location: detalle.php");
    exit;
}

/**
 * El usuario elige NUEVO
 */
// TODO: Detectar si el usuario ha solicitado crear un nuevo planeta
if (isset($_POST["nuevo"])) {
    // TODO: Limpiar datos del planeta para mostrar formulario vacío
    unset($_SESSION["planeta"]); 
    header("Location: detalle.php");
    exit;
}

/**
 * El usuario elige VOLVER A INICIO
 */
// TODO: Detectar si el usuario ha solicitado volver al inicio
if (isset($_POST["inicio"])) {
    //cerrar sesión para volver a modo invitado
    // TODO: Eliminar usuario de la sesión
    unset($_SESSION["usuario"]);
    // TODO: Eliminar planeta de la sesión 
    unset($_SESSION["planetas"]); 
    // TODO: Redirigir al inicio de la aplicación
    header("Location: index.php");
    exit;
}

// TODO: Obtener los datos de planetas desde el controlador
$datos = controller->listar();
$planetas = $datos["planetas"];

// TODO: Comprobar si no hay planetas y realizar la importación
if (empty($planetas)) {
    $controller->cargarDatosDesdeSWAPI();
    // Volver a cargar los planetas después de importar
    $datos = $controller->listar();
    $planetas = $datos["planetas"];
}


?>

<html>

<head>
    <title>Listado de Planetas</title>
</head>

<body>

    <!-- Mostrar mensaje de bienvenida o acceso como invitado -->
    <h2>
        <?php if (): ?>
            <!-- TODO: Mostrar mensaje indicando acceso como invitado -->
            <p style="color: red;"></p>
        <?php else: ?>
            <!-- TODO: Mostrar el nombre del usuario autenticado -->
            <p style="color: green;">
                Bienvenido/a,
            </p>
        
        <?php endif; ?>
    </h2>

    <h2>Listado de Planetas</h2>

    <!-- TABLA DINÁMICA CON LISTADO DE PLANETAS -->
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Horas día</th>
            <th>Días año</th>
            <th>Clima</th>
            <th>Terreno</th>
            <th>Imagen</th>
        </tr>

        <?php foreach ($planetas as $planeta): ?>
            <tr>
                <!-- TODO: Mostrar el id del planeta -->
                <td><?php echo htmlspecialchars($planeta["id"])?></td>
                <!-- TODO: Mostrar el nombre del planeta -->
                <td><?php echo htmlspecialchars($planeta["nombre"])?></td>
                <!-- TODO: Mostrar horas del día -->
                <td><?php echo htmlspecialchars($planeta["horasDia"])?></td>
                <!-- TODO: Mostrar días del año -->
                <td><?php echo htmlspecialchars($planeta["diasAnyo"])?></td>
                <!-- TODO: Mostrar clima -->
                <td><?php echo htmlspecialchars($planeta["clima"])?></td>
                <!-- TODO: Mostrar terreno -->
                <td><?php echo htmlspecialchars($planeta["terreno"])?></td>
                <td>
                    <?php if (!empty($planeta["imagen"])): ?>
                        <!-- TODO: Mostrar la imagen del planeta -->
                        <img src="/public/uploads/<?php echo htmlspecialchars($planeta['imagen'])?>" width="60">
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <!-- SELECT + BOTONES SOLO PARA USUARIOS REGISTRADOS -->
    <form method="post" action="listado.php">
        <?php if (!$es_invitado): ?>
            <label>Selecciona un planeta:</label>
            <select name="id">
                <?php foreach ($planetas as $planeta): ?>
                    <option value="<?php echo $planeta['id']?>">
                        <!-- TODO: Mostrar el nombre del planeta dentro del select -->
                    <?php echo htmlspecialchars($planeta['id'])?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <?php if (isset($_SESSION["planeta"])): ?>
                <h3>Detalles del planeta</h3>
                
                <!-- TODO: Mostrar nombre -->
                <p><strong>Nombre:</strong><?php echo htmlspecialchars($_SESSION["planeta"]["nombre"])?> </p>
                <!-- TODO: Mostrar horas del día -->
                <p><strong>Horas día:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]["horasDia"])?></p>
                <!-- TODO: Mostrar días del año -->
                <p><strong>Días año:</strong><?php echo htmlspecialchars($_SESSION["planeta"]["diasAnyo"])?> </p>
                <!-- TODO: Mostrar clima -->
                <p><strong>Clima:</strong> <?php echo htmlspecialchars($_SESSION["planeta"]["clima"])?> </p>
                <!-- TODO: Mostrar terreno -->
                <p><strong>Terreno:</strong><?php echo htmlspecialchars($_SESSION["planeta"]["terreno"])?> </p>

                <!-- TODO: Mostrar imagen del planeta seleccionado -->
                <?php if (!empty($_SESSIOON["planeta"]["imagen"])): ?>
                    <img src="/public/uploads/<?php echo htmlspecialchars($_SESSION["planeta"]['imagen']);?>" width="120">
                <?php endif; ?>
            <?php endif; ?>

            <br><br>

            <button type="submit" name="mostrar">Mostrar</button>
            <button type="submit" name="editar">Editar</button>
            <button type="submit" name="borrar">Borrar</button>
            <button type="submit" name="nuevo">Nuevo planeta</button>
        <?php endif; ?>

        <br><br>
        <!-- Botón para volver a index.php -->
        <button type="submit" name="inicio">Volver al inicio</button>
    </form>

</body>

</html>