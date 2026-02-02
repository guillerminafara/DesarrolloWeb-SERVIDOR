
<?php

$datos   = $_SESSION['datos_form'] ?? [];
$errores = $_SESSION['errores'] ?? [];

if (!isset($_SESSION['token'])) {
	crearTokenFormularioAlternativo();
}

function valor(string $campo, $porDefecto = '')
{
	global $datos;
	return htmlspecialchars($datos[$campo] ?? $porDefecto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function selectedRol(string $valor): string
{
	global $datos;
	return (($datos['rol'] ?? '') === $valor) ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Examen PHP - Aprendiz de Hogwarts</title>
</head>
<body>
	<style>
		form,fieldset{
			display: flex;
			flex-direction: column;
			justify-content: flex-start;
		}
	</style>
	<h1>Examen PHP - Formulario Aprendiz de Hogwarts</h1>

	<?php if (!empty($errores)): ?>
		<p class="error">Revisa los errores al final del formulario.</p>
	<?php endif; ?>

	<form  action="../app/controllers/aprendizcontrollers.php" method="POST" enctype="multipart/form-data" autocomplete="on">
		<input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">

		<fieldset>
			<legend>Datos del aprendiz</legend>

			<label>Nombre
				<input type="text" name="nombre" value="<?= valor('nombre'); ?>">
			</label>

			<label>Apellido
				<input type="text" name="apellido" value="<?= valor('apellido'); ?>">
			</label>

			<label>Correo electrónico (búho oficial)
				<input type="email" name="email" value="<?= valor('email'); ?>">
			</label>

			<label>Edad
				<input type="number" name="edad" min="10" max="120" value="<?= valor('edad'); ?>">
			</label>
		</fieldset>

		<fieldset>
			<legend>Magia y rol</legend>

			<label>Casa / Rol (actúa como rol)
				<select name="rol">
					<option value="">-- Elige tu casa --</option>
					<option value="Gryffindor" <?= selectedRol('Gryffindor'); ?>>Gryffindor</option>
					<option value="Slytherin" <?= selectedRol('Slytherin'); ?>>Slytherin</option>
					<option value="Hufflepuff" <?= selectedRol('Hufflepuff'); ?>>Hufflepuff</option>
					<option value="Ravenclaw" <?= selectedRol('Ravenclaw'); ?>>Ravenclaw</option>
				</select>
			</label>

			<label>Varita (madera y núcleo)
				<input type="text" name="varita" placeholder="Acebo y pluma de fénix" value="<?= valor('varita'); ?>">
			</label>

			<label>Patronus
				<input type="text" name="patronus" placeholder="Ciervo, fénix, nutria..." value="<?= valor('patronus'); ?>">
			</label>


		</fieldset>

		<fieldset>
			<legend>Foto y comentario</legend>

			<label>Sube una foto tipo carnet mágico
				<input type="file" name="imagen">
			</label>

			<label>Comentario para el director de Hogwarts
				<textarea name="comentario" rows="4" cols="50"><?= valor('comentario'); ?></textarea>
			</label>
		</fieldset>

		<div class="acciones">
			<button type="submit" name="accion" value="validar">Validar</button>
			<button type="submit" name="accion" value="enviar">Enviar</button>
			<button type="submit" name="accion" value="eliminar">Eliminar</button>
		</div>

		<?php if (!empty($errores)): ?>
			<ul class="error">
				<?php foreach ($errores as $mensaje): ?>
					<li><?= htmlspecialchars((string)$mensaje, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</form>
</body>
</html>

