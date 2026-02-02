<?php

require_once __DIR__ . '/../database/database.php';

class Aprendiz{
	private ?int $id;

    private string $nombre;
    private string $apellido;

    private string $email;
    private ?int $edad;

    private string $rol;
	private ?string $descripcionRol;
    private ?string $varita;
    private ?string $patronus;
    private ?string $comentario;
    private ?string $rutaFoto;   
	private ?string $creadoEn;

    public function __construct(array $datosFormulario)	{
		$this->id             = isset($datosFormulario['id']) ? (int)$datosFormulario['id'] : null;
        $this->nombre         = $datosFormulario['nombre'] ?? '';
        $this->apellido       = $datosFormulario['apellido'] ?? '';
        $this->email          = $datosFormulario['email'] ?? '';
        $this->edad           = isset($datosFormulario['edad']) ? (int)$datosFormulario['edad'] : null;
        $this->rol            = $datosFormulario['rol'] ?? '';
        $this->descripcionRol = $datosFormulario['descripcion'] ?? null;
        $this->varita         = $datosFormulario['varita'] ?? null;
        $this->patronus       = $datosFormulario['patronus'] ?? null;
        $this->comentario     = $datosFormulario['comentario'] ?? null;
		$this->rutaFoto       = $datosFormulario['foto'] ?? null;
		$this->creadoEn       = $datosFormulario['creado_en'] ?? null;
    }

	private static function asegurarEsquema(PDO $pdo): void
	{
		$pdo->exec(
			"CREATE TABLE IF NOT EXISTS aprendiz (
				id INT AUTO_INCREMENT PRIMARY KEY,
				nombre VARCHAR(100) NOT NULL,
				apellido VARCHAR(100) NOT NULL,
				email VARCHAR(150) NOT NULL,
				edad INT NULL,
				rol VARCHAR(50) NULL,
				varita VARCHAR(150) NULL,
				patronus VARCHAR(150) NULL,
				comentario TEXT NULL,
				foto VARCHAR(255) NULL,
				creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
		);
	}

	public static function resetearBD(): void
	{
		$pdo = Database::getPDO();
		try {
			$pdo->exec('DROP TABLE IF EXISTS aprendiz');
		} catch (Throwable $e) {
			// no-op
		}
		self::asegurarEsquema($pdo);
	}

	public static function creaAprendiz(Aprendiz $aprendiz): ?Aprendiz
	{
		$pdo = Database::getPDO();
		self::asegurarEsquema($pdo);

		try {
			$sql = "INSERT INTO aprendiz 
				(nombre, apellido, email, edad, rol, varita, patronus, comentario, foto)
				VALUES
				(:nombre, :apellido, :email, :edad, :rol, :varita, :patronus, :comentario, :foto)";
			$stmt = $pdo->prepare($sql);
			$ok = $stmt->execute([
				':nombre' => $aprendiz->getNombre(),
				':apellido' => $aprendiz->getApellido(),
				':email' => $aprendiz->getEmail(),
				':edad' => $aprendiz->getEdad(),
				':rol' => $aprendiz->getRol(),
				':varita' => $aprendiz->getVarita(),
				':patronus' => $aprendiz->getPatronus(),
				':comentario' => $aprendiz->getComentario(),
				':foto' => $aprendiz->getRutaFoto(),
			]);

			if (!$ok) {
				return null;
			}

			$aprendiz->id = (int)$pdo->lastInsertId();
			return $aprendiz;
		} catch (Throwable $e) {
			return null;
		}
	}

	public static function leeAprendiz(int $id): ?Aprendiz
	{
		$pdo = Database::getPDO();
		self::asegurarEsquema($pdo);

		$stmt = $pdo->prepare('SELECT id, nombre, apellido, email, edad, rol, varita, patronus, comentario, foto, creado_en FROM aprendiz WHERE id = :id');
		$stmt->execute([':id' => $id]);
		$row = $stmt->fetch();
		if (!$row) {
			return null;
		}

		return self::desdeFila($row);
	}

	public static function leeTodos(): array
	{
		$pdo = Database::getPDO();
		self::asegurarEsquema($pdo);

		$stmt = $pdo->query('SELECT id, nombre, apellido, email, edad, rol, varita, patronus, comentario, foto, creado_en FROM aprendiz ORDER BY id');
		$rows = $stmt->fetchAll();
		if (!$rows) {
			return [];
		}

		$lista = [];
		foreach ($rows as $row) {
			$lista[] = self::desdeFila($row);
		}
		return $lista;
	}

	public static function total(): int
	{
		$pdo = Database::getPDO();
		self::asegurarEsquema($pdo);
		$stmt = $pdo->query('SELECT COUNT(*) AS total FROM aprendiz');
		$row = $stmt->fetch();
		return (int)($row['total'] ?? 0);
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getCreadoEn(): ?string
	{
		return $this->creadoEn;
	}

	public function actualizaAprendiz(array $datos): bool
	{
		if ($this->id === null) {
			return false;
		}

		$nuevoNombre = array_key_exists('nombre', $datos) && $datos['nombre'] !== '' ? (string)$datos['nombre'] : $this->nombre;
		$nuevoApellido = array_key_exists('apellido', $datos) && $datos['apellido'] !== '' ? (string)$datos['apellido'] : $this->apellido;
		$nuevoEmail = array_key_exists('email', $datos) && $datos['email'] !== '' ? (string)$datos['email'] : $this->email;

		$nuevaEdad = $this->edad;
		if (array_key_exists('edad', $datos)) {
			// null fuerza NULL, '' mantiene
			if ($datos['edad'] === null) {
				$nuevaEdad = null;
			} elseif ($datos['edad'] !== '') {
				$nuevaEdad = (int)$datos['edad'];
			}
		}

		$nuevoRol = array_key_exists('rol', $datos) && $datos['rol'] !== '' ? (string)$datos['rol'] : $this->rol;
		$nuevaVarita = array_key_exists('varita', $datos) ? ($datos['varita'] === '' ? $this->varita : ($datos['varita'] !== null ? (string)$datos['varita'] : null)) : $this->varita;
		$nuevoPatronus = array_key_exists('patronus', $datos) ? ($datos['patronus'] === '' ? $this->patronus : ($datos['patronus'] !== null ? (string)$datos['patronus'] : null)) : $this->patronus;
		$nuevoComentario = array_key_exists('comentario', $datos) ? ($datos['comentario'] === '' ? $this->comentario : ($datos['comentario'] !== null ? (string)$datos['comentario'] : null)) : $this->comentario;
		$nuevaFoto = array_key_exists('foto', $datos) ? ($datos['foto'] === '' ? $this->rutaFoto : ($datos['foto'] !== null ? (string)$datos['foto'] : null)) : $this->rutaFoto;

		$pdo = Database::getPDO();
		self::asegurarEsquema($pdo);

		try {
			$stmt = $pdo->prepare(
				'UPDATE aprendiz
				 SET nombre = :nombre, apellido = :apellido, email = :email, edad = :edad, rol = :rol, varita = :varita, patronus = :patronus, comentario = :comentario, foto = :foto
				 WHERE id = :id'
			);
			$ok = $stmt->execute([
				':nombre' => $nuevoNombre,
				':apellido' => $nuevoApellido,
				':email' => $nuevoEmail,
				':edad' => $nuevaEdad,
				':rol' => $nuevoRol,
				':varita' => $nuevaVarita,
				':patronus' => $nuevoPatronus,
				':comentario' => $nuevoComentario,
				':foto' => $nuevaFoto,
				':id' => $this->id,
			]);

			if (!$ok || $stmt->rowCount() === 0) {
				return false;
			}

			$this->nombre = $nuevoNombre;
			$this->apellido = $nuevoApellido;
			$this->email = $nuevoEmail;
			$this->edad = $nuevaEdad;
			$this->rol = $nuevoRol;
			$this->varita = $nuevaVarita;
			$this->patronus = $nuevoPatronus;
			$this->comentario = $nuevoComentario;
			$this->rutaFoto = $nuevaFoto;
			return true;
		} catch (Throwable $e) {
			return false;
		}
	}

	public function borraAprendiz(): bool
	{
		if ($this->id === null) {
			return false;
		}

		$pdo = Database::getPDO();
		self::asegurarEsquema($pdo);

		try {
			$stmt = $pdo->prepare('DELETE FROM aprendiz WHERE id = :id');
			$ok = $stmt->execute([':id' => $this->id]);
			return $ok && $stmt->rowCount() > 0;
		} catch (Throwable $e) {
			return false;
		}
	}

	private static function desdeFila(array $row): Aprendiz
	{
		return new Aprendiz([
			'id' => (int)($row['id'] ?? 0),
			'nombre' => (string)($row['nombre'] ?? ''),
			'apellido' => (string)($row['apellido'] ?? ''),
			'email' => (string)($row['email'] ?? ''),
			'edad' => $row['edad'] !== null ? (int)$row['edad'] : null,
			'rol' => (string)($row['rol'] ?? ''),
			'varita' => $row['varita'] !== null ? (string)$row['varita'] : null,
			'patronus' => $row['patronus'] !== null ? (string)$row['patronus'] : null,
			'comentario' => $row['comentario'] !== null ? (string)$row['comentario'] : null,
			'foto' => $row['foto'] !== null ? (string)$row['foto'] : null,
			'creado_en' => $row['creado_en'] !== null ? (string)$row['creado_en'] : null,
		]);
	}

	public function getNombre(): string
	{
		return $this->nombre;
	}

	public function getApellido(): string
	{
		return $this->apellido;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getEdad(): ?int
	{
		return $this->edad;
	}

	public function getRol(): string
	{
		return $this->rol;
	}

	public function getDescripcionRol(): ?string
	{
		return $this->descripcionRol;
	}

	public function getVarita(): ?string
	{
		return $this->varita;
	}

	public function getPatronus(): ?string
	{
		return $this->patronus;
	}

	public function getComentario(): ?string
	{
		return $this->comentario;
	}

	public function getRutaFoto(): ?string
	{
		return $this->rutaFoto;
	}

	public function setRutaFoto(?string $ruta): void
	{
		$this->rutaFoto = $ruta;
	}

	public function toArray(): array
	{
		return [
			'id'             => $this->id,
			'nombre'         => $this->nombre,
			'apellido'       => $this->apellido,
			'email'          => $this->email,
			'edad'           => $this->edad,
			'rol'            => $this->rol,
			'descripcionRol' => $this->descripcionRol,
			'varita'         => $this->varita,
			'patronus'       => $this->patronus,
			'comentario'     => $this->comentario,
			'foto'           => $this->rutaFoto,
			'creado_en'      => $this->creadoEn,
		];
	}
}