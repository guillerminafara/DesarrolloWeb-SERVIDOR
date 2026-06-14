<?php

/**
 * Criterios de evaluación cubiertos en este archivo:
 *
 * RA1.e – Se han identificado y caracterizado los principales lenguajes y tecnologías relacionados con la programación web en entorno servidor.
 * RA1.g – Se han reconocido y evaluado las herramientas y frameworks de programación en entorno servidor.
 *
 * RA2.b – Se han identificado las principales tecnologías asociadas.
 * RA2.d – Se ha reconocido la sintaxis del lenguaje de programación que se ha de utilizar.
 * RA2.e – Se han escrito sentencias simples y se han comprobado sus efectos en el documento resultante.
 * RA2.g – Se han utilizado los distintos tipos de variables y operadores disponibles en el lenguaje.
 * RA2.h – Se han identificado los ámbitos de utilización de las variables.
 *
 * RA3.c – Se han utilizado matrices (arrays) para almacenar y recuperar conjuntos de datos.
 * RA3.d – Se han creado y utilizado funciones.
 * RA3.g – Se han añadido comentarios al código.
 *
 * RA5.a – Se han identificado las ventajas de separar la lógica de negocio de los aspectos de presentación de la aplicación.
 * RA5.b – Se han analizado y utilizado mecanismos y frameworks que permiten realizar esta separación y sus características principales.
 * RA5.e – Se han identificado y aplicado los parámetros relativos a la configuración de la aplicación web.
 * RA5.g – Se han aplicado los principios y patrones de diseño de la programación orientada a objetos.
 *
 * RA6.a – Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos.
 * RA6.b – Se han creado aplicaciones que establezcan conexiones con bases de datos.
 * RA6.c – Se ha recuperado información almacenada en bases de datos.
 * RA6.e – Se han utilizado conjuntos de datos para almacenar la información.
 * RA6.f – Se han creado aplicaciones web que permitan la actualización y la eliminación de información disponible en una base de datos.
 *
 * RA9.a – Se han reconocido las ventajas que proporciona la reutilización de código y el aprovechamiento de información ya existente.
 * RA9.e – Se han utilizado librerías de código y frameworks para incorporar funcionalidades específicas a una aplicación web.
 */

// TODO: Cargar el archivo de configuración que inicializa la conexión PDO
require_once __DIR__ . "/../../config/database.php";


class Planeta
{

    /* ============================================================
       OBTENER TODOS LOS PLANETAS
       ============================================================ */
    public function getAll()
    {
        global $pdo;

        // TODO: Escribir la consulta SQL para obtener todos los planetas ordenados por nombre
        $sql = 'SELECT * FROM planetas OEDER BY name';

        // TODO: Preparar la consulta SQL
        $stmt = $pdo->prepare($sql);

        // TODO: Ejecutar la consulta
        $stmt->execute();


        // TODO: Devolver los resultados como array asociativo
        return $stmt->fetchAll(PDO::FETCH_ASSOC)();
    }

    /* ============================================================
       OBTENER UN PLANETA POR ID
       ============================================================ */
    public function getByID($id)
    {
        global $pdo;


        // TODO: Escribir la consulta SQL para obtener un planeta por su ID
        $sql = ('SELECT * FROM planetas where id=?');


        // TODO: Preparar la consulta SQL
        $stmt = $pdo->prepare($sql);


        // TODO: Ejecutar la consulta pasando parámetros
        $stmt->$pdo->execute(array($id));


        // TODO: Devolver un único registro como array asociativo
        return $stmt->fetch(PDO::FETCH_ASSOC)();
    }

    /* ============================================================
       CREAR NUEVO PLANETA
       ============================================================ */
    public function create($datos)
    {
        global $pdo;


        // TODO: Escribir la consulta SQL para insertar un nuevo planeta
        $sql = ('INSERT INTO planetas ("name",horasDia, diasany, clima, terreno, imagen ) values(?,?,?,?,?,?,?)');


        // TODO: Preparar la consulta SQL
        $stmt = $pdo->prepare($sql);


        // TODO: Ejecutar la consulta pasando parámetros
        return $stmt->execute(array($datos));
    }

    /* ============================================================
       ACTUALIZAR PLANETA
       ============================================================ */
    public function update($id, $datos)
    {
        global $pdo;


        // TODO: Escribir la consulta SQL para actualizar un planeta existente
        $sql = "UPDATE planetas SET(nombre=?, horasDia=?, diasAnyo=?, clima=?, terreno=?, imagen=?) WHERE id=? ";


        // TODO: Preparar la consulta SQL
        $stmt = $pdo->prepare($sql);


        // TODO: Ejecutar la consulta pasando parámetros
        return $stmt->execute([$datos['nombre'], $datos['horasDia'], $datos['diasAnyo'],$datos['clima'],$datos['terreno'],$datos['imagen'], $id]);
    }

    /* ============================================================
       ELIMINAR PLANETA
       ============================================================ */
    public function delete($id)
    {
        global $pdo;


        // TODO: Escribir la consulta SQL para eliminar un planeta por su ID
        $sql = ('DELETE FROM planetas where id=?');


        // TODO: Preparar la consulta SQL
        $stmt = $pdo->prepare($sql);


        // TODO: Ejecutar la consulta pasando parámetros
        return $stmt->$pdo->execute(array($id));
    }
}
