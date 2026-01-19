# Documentación del proyecto

## funciones.php

Archivo con toda la lógica común de sesión, validaciones y autenticación.

- `esVacio(string $valor): bool`
  - Devuelve `true` si la cadena está vacía o solo tiene espacios.
- `tieneLongitudMinima(string $valor, int $min): bool`
  - Comprueba si la longitud de la cadena es al menos el valor mínimo indicado.
- `esSoloLetras(string $valor): bool`
  - Verifica que el texto contenga únicamente letras y espacios (incluye acentos y ñ).
- `esAlfanumerico(string $valor): bool`
  - Comprueba que el texto solo tenga letras y números, sin espacios ni símbolos.
- `perfilEsValido(string $perfil): bool`
  - Comprueba que el perfil recibido esté dentro de la lista de perfiles permitidos.
- `validarNombreUsuario(string $nombre): array`
  - Valida el nombre de usuario: obligatorio y compuesto solo por letras.
  - Devuelve un array de mensajes de error (vacío si no hay errores).
- `validarPerfil(string $perfil): array`
  - Valida que se haya elegido un perfil y que sea uno de los permitidos.
- `validarPasswordCampo(string $password): array`
  - Valida la contraseña: no vacía, longitud mínima 6 y solo caracteres alfanuméricos.
- `validarFormularioLogin(string $nombre, string $perfil, string $password): array`
  - Ejecuta todas las validaciones anteriores sobre los tres campos del formulario de login.
  - Devuelve un array con todos los errores encontrados.
- `generarTokenFormulario(): string`
  - Genera un token aleatorio con `random_bytes`, lo guarda en la sesión y lo devuelve.
- `tokenEsValido(string $tokenRecibido): bool`
  - Comprueba que exista un token en sesión y que coincida con el token recibido.
- `cambiarSIDyToken(): string`
  - Regenera el ID de sesión (`session_regenerate_id`) y genera un nuevo token de formulario.
- `obtenerUsuariosSimulados(): array`
  - Devuelve un array con usuarios "de prueba" (nombre, perfil y `password_hash`).
- `autenticarUsuario(string $nombre, string $perfil, string $password): bool`
  - Recorre los usuarios simulados y valida credenciales usando `password_verify`.
- `guardarSesionUsuario(string $nombre, string $perfil): void`
  - Guarda en la sesión el nombre y el perfil del usuario autenticado.
- `limpiarSesionUsuario(): void`
  - Elimina de la sesión los datos del usuario logueado.
- `usuarioEstaLogueado(): bool`
  - Indica si en la sesión hay un usuario con nombre y perfil almacenados.
- `redirigirPorPerfil(string $perfil): void`
  - Redirige a la página específica según el perfil (gerente, sindicalista, nóminas) o al índice.
  - Cuando hay token en sesión, lo añade como parámetro de la URL (`?token=...`) para que las páginas protegidas puedan validarlo.

## datos_trabajadores.php

Define la clase de dominio Trabajador y funciones de cálculo sobre salarios.

- Clase `Trabajador`
  - Propiedades privadas: `nombre` (string), `salario` (float) y registro estático de trabajadores.
  - `__construct(string $nombre, float $salario)`
    - Crea un trabajador con nombre y salario indicados.
  - `getNombre(): string`
    - Devuelve el nombre del trabajador.
  - `getSalario(): float`
    - Devuelve el salario del trabajador.
  - `inicializarRegistro(): void`
    - Inicializa una lista estática de trabajadores solo la primera vez que se llama.
  - `obtenerTodos(): array`
    - Devuelve el registro estático de trabajadores, asegurando que esté inicializado.
  - `setRegistro(array $trabajadores): void`
    - Permite sustituir el registro estático por una lista externa de trabajadores.

- Funciones de cálculo
  - `salarioMinimo(array $trabajadores): float`
    - Recorre la lista de trabajadores y devuelve el salario más bajo.
  - `salarioMaximo(array $trabajadores): float`
    - Recorre la lista y devuelve el salario más alto.
  - `salarioMedio(array $trabajadores): float`
    - Calcula la media aritmética de los salarios de todos los trabajadores.

## index.php

Página principal con el formulario de autenticación.

Bloques principales:
- Carga de `funciones.php` y arranque de sesión.
- Inicialización de variables para errores, mensajes y campos del formulario.
- Generación y mantenimiento del token CSRF en la sesión.
- Gestión de los tres botones del formulario mediante `$_POST['accion']`:
  - **Acción "eliminar"**
    - Limpia los campos del formulario y borra los errores.
  - **Acción "validar"**
    - Valida token y campos usando `validarFormularioLogin`.
    - Si no hay errores, marca `$success` en `true` y muestra mensaje informativo.
    - Permite que al recargar, la contraseña se vuelva a mostrar rellena.
  - **Acción "enviar"**
    - Valida token y campos.
    - Si todo es correcto, guarda en la sesión un array `post_temp` con nombre, perfil, contraseña y token.
    - Redirige a `process.php` para completar la autenticación.
- Bloque HTML
  - Muestra errores en una lista y el mensaje de éxito si procede.
  - Formulario con:
    - Campo de nombre de usuario.
    - Radios para seleccionar el perfil.
    - Campo de contraseña (se rellena de nuevo solo cuando se ha validado correctamente).
    - Botones de Validar, Eliminar y Enviar.

## process.php

Script que termina el proceso de login y redirige según el perfil.

Bloques principales:
- Carga de `funciones.php`.
- Comprobación de que existe `$_SESSION['post_temp']`; si no, redirige a `index.php`.
- Recuperación de nombre, perfil, contraseña y token desde `$_SESSION['post_temp']` y borrado de esa variable.
- Validación del token recibido usando `tokenEsValido`.
- Si el token es válido:
  - Llama a `autenticarUsuario` para comprobar credenciales.
  - Si la autenticación falla, rellena el array de errores.
  - Si la autenticación es correcta:
    - Llama a `guardarSesionUsuario`.
    - Llama a `redirigirPorPerfil` para enviar al usuario a su página correspondiente.
- Si hay errores, se muestran en HTML y se ofrece un enlace para volver al formulario.

## gerente.php

Página restringida al perfil "Gerente".

Bloques principales:
- Inclusión de `funciones.php` y `datos_trabajadores.php`.
- Comprobación de que el usuario esté logueado y tenga perfil Gerente; si no, redirección a `index.php`.
- Comprobación adicional del token recibido por `GET` usando `tokenEsValido`.
  - Si falta el token o no coincide con el de sesión, se limpia la sesión del usuario y se redirige al índice (se comporta como "test" de SID+TOKEN).
- Gestión del botón "Cambiar SID":
  - Cuando se recibe un POST con `accion=cambiar_sid`, se llama a `cambiarSIDyToken` y se muestra un mensaje.
- Obtención de la lista de trabajadores (`Trabajador::obtenerTodos`) y cálculo de:
  - salario mínimo (`salarioMinimo`),
  - salario máximo (`salarioMaximo`),
  - salario medio (`salarioMedio`).
- Bloque HTML:
  - Muestra nombre de usuario logueado.
  - Muestra los resultados de salarios (mínimo, máximo y medio).
  - Lista los nombres de todos los trabajadores.
  - Formulario para cambiar SID.
  - Enlace de logout llamando a `logout.php` con el token actual como parámetro.

## nominas.php

Página restringida al perfil "Responsable de Nóminas".

Bloques principales:
- Inclusión de `funciones.php` y `datos_trabajadores.php`.
- Comprobación de que el usuario esté logueado y que su perfil sea Responsable de Nóminas.
- Validación del token recibido en la URL con `tokenEsValido`.
  - Si el token no está o no coincide, se borra la sesión de usuario y se redirige a `index.php`.
- Gestión del botón "Cambiar SID" llamando a `cambiarSIDyToken` y mostrando mensaje.
- Obtención de todos los trabajadores y cálculo de:
  - salario mínimo (`salarioMinimo`),
  - salario máximo (`salarioMaximo`).
- Bloque HTML:
  - Muestra el usuario logueado.
  - Solo muestra salario mínimo y máximo.
  - Formulario para cambiar SID.
  - Enlace a `logout.php` con el token actual.

## sindicalista.php

Página restringida al perfil "Sindicalista".

Bloques principales:
- Inclusión de `funciones.php` y `datos_trabajadores.php`.
- Comprobación de que el usuario esté logueado y que su perfil sea Sindicalista.
- Validación del token de la URL mediante `tokenEsValido`.
  - Si no es válido, se limpia la sesión y se vuelve al índice.
- Gestión del botón "Cambiar SID" llamando a `cambiarSIDyToken` y mostrando mensaje.
- Obtención de todos los trabajadores y cálculo del salario medio (`salarioMedio`).
- Bloque HTML:
  - Muestra el usuario logueado.
  - Solo muestra el salario medio.
  - Formulario para cambiar SID.
  - Enlace a `logout.php` con el token actual.

## logout.php

Script para cerrar la sesión del usuario.

Bloques principales:
- Inclusión de `funciones.php`.
- Lectura del token enviado por GET.
- Validación del token con `tokenEsValido`.
- Si el token es correcto:
  - Llama a `limpiarSesionUsuario` para borrar los datos del usuario en la sesión.
  - Muestra un mensaje de confirmación y un enlace para volver al formulario.
- Si no hay token o no coincide, se muestra un mensaje de error y se detiene la ejecución.
