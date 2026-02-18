<?php
// ---------------- TOKEN CSRF ----------------

function crearTokenFormulario()
{
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
	return $_SESSION['token'];
}

// Alternativa sin openssl_random_pseudo_bytes (por si la extensión no está disponible)
// Mantiene la idea de token aleatorio pero usando funciones estándar de PHP.
function crearTokenFormularioAlternativo()
{
	if (function_exists('random_bytes')) {
		$_SESSION['token'] = bin2hex(random_bytes(24));
	} else {
		// Fallback menos seguro pero válido para entorno de prácticas/examen sin extensiones
		$entropia = uniqid((string)mt_rand(), true) . session_id() . microtime(true);
		$_SESSION['token'] = hash('sha256', $entropia);
	}

	return $_SESSION['token'];
}

function verificarToken(string $tokenEnviado): bool
{
	if (isset($_SESSION['token']) && hash_equals($_SESSION['token'], $tokenEnviado)) {
		return true;
	}
	return false;
}

// ---------------- SUBIDA DE IMAGEN ----------------

function subirImagen(string $input = 'imagen', string $directorio = 'uploads/')
{
	if (isset($_FILES[$input]) && is_uploaded_file($_FILES[$input]['tmp_name'])) {
		if (!is_dir($directorio)) {
			// Intentamos crear el directorio si no existe (modo examen: simple).
			@mkdir($directorio, 0777, true);
		}

		$nombre = time() . '_' . basename($_FILES[$input]['name']);
		$ruta   = rtrim($directorio, '/\\') . '/' . $nombre;

		if (move_uploaded_file($_FILES[$input]['tmp_name'], $ruta)) {
			$_SESSION['foto'] = $ruta;
			return $ruta;
		}
	}

	return false;
}

// ---------------- VALIDACIÓN FORMULARIO HARRY POTTER ----------------

/**
 * Valida los datos del formulario de aprendiz (Harry Potter).
 * Devuelve un array con los datos saneados y rellena $errores si algo falla.
 */
function validarFormularioAprendiz(array $datos, array &$errores = []): array
{
	$limpios = [];

	// Nombre (obligatorio)
	$nombre = trim($datos['nombre'] ?? '');
	if ($nombre === '') {
		$errores['nombre'] = 'El nombre es obligatorio.';
	}
	$limpios['nombre'] = htmlspecialchars($nombre, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

	// Apellido (obligatorio)
	$apellido = trim($datos['apellido'] ?? '');
	if ($apellido === '') {
		$errores['apellido'] = 'El apellido es obligatorio.';
	}
	$limpios['apellido'] = htmlspecialchars($apellido, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

	// Email (obligatorio + formato)
	$email = trim($datos['email'] ?? '');
	if ($email === '') {
		$errores['email'] = 'El correo es obligatorio.';
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errores['email'] = 'El correo no tiene un formato válido.';
	}
	$limpios['email'] = $email;

	// Edad (opcional pero si viene, numérica y rango razonable)
	$edad = trim($datos['edad'] ?? '');
	if ($edad !== '') {
		if (!ctype_digit($edad) || (int)$edad < 10 || (int)$edad > 120) {
			$errores['edad'] = 'La edad debe ser un número entre 10 y 120.';
		} else {
			$limpios['edad'] = (int)$edad;
		}
	} else {
		$limpios['edad'] = null;
	}

	// Rol / casa / característica (obligatorio)
	$rol = $datos['rol'] ?? '';
	if ($rol === '') {
		$errores['rol'] = 'Debes seleccionar un rol/casa.';
	}
	$limpios['rol'] = $rol;

	// Varita (opcional)
	$varita = trim($datos['varita'] ?? '');
	$limpios['varita'] = $varita !== ''
		? htmlspecialchars($varita, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
		: null;

	// Patronus (opcional)
	$patronus = trim($datos['patronus'] ?? '');
	$limpios['patronus'] = $patronus !== ''
		? htmlspecialchars($patronus, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
		: null;

	// Habilidades (checkbox múltiple)
	$habilidades = $datos['habilidades'] ?? [];
	if (!is_array($habilidades)) {
		$habilidades = [];
	}
	$limpios['habilidades'] = $habilidades;

	// Comentario (opcional)
	$comentario = trim($datos['comentario'] ?? '');
	$limpios['comentario'] = $comentario !== ''
		? htmlspecialchars($comentario, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
		: null;

	// Guardamos datos limpios en sesión para recargar el formulario
	$_SESSION['datos_form'] = $limpios;

	return $limpios;
}

// ---------------- UTILIDAD LIMPIAR SESIÓN ----------------

function limpiarSesionFormulario(): void
{
	unset($_SESSION['datos_form'], $_SESSION['errores'], $_SESSION['foto'], $_SESSION['aprendiz']);
}

