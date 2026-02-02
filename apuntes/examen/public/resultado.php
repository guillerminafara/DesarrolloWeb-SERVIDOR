<?php
// Muestra el resultado del examen: datos del Aprendiz.

session_start();

// Recuperamos el JSON del aprendiz desde la sesión y lo convertimos en array
$datos = [];
if (isset($_SESSION['aprendiz'])) {
	$json = $_SESSION['aprendiz'];
	$tmp  = json_decode($json, true);
	if (is_array($tmp)) {
		$datos = $tmp;
	}
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Resultado del examen</title>
	<style>
		body { font-family: Arial, sans-serif; background:#111; color:#eee; }
		.tarjeta { border:1px solid #555; padding:1rem; max-width:600px; margin:2rem auto; background:#1b1b1b; }
		img { max-width:150px; display:block; margin-bottom:1rem; }
		dt { font-weight:bold; }
	</style>
</head>
<body>
	<div class="tarjeta">
		<h1>Resultado del examen PHP</h1>

		<?php if (!empty($datos)): ?>

			<?php if (!empty($datos['foto'])): ?>
				<img src="<?= htmlspecialchars($datos['foto'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>" alt="Foto del aprendiz">
			<?php endif; ?>

			<dl>
				<dt>Nombre completo</dt>
				<dd><?= htmlspecialchars($datos['nombre'] . ' ' . $datos['apellido'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>

				<dt>Correo</dt>
				<dd><?= htmlspecialchars($datos['email'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>

				<dt>Edad</dt>
				<dd><?= $datos['edad'] !== null ? (int)$datos['edad'] : 'No indicada'; ?></dd>

				<dt>Casa / Rol</dt>
				<dd><?= htmlspecialchars($datos['rol'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>

				<?php if (!empty($datos['descripcionRol'])): ?>
					<dt>Descripción de rol</dt>
					<dd><?= htmlspecialchars($datos['descripcionRol'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>
				<?php endif; ?>

				<?php if (!empty($datos['varita'])): ?>
					<dt>Varita</dt>
					<dd><?= htmlspecialchars($datos['varita'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>
				<?php endif; ?>

				<?php if (!empty($datos['patronus'])): ?>
					<dt>Patronus</dt>
					<dd><?= htmlspecialchars($datos['patronus'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>
				<?php endif; ?>

				<dt>Habilidades mágicas</dt>
				<dd>
					<?php if (!empty($datos['habilidades']) && is_array($datos['habilidades'])): ?>
						<?= htmlspecialchars(implode(', ', $datos['habilidades']), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>
					<?php else: ?>
						Ninguna habilidad seleccionada.
					<?php endif; ?>
				</dd>

				<?php if (!empty($datos['comentario'])): ?>
					<dt>Comentario</dt>
					<dd><?= htmlspecialchars($datos['comentario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></dd>
				<?php endif; ?>
			</dl>
		<?php else: ?>
			<p>No hay datos de examen en la sesión.</p>
		<?php endif; ?>

		<form action="volver.php" method="post">
			<button type="submit">Volver al formulario</button>
		</form>
	</div>
</body>
</html>
