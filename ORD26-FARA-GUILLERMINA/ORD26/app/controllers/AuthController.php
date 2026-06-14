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
 * RA3.e – Se han utilizado formularios web para interactuar con el usuario.
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
 * RA5.e – Se han identificado y aplicado los parámetros relativos a la configuración de la aplicación web.
 * RA5.f – Se han escrito aplicaciones web con mantenimiento de estado y separación de la lógica de negocio.
 * RA5.h – Se ha probado y documentado el código.
 *
 * RA6.a – Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos.
 * RA6.c – Se ha recuperado información almacenada en bases de datos o repositorios.
 * RA6.d – Se ha publicado en aplicaciones web la información recuperada.
 * RA6.e – Se han utilizado conjuntos de datos para almacenar la información.
 * RA6.g – Se han probado y documentado las aplicaciones web.
 *
 * RA8.a – Se han identificado las diferencias entre la ejecución de código en el servidor y en el cliente web.
 * RA8.b – Se han reconocido las ventajas de unir ambas tecnologías en el proceso de desarrollo de programas.
 * RA8.c – Se han identificado las tecnologías y frameworks relacionadas con la generación por parte del servidor de páginas web con guiones embebidos.
 * RA8.d – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan interacción con el usuario.
 * RA8.e – Se han utilizado estas tecnologías y frameworks para verificar formularios web.
 * RA8.f – Se han utilizado estas tecnologías y frameworks para generar modificación dinámica de su contenido y su estructura.
 * RA8.g – Se han aplicado estas tecnologías y frameworks en la programación de aplicaciones web.
 *
 * RA9.a – Se han reconocido las ventajas que proporciona la reutilización de código y el aprovechamiento de información ya existente.
 * RA9.b – Se han identificado tecnologías y frameworks aplicables en la creación de aplicaciones web híbridas.
 * RA9.c – Se ha creado una aplicación web que recupere y procese repositorios de información ya existentes.
 * RA9.f – Se han programado servicios y aplicaciones web utilizando como base información y código generados por terceros.
 * RA9.h – Se han probado, depurado y documentado las aplicaciones generadas.
 */


// TODO: Gestión de sesión
session_start();


// TODO: Comprobar si la petición NO proviene del formulario y redirigir al inicio
if ($_SERVER['REQUEST_METHOD']!== 'POST'){
    header("Location:index.php");
    exit;
}

// TODO: Validar el token recibido comparándolo con el almacenado en sesión
if (hash_equals($_POST['token'], $_SESSION['token']) === false) {
    // TODO: Guardar mensaje de error por token inválido
    $_SESSION['mensaje_token'] = "Error token invalido";
    // TODO: Redirigir al inicio de la aplicación
    header("Location: index.php");
    exit;
}


// TODO: Eliminar el token para que se genere uno nuevo en el siguiente acceso
unset($_SESSION['token']);

// TODO: Comprobar que se han enviado usuario y modo
if (empty($_POST["usuario"]|| empty($_POST['modo']))) {
    // TODO: Guardar mensaje de error por campos incompletos
    $_SESSION['mensaje_error'] = "Campos incompletos";
    // TODO: Redirigir al inicio
    header("Location: index.php");
    exit;
}


// TODO: Recuperar usuario del formulario
$usuario = $_POST["usuario"];
// TODO: Recuperar modo del formulario
$modo = $_POST["modo"];


// TODO: Detectar si el usuario ha seleccionado el modo API
if ($modo==='api') {
    // TODO: Guardar mensaje informativo para el modo API
    $_SESSION['mensaje_api'] = "Mensaje descriptivo(?";
    // TODO: Redirigir al inicio
    header("Location: index.php");
    exit;
}

// TODO: Cargar el archivo JSON con los usuarios permitidos
$fichero= file_get_contents(__DIR__."/../../config/users.json");
$json=json_decode($fichero);
$usuarios = $json;


// TODO: Recorrer la lista de usuarios para validar el acceso
foreach ($usuarios as $user) {
    // TODO: Comprobar si el usuario coincide con uno del JSON
    if ($user->name===$usuario) {
        // TODO: Guardar el usuario validado en la sesión
        $_SESSION['usuario']=$usuario;
        break;
    }
}

// TODO: Redirigir al listado independientemente de si tiene permisos
header("Location:");
exit;
