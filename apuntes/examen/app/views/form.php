<?php
// aquí empieza el examen

// recuperamos datos previos y errores
$datos   = $_SESSION['datos_form'] ?? [];
$errores = $_SESSION['errores'] ?? [];

//si no hay token, creamos uno nuevo
if (!isset($_SESSION['token'])) {
	crearTokenFormularioAlternativo();
}

//funcion para limpiar lo que ponemos en el form
function valor(string $campo, $porDefecto = '')
{
	global $datos;
	return htmlspecialchars($datos[$campo] ?? $porDefecto, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

//comprueba si en la variable errores esta ese campo (key del diccionario errores)
function tieneError(string $campo): bool
{
	global $errores;
	return isset($errores[$campo]);
}


//funcion para mostrar el texto de error de un campo (valor del diccionario errores)
function textoError(string $campo): string
{
	global $errores;
	return $errores[$campo] ?? '';
}

//funcion para comprobar si la habilidad esta en la sesion
function checkedHabilidad(string $valor): string
{
	global $datos;
	$lista = $datos['habilidades'] ?? [];
	return (is_array($lista) && in_array($valor, $lista, true)) ? 'checked' : '';
}

//funcion para comprobar si el rol seleccionado es el que esta en la sesion
function selectedRol(string $valor): string
{
	global $datos;
	return (($datos['rol'] ?? '') === $valor) ? 'selected' : '';
}

//continuamos en aprendizcontrollers.php para procesar el formulario
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Examen PHP - Aprendiz de Hogwarts</title>
</head>
<body>
	<h1>Examen PHP - Formulario Aprendiz de Hogwarts</h1>


	<?php if (!empty($errores)): ?>
		<p class="error">Revisa los campos marcados en rojo antes de continuar.</p>
	<?php endif; ?>

	<form action="../app/controllers/aprendizcontrollers.php" method="POST" enctype="multipart/form-data" autocomplete="on">
		<input type="hidden" name="token" value="<?= htmlspecialchars($_SESSION['token'] ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">

		<fieldset>
			<legend>Datos del aprendiz</legend>

			<label>Nombre
				<input type="text" name="nombre" value="<?= valor('nombre'); ?>">
				<?php if (tieneError('nombre')): ?><span class="error"><?= textoError('nombre'); ?></span><?php endif; ?>
			</label>

			<label>Apellido
				<input type="text" name="apellido" value="<?= valor('apellido'); ?>">
				<?php if (tieneError('apellido')): ?><span class="error"><?= textoError('apellido'); ?></span><?php endif; ?>
			</label>

			<label>Correo electrónico (búho oficial)
				<input type="email" name="email" value="<?= valor('email'); ?>">
				<?php if (tieneError('email')): ?><span class="error"><?= textoError('email'); ?></span><?php endif; ?>
			</label>

			<label>Edad
				<input type="number" name="edad" min="10" max="120" value="<?= valor('edad'); ?>">
				<?php if (tieneError('edad')): ?><span class="error"><?= textoError('edad'); ?></span><?php endif; ?>
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
				<?php if (tieneError('rol')): ?><span class="error"><?= textoError('rol'); ?></span><?php endif; ?>
			</label>

			<label>Varita (madera y núcleo)
				<input type="text" name="varita" placeholder="Acebo y pluma de fénix" value="<?= valor('varita'); ?>">
			</label>

			<label>Patronus
				<input type="text" name="patronus" placeholder="Ciervo, fénix, nutria..." value="<?= valor('patronus'); ?>">
			</label>

			<p>Habilidades mágicas destacadas</p>
			<label>
				<input type="checkbox" name="habilidades[]" value="pociones" <?= checkedHabilidad('pociones'); ?>> Pociones
			</label>
			<label>
				<input type="checkbox" name="habilidades[]" value="transformaciones" <?= checkedHabilidad('transformaciones'); ?>> Transformaciones
			</label>
			<label>
				<input type="checkbox" name="habilidades[]" value="encantamientos" <?= checkedHabilidad('encantamientos'); ?>> Encantamientos
			</label>
			<label>
				<input type="checkbox" name="habilidades[]" value="defensa" <?= checkedHabilidad('defensa'); ?>> Defensa contra las Artes Oscuras
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
	</form>
</body>
</html>



