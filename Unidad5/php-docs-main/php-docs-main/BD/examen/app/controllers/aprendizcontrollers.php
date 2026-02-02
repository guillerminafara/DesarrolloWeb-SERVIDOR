<?php
/*
humano:
aqui se encarga de validar todos los datos
y manejas la subida de la imagen
y dejarlo todo atado
aprendiz ejerce como rol
dependiendo del rol/aprendiz
se ejecutara el select con un objetivo diferente
use aprendices;
select * from 'rol';
y con los datos devueltos por la consulta
creas el objeto aprendiz
para serializar los datos y mandarlos por la sesion
para que se muestren en resultado.php

roboto:
index.php

Muestra el formulario (form.php).

Envía los datos al controlador.

aprendizController

Recibe los datos del formulario.

Llama a validaciones.php.

validaciones.php

Valida los datos (campos, formatos, obligatorios).

Maneja la subida de la imagen.

Si algo falla → vuelve atrás.

Si todo está bien → continúa.

Rol / aprendiz

El rol (aprendiz) determina qué consulta se ejecuta.

Ejemplo conceptual:

SELECT * FROM aprendices WHERE rol = ?


Con los datos devueltos:

Se crea el objeto Aprendiz.

Sesión

El objeto Aprendiz se serializa.

Se guarda en $_SESSION.

resultado.php lo recupera y lo muestra.

*/