<?php
function crearTokenFormulario()
{
	$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(24));
	return $_SESSION['token'];
}
function crearTokenFormularioAlternativo()
{
	if (function_exists('random_bytes')) {
		$_SESSION['token'] = bin2hex(random_bytes(24));
	} else {
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
function subirImagen(string $input = 'imagen', string $directorio = 'uploads/')
{
	if (isset($_FILES[$input]) && is_uploaded_file($_FILES[$input]['tmp_name'])) {
		if (!is_dir($directorio)) {
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
function sanitize($valor): string
{
	$texto = trim((string)$valor);
	return strip_tags($texto);
}

function esRequerido($valor): bool
{
	return trim((string)$valor) !== '';
}

function esEmailFormatoValido($valor): bool
{
	$texto = trim((string)$valor);
	return $texto !== '' && filter_var($texto, FILTER_VALIDATE_EMAIL) !== false;
}

function esEdadValida($valor): bool
{
	$texto = trim((string)$valor);
	if ($texto === '') {
		return true;
	}
	if (!ctype_digit($texto)) {
		return false;
	}
	$numero = (int)$texto;
	return $numero >= 10 && $numero <= 120;
}

function validarFormulario(array $datos): array
{
	$errores = [];

	$nombre = $datos['nombre'] ?? '';
	if (!esRequerido($nombre)) {
		$errores['nombre'] = 'El nombre es obligatorio.';
	}

	$apellido = $datos['apellido'] ?? '';
	if (!esRequerido($apellido)) {
		$errores['apellido'] = 'El apellido es obligatorio.';
	}

	$email = $datos['email'] ?? '';
	if (!esRequerido($email)) {
		$errores['email'] = 'El correo es obligatorio.';
	} elseif (!esEmailFormatoValido($email)) {
		$errores['email'] = 'El correo no tiene un formato válido.';
	}

	$edad = $datos['edad'] ?? '';
	if (!esEdadValida($edad)) {
		$errores['edad'] = 'La edad debe ser un número entre 10 y 120.';
	}

	$rol = $datos['rol'] ?? '';
	if (!esRequerido($rol)) {
		$errores['rol'] = 'Debes seleccionar un rol/casa.';
	}

	return $errores;
}

function limpiarInputs(array $datos): array
{
	$datosLimpios = [];
	$datosLimpios['nombre'] = sanitize($datos['nombre'] ?? '');
	$datosLimpios['apellido'] = sanitize($datos['apellido'] ?? '');
	$datosLimpios['email'] = trim((string)($datos['email'] ?? ''));

	$edadTexto = trim((string)($datos['edad'] ?? ''));
	$datosLimpios['edad'] = ($edadTexto !== '' && ctype_digit($edadTexto)) ? (int)$edadTexto : null;

	$datosLimpios['rol'] = trim((string)($datos['rol'] ?? ''));
	$datosLimpios['varita'] = esRequerido($datos['varita'] ?? '') ? sanitize($datos['varita']) : null;
	$datosLimpios['patronus'] = esRequerido($datos['patronus'] ?? '') ? sanitize($datos['patronus']) : null;
	$datosLimpios['comentario'] = esRequerido($datos['comentario'] ?? '') ? sanitize($datos['comentario']) : null;

	return $datosLimpios;
}
function limpiarSesionFormulario(): void
{
	unset($_SESSION['datos_form'], $_SESSION['errores'], $_SESSION['foto'], $_SESSION['aprendiz']);
}

