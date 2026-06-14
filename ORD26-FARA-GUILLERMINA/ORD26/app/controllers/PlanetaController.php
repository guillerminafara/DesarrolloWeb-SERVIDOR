<?php

/**
 * Criterios de evaluación cubiertos en este archivo:
 *
 * RA1.a – Se han caracterizado y diferenciado los modelos de ejecución de código en el servidor y en el cliente web.
 * RA1.b – Se han reconocido las ventajas que proporciona la generación dinámica de páginas.
 * RA1.c – Se han identificado los mecanismos de ejecución de código en los servidores web.
 * RA1.d – Se han reconocido las funcionalidades que aportan los servidores de aplicaciones y su integración con los servidores web.
 * RA1.e – Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.
 * RA1.f – Se han utilizado mecanismos para integrar código del servidor con el lenguaje de marcas a través de la selección y preparación de datos para las vistas.
 * RA1.g – Se han reconocido y evaluado las herramientas y frameworks de programación en entorno servidor.
 *
 * RA2.b – Se han identificado las principales tecnologías asociadas.
 * RA2.d – Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.
 * RA2.e – Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.
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
 * RA4.c – Se han utilizado mecanismos para almacenar información en el cliente web (cookie PHPSESSID generada automáticamente por PHP) y para recuperar su contenido mediante sesiones.
 * RA4.f – Se han utilizado herramientas y entornos para facilitar la programación, prueba y depuración del código.
 *
 * RA5.a – Se han identificado las ventajas de separar la lógica de negocio de los aspectos de presentación de la aplicación.
 * RA5.b – Se han analizado y utilizado mecanismos y frameworks que permiten realizar esta separación y sus características principales.
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
 * RA7.a – Se han reconocido las características propias y el ámbito de aplicación de los servicios web.
 * RA7.b – Se han reconocido las ventajas de utilizar servicios web para proporcionar acceso a funcionalidades incorporadas a la lógica de negocio de una aplicación.
 * RA7.c – Se han identificado las tecnologías y los protocolos implicados en el consumo de servicios web.
 * RA7.d – Se han utilizado los estándares y arquitecturas más difundidos e implicados en el desarrollo de servicios web.
 * RA7.f – Se ha verificado el funcionamiento del servicio web.
 * RA7.g – Se ha consumido el servicio web.
 * RA7.h – Se ha documentado un servicio web.
 *
 * RA8.a – Se han identificado las diferencias entre la ejecución de código en el servidor y en el cliente web.
 * RA8.b – Se han reconocido las ventajas de unir ambas tecnologías en el proceso de desarrollo de programas.
 * RA8.c – Se han identificado las tecnologías y frameworks relacionadas con la generación por parte del servidor de páginas web con guiones embebidos.
 * RA8.d – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan interacción con el usuario.
 * RA8.f – Se han utilizado estas tecnologías y frameworks para generar páginas web que incluyan modificación dinámica de su contenido y su estructura.
 * RA8.g – Se han aplicado estas tecnologías y frameworks en la programación de aplicaciones web.
 *
 * RA9.a – Se han reconocido las ventajas que proporciona la reutilización de código y el aprovechamiento de información ya existente.
 * RA9.b – Se han identificado tecnologías y frameworks aplicables en la creación de aplicaciones web híbridas.
 * RA9.c – Se ha creado una aplicación web que recupere y procese repositorios de información ya existentes.
 * RA9.d – Se han creado repositorios específicos a partir de información existente en almacenes de información.
 * RA9.e – Se han utilizado librerías de código y frameworks para incorporar funcionalidades específicas a una aplicación web.
 * RA9.f – Se han programado servicios y aplicaciones web utilizando como base información y código generados por terceros.
 * RA9.g – Se han analizado y utilizado librerías de código relacionadas con Big Data e inteligencia de negocios, para incorporar análisis e inteligencia de datos proveniente de repositorios.
 * RA9.h – Se han probado, depurado y documentado las aplicaciones generadas.
 */


// TODO: Cargar el modelo Planeta
require_once


// TODO: Cargar las funciones de validación
require_once

class PlanetaController
{
    /**TODO: Crear variable para almacenar errores del formulario */
     

    /* ============================================================
        LISTAR PLANETAS - CRUD
       ============================================================ */
    public function listar()
    {
        
        // TODO: Crear instancia del modelo
        $planeta = 

         // TODO: Obtener todos los planetas
        $planetas =

        
        // TODO: Devolver los datos en un array asociativo
        return 
    }

    /* ============================================================
        MOSTRAR PLANETA 
       ============================================================ */
    public function mostrar($id)
    {
        // CE RA6.c: Se ha recuperado información almacenada en bases de datos.
        // TODO: Crear instancia del modelo
        $planeta = 

         // TODO: Obtener los datos del planeta por ID
        $datosPlaneta = 
        
        // CE RA4.b: Mantenimiento del estado
        // TODO: Guardar los datos del planeta en la sesión
       

        // CE RA3.c: Uso de arrays
        return  
    }

    /* ============================================================
        CREAR PLANETA - CRUD
       ============================================================ */
    public function crear($datos)
    {
        
        // TODO: Validar los datos recibidos
        

        
        // TODO: Comprobar que la imagen es obligatoria en creación
        if () {
            
        }

         
        if () {
            // Si hay errores, los devolvemos para mostrarlos en el formulario
            return 
        }

        
        // TODO: Procesar la imagen subida
        $nombreImagen = 
        if () {
            // TODO: Asignar la imagen procesada a los datos del planeta
            
        }
        
        
        // TODO: Crear instancia del modelo
        $planeta =

        // TODO: Crear el planeta en la base de datos
        return 

    /* ============================================================
        FORMULARIO EDITAR/ACTUALIZAR PLANETA 
       ============================================================ */
    public function actualizar($id, $datos)
    {
        
        // TODO: Validar los datos recibidos
        

        if () {
            // TODO: Devolver errores para mostrarlos en el formulario
            return 
        }

        
        // TODO: Procesar la imagen si se ha subido
        $nombreImagen = 
        if () {
            // TODO: Asignar la imagen procesada a los datos del planeta
            
        }
        
        // TODO: Crear instancia del modelo
        $planeta =  

        // TODO: Actualizar el planeta en la base de datos
        return 
    }

    /* ============================================================
       ELIMINAR PLANETA
       ============================================================ */
    public function eliminar($id)
    {
       
        // TODO: Crear instancia del modelo
        $planeta = 

        // TODO: Eliminar el planeta indicado
        return 
    }

    /* ============================================================
       SUBIDA DE IMAGEN
       ============================================================ */
    private function procesarImagen($nombrePlaneta)
    {   
        
        // TODO: Validar que se ha subido una imagen sin errores
        if () {
            return 
        }

        
        // TODO: Obtener la extensión real del archivo subido (forzar a minusculas)
        $extension = 
        // TODO: Definir extensiones permitidas "jpg", "jpeg", "png", "gif"
        $extensiones =
        // TODO: Comprobar si la extensión es válida
        if () {
            // TODO: Registrar error por extensión no válida
            
            return 
        }
        
        // TODO: Generar nombre único para la imagen
        // Generar un nombre único con formato YYYYMMDD_NombrePlaneta.extensión
        $fecha = 
        $nombre = 
        // TODO: Construir la ruta de destino
        // Guardar la imagen en la carpeta uploads en public
        $destino = 
       
        // TODO: Mover la imagen subida a la carpeta correspondiente
        
        // TODO: Mover la imagen subida a la carpeta correspondiente 
        return ;
    }

    private function validarDatos($datos)
    {
        
        // Nombre requerido y solo letras
        if () {
            // TODO: Registrar error
            
        } elseif () {
            // El nombre puede tener espacios (tener en cuenta al validar)
             // TODO: Registrar error
        }

        // Horas del día: requerido y numérico
        if () {
             // TODO: Registrar error
        } elseif () {
             // TODO: Registrar error
            
        }

        // Días del año: requerido y numérico
        if () {
             // TODO: Registrar error
        } elseif () {
             // TODO: Registrar error
            
        }

        // Clima requerido (alfanumérico)
        if () {
            // TODO: Registrar error
        } elseif () {
            // El clima puede tener espacios y varios elementos separados por comas (tener en cuenta al validar)
            // TODO: Registrar error
        }

        // Terreno requerido (alfanumérico)
        if () {
            // TODO: Registrar error
        } elseif () {
            // El terreno puede tener espacios y comas, (tener en cuenta al validar)
            // TODO: Registrar error
        }
    }


    /**
     * ============================================================ 
     *  CARGAR DATOS DESDE SWAPI
     * ============================================================
     */

    public function cargarDatosDesdeSWAPI()
    {
        
        // TODO: Especificar la URL del archivo JSON
        // Obtener datos del ordenador del profesor
        $url = 
        
        
        // TODO: Obtener el contenido JSON
        $response = 
        
        // TODO: Convertir JSON en array asociativo
        $data = 
        
        
        // TODO: Devolver falso si no hay datos válidos
        if () {
            return 
        }

        
        // TODO: Crear instancia del modelo
        //Usamos el modelo para guardar los planetas en la BD
        //Cuidado con los campos numéricos que pueden venir como strings no numéricos, convertirlos para guardar en BD
        $planeta =
        
        
        // TODO: Recorrer los datos e insertarlos en la BD
        foreach () {
            // TODO: Crear planeta usando el modelo
            
        }
        // TODO: Devolver verdadero si se han cargado los datos correctamente
        return 
    }
}
