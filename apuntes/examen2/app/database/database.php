<?php
// Se encarga de hacer la conexión con la base de datos mediante PDO.
require_once __DIR__ . '/config.php';

class Database
{
	private static ?PDO $pdo = null;

	public static function getPDO(): PDO
	{
		if (self::$pdo instanceof PDO) {
			return self::$pdo;
		}

		global $host, $db, $user, $pass, $charset;

		$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];

		self::$pdo = new PDO($dsn, $user, $pass, $options);
		return self::$pdo;
	}
}