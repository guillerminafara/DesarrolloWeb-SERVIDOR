<?php
session_start();
// Controlador principal del examen.
// Recibe el formulario, valida, maneja la imagen y crea el objeto Aprendiz
// en función del rol seleccionado y los datos de la BD.

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../models/Aprendiz.php';
require_once __DIR__ . '/../../validaciones.php';

// Solo aceptamos peticiones POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: ../../public/index.php');
	exit;
}

// Acción recibida desde el formulario
$accion = $_POST['accion'] ?? '';

switch ($accion) {
	case 'eliminar':
		// Acción: limpiar sesión del formulario y volver al inicio
		limpiarSesionFormulario();
		header('Location: ../../public/index.php');
		exit;

	case 'validar':
		// Comprobamos token CSRF
		$tokenEnviado = $_POST['token'] ?? '';
		if (!verificarToken($tokenEnviado)) {
			$_SESSION['errores']['token'] = 'Token inválido. Recarga el formulario.';
			header('Location: ../../public/index.php');
			exit;
		}

		// Validamos campos del formulario
		$errores = [];
		$datosLimpios = validarFormularioAprendiz($_POST, $errores);

		// Volvemos siempre al formulario con los errores (si los hay)
		$_SESSION['errores'] = $errores;
		header('Location: ../../public/index.php');
		exit;

	case 'enviar':
	default:
		// Comprobamos token CSRF
		$tokenEnviado = $_POST['token'] ?? '';
		if (!verificarToken($tokenEnviado)) {
			$_SESSION['errores']['token'] = 'Token inválido. Recarga el formulario.';
			header('Location: ../../public/index.php');
			exit;
		}

		// Validamos campos del formulario
		$errores = [];
		$datosLimpios = validarFormularioAprendiz($_POST, $errores);

		// Si hay errores no enviamos nada y volvemos al formulario
		if (!empty($errores)) {
			$_SESSION['errores'] = $errores;
			header('Location: ../../public/index.php');
			exit;
		}

		// Subimos imagen (opcional)
		$rutaFoto = subirImagen('imagen', '../../public/uploads/');
		if ($rutaFoto !== false) {
			$datosLimpios['foto'] = $rutaFoto;
		}

		// En el enunciado del examen hay una única tabla donde
		// se inserta directamente el "personaje" / aprendiz.
		// Ya no consultamos una tabla de roles aparte.
		$datosRol = [];
		$aprendiz = new Aprendiz($datosLimpios, $datosRol);

		// Insertamos el aprendiz en la tabla de la base de datos.
		// Ajusta el nombre de la tabla y de las columnas si en el examen
		// se llaman de otra forma.
		try {
			$habilidadesTexto = implode(',', $aprendiz->getHabilidades());

			$sql = "INSERT INTO aprendiz 
				(nombre, apellido, email, edad, rol, varita, patronus, habilidades, comentario, foto)
				VALUES
				(:nombre, :apellido, :email, :edad, :rol, :varita, :patronus, :habilidades, :comentario, :foto)";

			$stmt = $pdo->prepare($sql);
			$stmt->execute([
				':nombre'      => $aprendiz->getNombre(),
				':apellido'    => $aprendiz->getApellido(),
				':email'       => $aprendiz->getEmail(),
				':edad'        => $aprendiz->getEdad(),
				':rol'         => $aprendiz->getRol(),
				':varita'      => $aprendiz->getVarita(),
				':patronus'    => $aprendiz->getPatronus(),
				':habilidades' => $habilidadesTexto,
				':comentario'  => $aprendiz->getComentario(),
				':foto'        => $aprendiz->getRutaFoto(),
			]);
		} catch (PDOException $e) {
			// Si falla la inserción, devolvemos al formulario con un error genérico
			$_SESSION['errores']['bd'] = 'Error al guardar el aprendiz en la base de datos.';
			header('Location: ../../public/index.php');
			exit;
		}

		// Guardamos los datos del aprendiz en sesión usando JSON para mostrarlo en resultado.php
		$_SESSION['aprendiz'] = json_encode(
			$aprendiz->toArray(),
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
		);

		// Limpiamos errores, ya que el envío ha sido correcto
		unset($_SESSION['errores']);

		header('Location: ../../public/resultado.php');
		exit;
}
