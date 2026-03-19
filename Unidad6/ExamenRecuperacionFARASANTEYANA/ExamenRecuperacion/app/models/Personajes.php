<?php

/*
    TODO: Incluir el archivo database.php
*/

include_once __DIR__ . "/../database/Database.php";
/**
 * Clase para manejar operaciones relacionadas con los personajes de Star Wars.
 * Operaciones CRUD: Crear, Leer, Actualizar, Borrar en la tabla 'characters'.
 */

class Personajes
{
    public $nombre;
    /*
        TODO: Implementar método getAll()
        - Debe obtener todos los registros de la tabla 'characters'
        - Usar la conexión PDO
        - Ejecutar SELECT 
        - Devolver los resultados como array asociativo
    */
    public static $pdo;

    public static function conectar()
    {
        try {
            //code...
            self::$pdo = new Database();
            self::$pdo = self::$pdo->conectar();
        } catch (mysqli_sql_exception $e) {
            print $e;
        }
    }


    public static function getAll()
    {
        // TODO
        self::conectar();
        $sql = "select * from characters;";
        $resultado = self::$pdo->query($sql);
        $fila = $resultado->fetchAll();
        return $fila;
    }

    /*
        TODO: Implementar método getById($id)
        - Debe obtener un personaje por su ID
        - Usar consulta preparada con WHERE id 
        - Ejecutar y devolver un único registro
    */
    public static function getById($id)
    {
        // TODO
        self::conectar();
        $sql = "select * from characters where id=?;";
        $salida = self::$pdo->prepare($sql);
        $salida->execute(array($id));
        $fila = $salida->fetch();
        return $fila;
    }

    /*
        TODO: Implementar método create($data)
        - Insertar un nuevo personaje en la tabla
        - Campos: name, gender, height
        - Usar consulta preparada INSERT
        - Ejecutar con los valores recibidos en $data
        - Devolver el personaje recién creado usando getById()
    */
    public static function create($data)
    {
        // TODO
        self::conectar();
        $sql = "insert into characters(name, gender, height) values(?,?,?);";
        $salida = self::$pdo->prepare($sql);

        $paso = [];

        $paso[] = $data["name"];
        $paso[] = $data["gender"];
        $paso[] = $data["height"];
        $salida->execute($paso);
        $id = self::$pdo->lastInsertId();
        echo "ID: " . $id;
        echo json_encode(self::getById($id));
    }

    /*
        TODO: Implementar método update($id, $data)
        - Actualizar un personaje existente
        - Usar UPDATE 
        - Ejecutar con los valores de $data y el id
        - Devolver el personaje actualizado usando getById()
    */
    public static function update($id, $data)
    {
        // TODO
        self::conectar();
        $sql = "update characters set name=?, gender=?, height=? where id=?";


        $salida = self::$pdo->prepare($sql);
        $paso = [];

        $paso[] = $data["name"];
        $paso[] = $data["gender"];
        $paso[] = $data["height"];
        $paso[] = $id;
        $salida->execute($paso);
        if ($salida->rowCount() > 0) {
            echo json_encode(self::getById($id));
        } else {
            return null;
        }
    }

    /*
        TODO: Implementar método delete($id)
        - Borrar un personaje por su ID
        - Usar DELETE 
        - Ejecutar consulta preparada
        - Devolver true/false según éxito
    */
    public static function delete($id)
    {
        // TODO
        self::conectar();
        $sql = "delete from characters where id=?";
        $salida = self::$pdo->prepare($sql);
        return $salida->execute(array($id));
    }
}
