<?php
require_once "Database.php";

class Incidencia {

    private static $db;
    private $codigo;
    private $estado;
    private $puesto;
    private $problema;
    private $resolucion;

    /* ================= CONEXIÓN ================= */

    private static function conectar() {
        if (!self::$db) {
            self::$db = (new Database())->getPDO();
        }
    }

    /* ================= MÉTODOS ESTÁTICOS ================= */

    public static function resetearBD() {
        self::conectar();
        self::$db->exec("DELETE FROM INCIDENCIA");
    }

    public static function creaIncidencia($codigo, $problema) {
        self::conectar();

        $sql = "INSERT INTO INCIDENCIA (CODIGO, ESTADO, PROBLEMA)
                VALUES (:codigo, 'Pendiente', :problema)";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            ":codigo" => $codigo,
            ":problema" => $problema
        ]);

        return new Incidencia($codigo);
    }

    public static function getPendientes() {
        self::conectar();
        $sql = "SELECT COUNT(*) FROM INCIDENCIA WHERE ESTADO='Pendiente'";
        return self::$db->query($sql)->fetchColumn();
    }

    public static function leeIncidencia($codigo) {
        self::conectar();
        $sql = "SELECT * FROM INCIDENCIA WHERE CODIGO = :codigo";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([":codigo" => $codigo]);
        $inc = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($inc) {
            echo new Incidencia($codigo);
        }
    }

    public static function leeTodasIncidencias() {
        self::conectar();
        $sql = "SELECT CODIGO FROM INCIDENCIA";
        $res = self::$db->query($sql);

        foreach ($res as $fila) {
            echo new Incidencia($fila["CODIGO"]);
        }
    }

    /* ================= CONSTRUCTOR ================= */

    public function __construct($codigo) {
        self::conectar();

        $sql = "SELECT * FROM INCIDENCIA WHERE CODIGO = :codigo";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([":codigo" => $codigo]);
        $inc = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->codigo = $inc["CODIGO"];
        $this->estado = $inc["ESTADO"];
        $this->puesto = $inc["PUESTO"];
        $this->problema = $inc["PROBLEMA"];
        $this->resolucion = $inc["RESOLUCION"];
    }

    /* ================= MÉTODOS DE INSTANCIA ================= */

    public function resuelve($resolucion) {
        $sql = "UPDATE INCIDENCIA
                SET ESTADO='Resuelta', RESOLUCION=:resolucion
                WHERE CODIGO=:codigo";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            ":resolucion" => $resolucion,
            ":codigo" => $this->codigo
        ]);
    }

    public function actualizaIncidencia($estado, $problema, $puesto, $resolucion) {
        $sql = "UPDATE INCIDENCIA SET
                ESTADO = IF(:estado='', ESTADO, :estado),
                PROBLEMA = IF(:problema='', PROBLEMA, :problema),
                PUESTO = IF(:puesto='', PUESTO, :puesto),
                RESOLUCION = IF(:resolucion='', RESOLUCION, :resolucion)
                WHERE CODIGO = :codigo";

        $stmt = self::$db->prepare($sql);
        $stmt->execute([
            ":estado" => $estado,
            ":problema" => $problema,
            ":puesto" => $puesto,
            ":resolucion" => $resolucion,
            ":codigo" => $this->codigo
        ]);
    }

    public function borraIncidencia() {
        $sql = "DELETE FROM INCIDENCIA WHERE CODIGO=:codigo";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([":codigo" => $this->codigo]);
    }

    public function getCodigo() {
        return $this->codigo;
    }

    /* ================= SALIDA ================= */

    public function __toString() {
        return "Incidencia {$this->codigo} - {$this->estado} - {$this->problema} - {$this->resolucion}<br>";
    }
}
