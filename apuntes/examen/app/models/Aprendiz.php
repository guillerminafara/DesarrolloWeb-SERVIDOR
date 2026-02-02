<?php

// Modelo POO que representa al aprendiz del examen.
// Combina datos del formulario (Harry Potter) y, opcionalmente, datos del rol desde la BD.

class Aprendiz
{
	private string $nombre;
	private string $apellido;
	private string $email;
	private ?int $edad;
	private string $rol;              // Actúa como rol/casa/característica elegida
	private ?string $descripcionRol;  // Información extra que pueda venir de la tabla rol
	private ?string $varita;
	private ?string $patronus;
	/** @var string[] */
	private array $habilidades;
	private ?string $comentario;
	private ?string $rutaFoto;        // Ruta relativa a la imagen subida

	public function __construct(array $datosFormulario, array $datosRol = [])
	{
		$this->nombre         = $datosFormulario['nombre'] ?? '';
		$this->apellido       = $datosFormulario['apellido'] ?? '';
		$this->email          = $datosFormulario['email'] ?? '';
		$this->edad           = isset($datosFormulario['edad']) ? (int)$datosFormulario['edad'] : null;
		$this->rol            = $datosFormulario['rol'] ?? ($datosRol['nombre'] ?? '');
		$this->descripcionRol = $datosRol['descripcion'] ?? null;
		$this->varita         = $datosFormulario['varita'] ?? null;
		$this->patronus       = $datosFormulario['patronus'] ?? null;
		$this->habilidades    = $datosFormulario['habilidades'] ?? [];
		$this->comentario     = $datosFormulario['comentario'] ?? null;
		$this->rutaFoto       = $datosFormulario['foto'] ?? null; // se rellena desde la validación de imagen
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

	/**
	 * @return string[]
	 */
	public function getHabilidades(): array
	{
		return $this->habilidades;
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

	/**
	 * Exporta los datos en forma de array asociativo (útil para debug o vistas).
	 */
	public function toArray(): array
	{
		return [
			'nombre'         => $this->nombre,
			'apellido'       => $this->apellido,
			'email'          => $this->email,
			'edad'           => $this->edad,
			'rol'            => $this->rol,
			'descripcionRol' => $this->descripcionRol,
			'varita'         => $this->varita,
			'patronus'       => $this->patronus,
			'habilidades'    => $this->habilidades,
			'comentario'     => $this->comentario,
			'foto'           => $this->rutaFoto,
		];
	}
}

