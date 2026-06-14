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

// ============================================================
// Activamos router segun la URI y el método HTTP
// ============================================================

// TODO: Obtener y preparar la URI actual para el router
$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// TODO: Obtener el método HTTP de la petición actual
$method = $_SERVER['REQUEST_METHOD'];

/**
 * Si la ruta empieza por '/planetas', se asume que es una petición a la API REST
 */

// TODO: Cargar el controlador de la API y procesar la petición
if (str_starts_with($uri[0], 'planetas')) {
    require_once __DIR__ . "/../app/controllers/PlanetaController.php";
    $controller = new ApiController();
    $controller->handleRequest();
    exit;
}

/**
 * Si llega un POST de login, AuthController procesa el login
 */

// TODO: Detectar si se ha enviado el formulario de login y cargar el controlador correspondiente
if (isset($_POST['login'])) {
    require_once __DIR__ . "/../app/controllers/AuthController.php";
    exit;
}

//TODO: Generar un nuevo token para el formulario en la sesión si se accede a la raíz con GET
$_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));


/**
 * Si la ruta es '/', se muestra el formulario de login
 */

//Recoger mensajes de la sesión (si los hay) para mostrarlos en el formulario
//Eliminarlos de la sesión para no mostrarlos de nuevo

// TODO: Recuperar mensaje_token de la sesión
$mensaje_token = isset($_SESSION["mensaje_token"]) ? $_SESSION["mensaje_token"] : false;
// TODO: Eliminar mensaje_token de la sesión
unset($_SESSION["mensaje_token"]);



// TODO: Recuperar mensaje_api de la sesión
$mensaje_api = isset($_SESSION["mensaje_api"]) ? $_SESSION["mensaje_token"] : false;
// TODO: Eliminar mensaje_api de la sesión
unset($_SESSION["mensaje_api"]);


// TODO: Recuperar mensaje_error de la sesión
$mensaje_error = isset($_SESSION["mensaje_error"]) ? $_SESSION["mensaje_error"] : false;
// TODO: Eliminar mensaje_error de la sesión
unset($_SESSION["mensaje_error"]);


?>
<html>

<head>
    <title>Login - Planetas</title>
</head>

<body>
    <h1>Login</h1>

    <?php
    if (!empty($mensaje_token)): ?>
        <!-- TODO: Mostrar el contenido del mensaje correspondiente -->
        <h3>
            <p style="color: blue;"><?php echo htmlspecialchars($mensaje_token)?></p>
        </h3>
    <?php endif; ?>
    <?php
    if (!empty($mensaje_api)): ?>
        <!-- TODO: Mostrar el contenido del mensaje correspondiente -->
        <h2>
            <p style="color: green;"><?php echo htmlspecialchars($mensaje_api)?></p>
        </h2>
    <?php endif; ?>
    <?php
    if (!empty($mensaje_error)): ?>
        <!-- TODO: Mostrar el contenido del mensaje correspondiente -->
        <h3>
            <p style="color: red;"><?php echo htmlspecialchars($mensaje_error)?></p>
        </h3>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <!-- TODO: Insertar en este campo el token generado y almacenado en la sesión -->
        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

        Usuario: <input type="text" name="usuario">

        <label><input type="radio" name="modo" value="api"> API</label>
        <label><input type="radio" name="modo" value="crud"> CRUD</label>

        <input type="submit" name="login" value="Login">
    </form>
</body>

</html>