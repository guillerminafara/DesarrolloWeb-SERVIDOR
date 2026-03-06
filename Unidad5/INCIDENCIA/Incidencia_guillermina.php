<?php

/**
 * @author Guillermina Fara 
 */

require_once __DIR__ . "/BDConfig.php";
class Incidencia
{

    public $numPuesto;
    public $problema;
    public static $contador = 0;
    public $codigo = 0;
    public $estado;
    public static $pendientes = 0;
    static public $pdo;
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
    //Función para crear una conexión 
    private static function obtenerConexion()
    {
        if (self::$pdo === null) {
            $db = new BDConfig();
            self::$pdo  =  $db->conectar();
        }
    }
    //Vaciamos la tabla incidencia de la base de datos 
    public static function resetearBD()
    {
        self::obtenerConexion();
        $sql = "DELETE FROM INCIDENCIA";
        $result = self::$pdo->prepare($sql);
        $result->execute();

        self::$contador = 0;
        self::$pendientes = 0;

        echo "Base de datos reiniciada correctamente\n";
    }
    //Método para crear incidencias  
    static function creaIncidencia($numPuesto, $problema)
    {
        $incidencia = new Incidencia($numPuesto, $problema);
        self::obtenerConexion();
        $result = self::$pdo->prepare("INSERT INTO INCIDENCIA(CODIGO,ESTADO, PUESTO, PROBLEMA) VALUES(?,?,?,? )");
        $exito = $result->execute([$incidencia->codigo, $incidencia->estado, $incidencia->numPuesto, $incidencia->problema]);

        if ($exito === true) {
            $valor = $incidencia->codigo;
            echo "Incidencia creada con exito con el código $valor \n";
            self::leeIncidencia($valor);
        } else {
            echo "Error al crear la Incidencia \n";
        }

        return $incidencia;
    }
    //función que lee todas las incidencias de la base de datos
    static function leeTodasIncidencias()
    {
        self::obtenerConexion();
        $SqlSelect = self::$pdo->prepare("SELECT * FROM INCIDENCIA;");
        $SqlSelect->execute();
        $result = $SqlSelect->fetchAll();
        print "\n------------Leer todas las Incidencias: ---------\n";
        foreach ($result as $row) {
            print "Incidencia: " . $row["CODIGO"] . " - Estado: " . $row["ESTADO"] . " - Puesto: " . $row["PUESTO"] . " - Problema: " . $row["PROBLEMA"] . "\n";
        }
    }
    //Función que lee la incidencia con el código dado 
    static function leeIncidencia($codigo)
    {
        $result = self::$pdo->prepare("SELECT * FROM INCIDENCIA WHERE CODIGO=?");
        $result->execute(array($codigo));

        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            print "Incidencia: " . $row["CODIGO"] . " - Estado: " . $row["ESTADO"] . " - Puesto: " . $row["PUESTO"] . " - Problema: " . $row["PROBLEMA"] . "\n";
        }
    }
    //Método para actualizar la incidencia 
    function actualizaIncidencia($CODIGO, $problema, $PUESTO, $ESTADO)
    {
        self::obtenerConexion();
        // actualizamos el problema en el objeto tambien
        if ($problema != "") {
            $this->problema = $problema;
        }
        $result = self::$pdo->prepare("UPDATE INCIDENCIA SET PROBLEMA=? WHERE CODIGO=?");
        $result->execute([$this->problema, $this->codigo]);
        $rowsAffected = $result->rowCount();
        if ($rowsAffected > 0) {
            echo "Incidencia $this->codigo actualizada con éxito\n";
        } else {
            echo "La Incidencia no pudo ser actualizada\n";
        }
    }
    //funcion que borra una incidencia de la base de datos
    function borraIncidencia()
    {
        self::obtenerConexion();
        $result = self::$pdo->prepare("DELETE FROM INCIDENCIA WHERE CODIGO=?");
        $rowsAffecteed = $result->execute(array($this->codigo));
        if ($rowsAffecteed > 0) {
            echo "Incidencia $this->codigo borrada con exito\n";
        } else {
            echo "La Incidencia no pudo ser borrada \n";
        }

        self::leeTodasIncidencias();
    }
    //Método que recupera las incidencias pendientes
    static function getPendientes()
    {
        return self::$pendientes;
    }
    //Método que actualiza la incidencia cuando esta ha sido resuelta
    function resuelve($solucion)
    {
        self::obtenerConexion();
        $this->estado = "resuelta";
        self::$pendientes--;
        $sql = "UPDATE INCIDENCIA set ESTADO=?, PROBLEMA=? where CODIGO=?";
        $result = self::$pdo->prepare($sql);
        $result->execute([$this->estado, $solucion, $this->codigo]);
    }
    //Mñetodo para conseguir el código de la incidencia
    function getCodigo()
    {
        return $this->codigo;
    }

    function __toString()
    {
        return "Incidencia: " . (string) $this->codigo . " -Puesto:" . (string) $this->numPuesto . " - $this->problema\n";
    }
}
