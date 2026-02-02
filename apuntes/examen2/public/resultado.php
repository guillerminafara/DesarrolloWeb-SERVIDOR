<?php
// Muestra el resultado del examen: datos del Aprendiz.

session_start();

require_once __DIR__ . '/../app/database/database.php';

// Recuperamos el JSON del aprendiz desde la sesión y lo convertimos en array
$datos = [];
if (isset($_SESSION['aprendiz'])) {
	$json = $_SESSION['aprendiz'];
	$tmp  = json_decode($json, true);
	if (is_array($tmp)) {
		$datos = $tmp;
	}
}

$aprendices = [];
$errorListado = null;
try {
	$stmt = $pdo->query(
		"SELECT id, nombre, apellido, email, edad, rol, varita, patronus, comentario, foto, creado_en FROM aprendiz ORDER BY id DESC"
	);
	$aprendices = $stmt->fetchAll();
} catch (PDOException $e) {
	$errorListado = 'No se pudo cargar el listado de aprendices.';
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
		.listado { border:1px solid #555; padding:1rem; max-width:1100px; margin:2rem auto; background:#1b1b1b; }
		img { max-width:150px; display:block; margin-bottom:1rem; }
		dt { font-weight:bold; }
		table { width:100%; border-collapse:collapse; }
		th, td { border:1px solid #444; padding:0.5rem; vertical-align:top; }
		th { background:#222; text-align:left; }
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

	<div class="listado">
		<h2>Listado de aprendices (BD)</h2>

		<?php if ($errorListado !== null): ?>
			<p><?= htmlspecialchars($errorListado, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>
		<?php elseif (empty($aprendices)): ?>
			<p>No hay aprendices guardados todavía.</p>
		<?php else: ?>
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Email</th>
						<th>Edad</th>
						<th>Rol</th>
						<th>Varita</th>
						<th>Patronus</th>
						<th>Comentario</th>
						<th>Foto</th>
						<th>Creado</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($aprendices as $a): ?>
						<tr>
							<td><?= (int)($a['id'] ?? 0); ?></td>
							<td><?= htmlspecialchars((string)($a['nombre'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['apellido'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['email'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= ($a['edad'] ?? null) !== null ? (int)$a['edad'] : ''; ?></td>
							<td><?= htmlspecialchars((string)($a['rol'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['varita'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['patronus'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['comentario'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['foto'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
							<td><?= htmlspecialchars((string)($a['creado_en'] ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</body>
</html>
