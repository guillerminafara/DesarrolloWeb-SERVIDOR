        <!-- 1. DATOS PERSONALES -->
        <fieldset>
            <legend>Datos Personales</legend>
            <label for="nombre">Nombre:</label><br />
            <!-- Mantenemos el valor introducido por el usuario si hay errores [2] -->
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required /><br />
        </fieldset>
        
        <!-- 2. NIVEL DE ESTUDIOS (Desplegable) [3] -->
        <fieldset>
            <legend>Nivel de Estudios</legend>
            <label for="estudios">Seleccione Nivel:</label><br />
            <select id="estudios" name="estudios">
                <option value="default" <?php if($estudios == 'default') echo 'selected'; ?>>-- Seleccione --</option>
                <option value="secundaria" <?php if($estudios == 'secundaria') echo 'selected'; ?>>Educación Secundaria</option>
                <option value="bachillerato" <?php if($estudios == 'bachillerato') echo 'selected'; ?>>Bachillerato / FP</option>
                <option value="universitario" <?php if($estudios == 'universitario') echo 'selected'; ?>>Estudios Universitarios</option>
            </select>
        </fieldset>
        
        <!-- 3. SITUACIÓN ACTUAL (Selección Múltiple/Checkboxes) [3] -->
        <fieldset>
            <legend>Situación Actual (Selección Múltiple)</legend>
            <!-- Usamos [] en el nombre para obtener un array en $_POST -->
            <input type="checkbox" name="situacion[]" value="estudiando" <?php if(in_array('estudiando', $situacion)) echo 'checked'; ?>> Estudiando<br />
            <input type="checkbox" name="situacion[]" value="trabajando" <?php if(in_array('trabajando', $situacion)) echo 'checked'; ?>> Trabajando<br />
            <input type="checkbox" name="situacion[]" value="buscando" <?php if(in_array('buscando', $situacion)) echo 'checked'; ?>> Buscando empleo<br />
            <input type="checkbox" name="situacion[]" value="desempleado" <?php if(in_array('desempleado', $situacion)) echo 'checked'; ?>> Desempleado<br />
        </fieldset>

        <!-- 4. HOBBIES (Checkboxes con opción de texto 'otro') [3] -->
        <fieldset>
            <legend>Hobbies</legend>
            <input type="checkbox" name="hobbies[]" value="lectura" <?php if(in_array('lectura', $hobbies)) echo 'checked'; ?>> Lectura<br />
            <input type="checkbox" name="hobbies[]" value="deporte" <?php if(in_array('deporte', $hobbies)) echo 'checked'; ?>> Deporte<br />
            <input type="checkbox" name="hobbies[]" value="musica" <?php if(in_array('musica', $hobbies)) echo 'checked'; ?>> Música<br />
            
            <input type="checkbox" name="hobbies[]" value="otro_check" id="otro_check" <?php if(in_array('otro_check', $hobbies)) echo 'checked'; ?>> Otro (Especifique):<br />
            <input type="text" name="otro_hobby_texto" value="<?php echo $otro_hobby_texto; ?>" placeholder="Especifique otro hobby aquí" />
        </fieldset>
        
        <br />
        <!-- Botones "Validar" y "Enviar" [3] (un solo botón tipo submit cumple ambas funciones en este flujo) -->
        <input type="submit" value="Validar y Enviar Datos" />
    </form>