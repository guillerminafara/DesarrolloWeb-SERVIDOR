<?php

/*
    TODO: Iniciar sesión
*/

/*
    TODO: Incluir validaciones.php
*/

/*
    TODO: Leer el archivo users.json y decodificarlo.
    TODO: Extraer solo los nombres autorizados con array_column().
    TODO: Guardar la lista de usuarios autorizados en $_SESSION['listaUsuarios'].
*/

/*
    Array para almacenar errores (lo usarán ellos)
*/
$errores = [];

/*
    TODO: Recoger el nombre enviado por POST (si existe)
*/
$nombre = 

/*
    TODO: Comprobar si la petición es POST
*/
if (/* TODO: condición POST */) {

    /* ============================
       BOTÓN VALIDAR
       ============================ */
    if (/* TODO: comprobar si se pulsó VALIDAR */) {

        /*
            TODO: Validar el nombre usando:
                - validaRequerido()
                - validaAlfabeto()
            TODO: Si es válido, guardar el nombre en sesión.
            TODO: Si NO es válido, añadir mensajes al array $errores.
        */
    }

    /* ============================
       BOTÓN ACCEDER
       ============================ */
    if (/* TODO: comprobar si se pulsó ACCEDER */) {

        /*
            TODO: Recuperar el nombre guardado en sesión.
            TODO: Comprobar si está en la lista de usuarios autorizados.
            TODO: Si está autorizado:
                    - Guardar auth = true
                    - Redirigir a index.php
            TODO: Si NO está autorizado:
                    - Destruir la sesión
                    - Vaciar $nombre
                    - Añadir error "Usuario no autorizado"
        */
    }
}
?>
<!-- 
    TODO: Indica TU NOMBRE en el título
-->
<h1>Acceso a la API de Star Wars - NOMBRE</h1>

<!-- 
    TODO: Mostrar errores en lista roja recorriendo el array $errores
-->

<form action="login.php" method="POST">

    <label>Nombre:</label>

    <!-- 
        TODO: Rellenar el campo con el nombre validado o recuperado de sesión
    -->
    <input type="text" name="nombre" value="">

    <br><br>

    <!-- 
        TODO: Mostrar botón VALIDAR si no se ha validado o hay errores
    -->

    <!-- 
        TODO: Mostrar botón ACCEDER si se ha validado correctamente
    -->

</form>
