<?php

/**
 * @author Guillermina Fara 
 */

require_once "BDConfig.php";
class Incidencia
{

    public $numPuesto;
    public $problema;
    public static $contador = 0;
    public $codigo = 0;
    public $estado;
    public static $pendientes = 0;

    function __construct($numPuesto, $problema)
    {
        if (is_int($numPuesto)) {
            $this->numPuesto = $numPuesto;
        }
        if (is_string($problema)) {
            $this->problema = $problema;
        }
        self::$contador++;
        $this->codigo = self::$contador;
        $this->estado = "pendiente";
        self::$pendientes++;
    }

    private static function obtenerConexion()
    {
        global $options;
        try {
            return new PDO("mysql:host=" . HOST . "dbname=" . DBNAME, USERNAME, PASSWORD, $options);
        } catch (PDOException $e) {
            die("ERROR al conectar con la BD" . $e->getMessage());
        }
    }
    //eliminamos toda la base de datos 
    public static function resetearBD()
    {
        $pdo = self::obtenerConexion();
        $sql = "DELETE FROM INCIDENCIA";
        $pdo->exec($sql);
    }
    static function creaIncidencia($numPuesto, $problema)
    {
        $incidencia = new Incidencia($numPuesto, $problema);
        $pdo = self::obtenerConexion();
        $result = $pdo->prepare("INSERT INTO INCIDENCIAS(CODIGO,ESTADO, PUESTO, PROBLEMA) VALUES(?,?,?,?,? )");
        $exito = $result->execute([$incidencia->codigo, $incidencia->estado, $incidencia->numPuesto, $incidencia->problema,null]);

        if ($exito === true) {
            $valor = 0;
            echo "Incidencia creada con exito";
            leeIncidencia($valor);
        } else {
            echo "Error al crear la Incidencia ";
        }

        return $incidencia;

    }
    static function getPendientes()
    {
        return self::$pendientes;
    }
    function resuelve($solucion)
    {
        $this->estado = "resuelta";
        self::$pendientes--;
    }
    function getCodigo()
    {
        return self::$pendientes;
    }

    function __toString()
    {
        return "Incidencia " . (string) $this->codigo . " -Puesto:" . (string) $this->numPuesto . " - $this->problema" . "<br>";
    }
}
