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
        $result = $pdo->prepare("INSERT INTO INCIDENCIAS(CODIGO,ESTADO, PUESTO, PROBLEMA) VALUES(?,?,?,? )");
        $exito = $result->execute([$incidencia->codigo, $incidencia->estado, $incidencia->numPuesto, $incidencia->problema]);

        if ($exito === true) {
            $valor = $incidencia->codigo;
            echo "Incidencia creada con exito";
            self::leeIncidencia($valor);
        } else {
            echo "Error al crear la Incidencia ";
        }

        return $incidencia;
    }
    static function leeTodasIncidencias()
    {
        $pdo = self::obtenerConexion();
        $SqlSelect = $pdo->prepare("SELECT * FROM INCIDENCIA;");
        $SqlSelect->execute();
        $result = $SqlSelect->fetchAll();
        print "<table border='1'>";
        foreach ($result as $row) {
            print "<tr><th>CODIGO</th><th>ESTADO</th><th>PUESTO</th><th>PROBLEMA</th></tr>";
            print "<tr><td>$row[CODIGO]</td><td>$row[ESTADO]</td><td>$row[PUESTO]</td><td>$row[PROBLEMA]</td></tr>";
        }
        print "</table>";
    }
    static function leeIncidencia($codigo)
    {
        $pdo = self::obtenerConexion();
        $result = $pdo->prepare("SELECT * FROM INCIDENCIA WHERE CODIGO=?");
        $result->execute(array($codigo));
        $rowsAffect = $result->fetchColumn();
        if ($rowsAffect) {
            print "Se han obtenido " . $rowsAffect . " filas." . "<br>";

            print "<table border=none>";
            print "<tr><th>CODIGO</th><th>ESTADO</th><th>PUESTO</th><th>PROBLEMA</th></tr>";
            foreach ($result as $row) {
                print "<tr><td>$row[CODIGO]</td><td>$row[ESTADO]</td><td>$row[PUESTO]</td><td>$row[PROBLEMA]</td></tr>";
            }
            print "</table>";
        }
    }

    function actualizaIncidencia($CODIGO, $PROBLEMA, $PUESTO, $ESTADO)
    {
        $pdo = self::obtenerConexion();
        $result = $pdo->prepare("UPDATE FROM INCIDENCIA SET PROBLEMA=? WHERE CODIGO=?");
        $result->execute(array($PROBLEMA, $this->codigo));
        $rowsAffected = $result->fetchColumn();
        if ($rowsAffected > 0) {
            echo "<p>Incidencia actualizada con exito</p>";
        } else {
            echo "<p>La Incidencia no pudo ser actualizada</p>";
        }
    }

    function borrarIncidencia()
    {
        $pdo = self::obtenerConexion();
        $result = $pdo->prepare("DELETE FROM INCIDENCIA WHERE CODIGO=?");
        $rowsAffecteed = $result->execute(array($this->codigo));
        if ($rowsAffecteed > 0) {
            echo "<p>Incidencia $this->codigo borrada con exito</p>";
        } else {
            echo "<p>La Incidencia no pudo ser borrada</p>";
        }

        self::leeTodasIncidencias();
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
