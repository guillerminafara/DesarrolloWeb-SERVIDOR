# de que va php

> este repositorio esta enfocado a descifrar el codigo davinci que son los apuntes de PHP de 2ºDAW de la Senia
> los ejercicios que se pueden encontrar en las carpetas son interpretaciones personales de lo que puede acabar siendo el examen final



0. [formularios](#formularios)
1. [imagenes](#imagenes)
2. [sesiones](#sesiones)
3. [tokens](#tokens)
4. [roles](#roles)
5. [POO](#POO)
6. [SQL](#SQL)
7. [Ejercicio examen](#Ejercicio-examen)
8. [formularios snippets](#formularios-snippets)
9. [php snippets](#php-snippets)
10. [SQL snippets](#SQL-snippets)

<br><hr><br>


# formularios
- se desarrola el formulario cumpliendo con los [inputs](#formularios-snippets) requeridos

- en el value se carga el valor que se importa de la sesion. [ejemplo](#cargar-valor)

- los formularios tienen [3 botones](#botones) validar / enviar / eliminar cada uno con un `name` diferente

- las imagenes aprendemos a tratarlas en [imagenes](#imagenes)

- [ejemplo con todos los campos de formulario](#formulario-big-ejemplo) según los apuntes de Silvia

<br><hr><br>


# imagenes 
- obligatorio utilizar el atributo  `<form enctype="multipart/form-data"></form>`
- el input del form `<input type="file" name="imagen">`
- El archivo se gestiona desde la superglobal `$_FILES` asi que para leer la imagen `$_FILES['imagen']`
- Se comprueba que la subida sea válida y se mueve a la carpeta `uploads` [⚙️función](#subir-imagen)
- se guarda la ruta en la session `$_SESSION['foto'] = $ruta;`
- [⚙️función para generar nombre por fecha](#generar-nombre-por-fecha)


<br><hr><br>


# sesiones
- `session_start();` no te olvides.
- [⚙️cargamos los datos de la sesion](#cargar-datos-sesion)
- enviamos los datos del formulario a la sesion `$_SESSION['datos_form'] = $_POST;`
- para mostrar los datos en otra pagina es muy facil. [ejemplo](#mostrar-datos)
- [logout ejemplo](#logout)

<br><hr><br>


# tokens
- generamos el token [⚙️funcion](#generar-token)
- lo añadimos a la session `$_SESSION['token'] = crearTokenFormulario();`
- lo mandamos al formulario `<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">`
- comprobamos el token [⚙️funcion](#verificar-token)


<br><hr><br>


# roles
- se selecciona en el formulario el rol [ejemplo](#roles-formulario)
- procesar el rol enviado en el formulario. [⚙️procesar rol](#procesar-rol)
- verificar el rol. [⚙️funcion](#verificar-rol)

<br><hr><br>

# POO
- sintaxis de una clase que integra constructores, métodos de acceso (getters/setters), métodos de instancia y miembros estáticos, junto con su implementación práctica. [EJEMPLO](#POO-clase)
- las [interfcaes](#POO-interfaz) son como un contrato que [obliga](#poo-interfaz-aplicada) a una clase a aplicar X metodos.
- los traits... [voy a copiar y pegar de notebookLM](#POO-traits)

<br><hr><br>

# SQL
- explicacion del [MVC(modelo, vista, controlador)](#MVC)
- definimos la config de la BD en [BDconfig.php](#BDconfig.php)
- Creamos [BD.php](#bdphp) que se encarga de traducir nuestras consultas SQL a PHP, trata los datos del SQL como objetos
> te recomiendo leer los comentarios si no entiendes ni papa
- Creamos [productosController.php](#productosController.php) que recibe la petición del usuario, invoca al modelo y decide qué vista mostrar.
- Creamos [index.php](#index.php) que es donde se muestra el resultado de las consultas ejecutas en productosController con el PDO de BD :P.

# formularios snippets  [↑](#formularios)


### botones
```html
<button name="accion" value="validar">Validar</button>
<button name="accion" value="enviar">Enviar</button>
<button name="accion" value="eliminar">Eliminar</button>
```

### cargar valor  
```html
<input type="text" name="nombre" value="<?php echo htmlspecialchars($_SESSION['datos_usuario']['nombre']); ?>">
```


### cargar valor multi-select
```html
<select name="idiomas[]" multiple size="3">
    <option value="ingles"
        <?= in_array('ingles', $_SESSION['idiomas'] ?? []) ? 'selected' : '' ?>>
        Inglés
    </option>

    <option value="frances"
        <?= in_array('frances', $_SESSION['idiomas'] ?? []) ? 'selected' : '' ?>>
        Francés
    </option>

    <option value="aleman"
        <?= in_array('aleman', $_SESSION['idiomas'] ?? []) ? 'selected' : '' ?>>
        Alemán
    </option>
</select>
```

### roles formulario
```html 
<!-- roles.php -->
<form action="procesar_rol.php" method="post">
    Nombre: <input type="text" name="usuario"/>
    Password: <input type="password" name="password"/>
    <p>
        Estudiante <input type="radio" name="rol" value="Estudiante"/>
        Profesor <input type="radio" name="rol" value="Profesor"/>
        Otro <input type="radio" name="rol" value="Otro" />
    </p>
    <input type="submit" name="Acceder" value="Acceder"/>
</form>
```

### FORMULARIO **BIG** EJEMPLO
```html
<!-- Atributos: action (fichero destino), method (POST para procesar/seguridad), 
     enctype (obligatorio para ficheros), autocomplete y novalidate [1-3] -->
<form action="procesa.php" method="POST" enctype="multipart/form-data" autocomplete="on">

    <!-- SEGURIDAD: Token de formulario contra ataques CSRF [4] -->
    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

    <!-- FIELDSET y LEGEND: Agrupan controles relacionados [5] -->
    <fieldset>
        <legend>Información Personal</legend>

        <!-- LABEL e INPUT TEXT: El atributo 'for' debe coincidir con el 'id' [6, 7] -->
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" name="nombre" value="Valor por defecto" size="20"><br><br>

        <!-- INPUT PASSWORD: Caracteres ocultos [8] -->
        <label for="clave">Contraseña:</label>
        <input type="password" id="clave" name="clave"><br><br>

        <!-- INPUT HIDDEN: Datos que el usuario no ve ni modifica [9] -->
        <input type="hidden" name="id_usuario" value="12345">
    </fieldset>

    <fieldset>
        <legend>Preferencias y Archivos</legend>

        <!-- INPUT RADIO: Selección única (mismo name, distintos values) [9] -->
        <p>Género:</p>
        <input type="radio" id="fem" name="genero" value="M" checked>
        <label for="fem">Mujer</label>
        <input type="radio" id="masc" name="genero" value="H">
        <label for="masc">Hombre</label><br><br>

        <!-- INPUT CHECKBOX: Selección múltiple (uso de array [] en el name) [10] -->
        <p>Extras:</p>
        <input type="checkbox" id="garaje" name="extras[]" value="garaje" checked>
        <label for="garaje">Garaje</label>
        <input type="checkbox" id="piscina" name="extras[]" value="piscina">
        <label for="piscina">Piscina</label><br><br>

        <!-- SELECT SIMPLE: Desplegable de valor único [11] -->
        <label for="provincia">Provincia</label>
        <select name="provincia" id="provincia">
            <option value="valencia" selected>Valencia</option>
            <option value="alicante">Alicante</option>
            <option value="castellon">Castellón</option>
        </select><br><br>

        <!-- SELECT MÚLTIPLE: Selección de varios valores (usa array [] y size) [12] -->
        <label for="idiomas">Idiomas</label><br>
        <select multiple size="2" name="idiomas[]" id="idiomas">
            <option value="ingles" selected>Inglés</option>
            <option value="frances">Francés</option>
            <option value="aleman">Alemán</option>
        </select><br><br>

        <!-- INPUT FILE: Subida de archivos con validación de tamaño en cliente [13, 14] -->
        <label for="fichero">Subir avatar:</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="102400"> <!-- Limite en bytes -->
        <input type="file" id="fichero" name="fichero"><br><br>

        <!-- TEXTAREA: Caja de texto multilínea [7] -->
        <label for="comentario">Comentarios:</label><br>
        <textarea id="comentario" name="comentario" cols="50" rows="4">Escriba aquí...</textarea>
    </fieldset>

    <!-- BOTONES DE ACCIÓN [15-17] -->
    <!-- Submit estándar -->
    <input type="submit" name="enviar" value="Enviar datos">

    <!-- Submit con formaction: Sobrescribe el action del form (p.ej. para administradores) [16] -->
    <input type="submit" formaction="admin_procesa.php" value="Enviar como Admin">

    <!-- Reset: Limpia los controles [17] -->
    <input type="reset" name="borrar" value="Limpiar datos">

    <!-- Button genérico [15] -->
    <input type="button" name="ayuda" value="Ayuda">

</form>
```

<br><hr><br>








# php snippets

### subir imagen
```php
function subirImagen($input = 'imagen', $directorio = 'uploads/')
{
    if (
        isset($_FILES[$input]) &&
        is_uploaded_file($_FILES[$input]['tmp_name'])
    ) {
        $nombre = time() . '_' . $_FILES[$input]['name'];
        $ruta = $directorio . $nombre;

        move_uploaded_file($_FILES[$input]['tmp_name'], $ruta);

        $_SESSION['foto'] = $ruta;

        return $ruta;
    }

    return false;
}
para ejecutarla es - subirImagen() o subirImagen(nombreDelCampoDeTuImagen,nombreDelDirectorio).

```

### generar nombre por fecha

```php
function generarNombreAleatorio($nombreFichero) {
    $fecha = date("d-m-y"); 
    return $fecha . "-" . $nombreFichero; 
}
```


### cargar datos sesion
```php
function obtenerValorSesionJSON($nombreSesion = 'datos')
{
    if (isset($_SESSION[$nombreSesion])) {

        $datos = json_decode($_SESSION[$nombreSesion], true);

        if (is_array($datos)) {
            return $datos;
        }
    }

    return $default;
}
```

### mostrar datos
```php
<?php
    session_start(); 
    if (isset($_SESSION['datos_form'])) {
        echo "Hola, " . $_SESSION['datos_form']['nombre']; 
    }
?>
```

### logout
```php

<?php
session_start();
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600, $params["path"], $params["domain"]);
    }

    session_destroy();
    header("Location: index.php"); 
?>
```

### procesar rol
```php

session_start();

if (isset($_SESSION['usuario'])) {
    switch ($_SESSION['rol']) {
        case 'Estudiante':
            $location = 'Location: indexEstudiante.php';
            break;
        case 'Profesor':
            $location = 'Location: indexProfesor.php';
            break;
        default:
            $location = 'Location: indexDefault.php';
            break;
    }
    header($location); 
    exit;
}

```

### verificar rol
```php
esta funcion es especifica, la tendras que cambiar para que funcione
<?php
function validarAccesoRol($rolPermitido)
{
    session_start();

    if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $rolPermitido) {
        header('Location: index.php');
        exit;
    }

    print("Bienvenido " . $_SESSION['usuario'] . "!");
    print("Tu rol es " . $_SESSION['rol']);
}
?>
validarAccesoRol('estudiante');
```


### generar token
```php
function crearTokenFormulario() {
    $_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(24));
    return $_SESSION["token"];
}
```


### verificar token
```php
function verificarToken($tokenEnviado) {
    if (isset($_SESSION['token']) && hash_equals($_SESSION['token'], $tokenEnviado)) {
        return true;
    }
    return false;
}
```

### POO clase
```php
/**
 * Clase Producto basada en la estructura de la base de datos EMPRESA [1]
 */
class Producto {
    // Propiedades de instancia (privadas para encapsulamiento)
    private $codigo;
    private $nombre;
    private $pvp;

    // Propiedad estática: pertenece a la clase, no al objeto
    public static $impuesto = 0.21;

    /**
     * CONSTRUCTOR: Permite inicializar el objeto al crearlo con 'new' 
     */
    public function __construct($codigo, $nombre, $pvp) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->pvp = $pvp;
    }

    /**
     * GETTERS Y SETTERS
     */
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getPvp() {
        return $this->pvp;
    }

    public function setPvp($pvp) {
        if ($pvp >= 0) { // Validación lógica similar al CHECK de SQL [1]
            $this->pvp = $pvp;
        }
    }

    /**
     * MÉTODO DE INSTANCIA
     */
    public function calcularPrecioFinal() {
        // Multiplica el PVP por el impuesto estático usando self:: [2]
        return $this->pvp * (1 + self::$impuesto);
    }

    /**
     * MÉTODO ESTÁTICO
     */
    public static function cambiarIva($nuevoIva) {
        self::$impuesto = $nuevoIva;
    }
}

// --- BLOQUE DE LLAMADAS Y EJECUCIÓN ---

// 1. Invocación del CONSTRUCTOR para crear un objeto
$miProducto = new Producto("P0001", "Monitor", 200.50);

// 2. Uso de SETTERS para modificar valores 
$miProducto->setNombre("Monitor LED");
$miProducto->setPvp(185.00);

// 3. Uso de GETTERS para recuperar valores 
echo "Producto: " . $miProducto->getNombre() . "<br>"; // Imprime: Monitor LED

// 4. Invocación de un MÉTODO de instancia usando el operador "->"
$precioTotal = $miProducto->calcularPrecioFinal();
echo "Precio con IVA: " . $precioTotal . "€<br>";

// 5. Invocación de un MÉTODO ESTÁTICO usando el operador "::"
Producto::cambiarIva(0.10); // Cambia el IVA al 10% para todos los productos

// 6. Acceso a una PROPIEDAD ESTÁTICA externa (incluye el símbolo $) [2]
echo "IVA actual del sistema: " . (Producto::$impuesto * 100) . "%";
```


### POO interfaz
```php
interface NombreInterface { 
    public function getNombre(); 
    public function setNombre($nombre); 
}
```

### POO interfaz aplicada
```php
class Libro implements NombreInterface { 
    private $nombre; 

    public function getNombre() { // Implementación obligatoria
        return $this->nombre; 
    } 

    public function setNombre($nombre) { // Implementación obligatoria
        $this->nombre = $nombre; 
    } 
}
```

### POO traits
```php
Los traits (rasgos) son un mecanismo de PHP diseñado para la reutilización de código en contextos donde la herencia tradicional (vertical) no es suficiente o adecuada. Permiten que diferentes clases compartan métodos sin necesidad de pertenecer a la misma jerarquía de padres e hijos.
A continuación, se detalla su uso correcto y funcionamiento:
1. Definición e Inclusión Básica
Un trait se define con la palabra reservada trait y, a diferencia de una clase, no se puede instanciar directamente. Para utilizar sus métodos dentro de una clase, se emplea la palabra clave use.
Ejemplo sencillo:
trait IdentificadorTrait {
    private $id;
    public function setId($id) { $this->id = $id; }
    public function getId() { return $this->id; }
}

class Cliente {
    use IdentificadorTrait; // La clase Cliente ahora tiene los métodos del trait [2].
}

class Producto {
    use IdentificadorTrait; // La clase Producto también los reutiliza sin heredar de Cliente [2].
}
2. Resolución de Conflictos (Colisión de Nombres)
Cuando una clase utiliza múltiples traits que contienen métodos con el mismo nombre, PHP genera un error de colisión. Para solucionarlo, el programador debe decidir explícitamente qué método usar mediante dos operadores:
• insteadof: Indica cuál de los métodos en conflicto debe prevalecer.
• as: Permite crear un alias (nombre alternativo) para uno de los métodos, evitando que se pierda la funcionalidad del otro.
Ejemplo de colisión:
trait Logger {
    public function log($msg) { echo "Log de sistema: $msg"; }
}

trait DatabaseLogger {
    public function log($msg) { echo "Log de base de datos: $msg"; }
}

class Registro {
    use Logger, DatabaseLogger {
        Logger::log insteadof DatabaseLogger; // Elegimos el log de Logger por defecto [3].
        DatabaseLogger::log as logDB;           // Renombramos el de DatabaseLogger para no perderlo [3].
    }
}
3. Traits e Interfaces: El Máximo Potencial
El uso más avanzado y correcto de los traits ocurre cuando se combinan con interfaces. Mientras la interface define el "contrato" (qué debe hacer la clase), el trait proporciona la "implementación estándar" (cómo lo hace). Una clase puede implementar la interfaz y delegar la lógica directamente al trait.
Ejemplo de integración:
interface NombrableInterface {
    public function getNombre();
    public function setNombre($nombre);
}

trait NombrableTrait {
    private $nombre;
    public function getNombre() { return $this->nombre; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
}

// La clase cumple el contrato de la interfaz usando la lógica del trait [2].
class Proveedor implements NombrableInterface {
    use NombrableTrait; 
}
Resumen de Reglas de Uso:
1. Prioridad: Los métodos definidos en la propia clase sobrescriben a los del trait, y los métodos del trait sobrescriben a los heredados de la clase padre.
2. Modularidad: Úsalos para funcionalidades transversales (como logs, validaciones o formateo de datos) que no justifican crear una estructura de herencia compleja.
3. Sin Estado propio: Aunque pueden tener propiedades, el objetivo principal del trait es agrupar métodos reutilizables para evitar la duplicación de código en el sistema

```

### BDconfig.php
```php
/* BDConfig.php */
const HOST = 'localhost';
const DBNAME = 'EMPRESA';
const USERNAME = 'dwes';
const PASSWORD = 'dbdwespass';

// Configuración de PDO para que lance excepciones en caso de error
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION); 
```

#### BD.php
```php
require_once = "BDconfig.php";

class BD{
    private $pdo;

    public function __construct(){
        try{
            $dsn = "mysql:host=" . HOST . ";dbname=" . DBNAME . ";charset=utf8";
            $this->pdo = new PDO($dsn, USERNAME, PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar con la BD: " . $e->getMessage()); 
        }
    }


    //ejemplo de consulta con select
    //recibe el  id del proveedor porque es el parametro que va a filtrar el select
    public function obtenerProductosPorProveedor($idProv){
        $sql = "SELECT * FROM PRODUCTO WHERE PROVEEDOR = :id";
        $stmt = $this->pdo->prepare($sql);
        //ejecuta la consulta cambiando id por el id recibido
        $stmt->execute([':id'=>$idProv]);
        //devuelve un array asociativo con todas las columnas que encajan en la consulta
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cerrarConexion() {
        $this->pdo = null; // Cierra la conexión igualando a null [9]
    }
}
```
### productosController.php
```php
require_once "BD.php";
session_start();

// 2. Recuperar el ID del proveedor desde la sesión (antes era $_GET) [2]
// Si no existe en la sesión, podemos asignar uno por defecto o redirigir
$idProveedor = $_SESSION['idProv'] ?? 'A12345678'; 

// 3. Instanciar el modelo y obtener datos
//estamos creando un nuevo objeto de la clase BD que tiene PDO en el cosntructor y las consultas que se van a ejecutar
$modelo = new BD();

//acceemos a una consulta del modelo pasandole el id del proveedor y en listaProductos guardamos un array asociativo con la respuesta
$listaProductos = $modelo->obtenerProductosPorProveedor($idProveedor);

```

### index.php
```php
require_once "index.php"; 
<!DOCTYPE html>
<html>
<head><title>Panel de Productos</title></head>
<body>
    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p> [12, 13]
    <?php endif; ?>

    <h1>Productos asignados a su cuenta (ID: <?php echo $idProveedor; ?>)</h1>
    
    <ul>
        <?php if (!empty($listaProductos)): ?>
            <?php foreach ($listaProductos as $prod): ?>
                <li>
                    <strong><?php echo $prod['NOMBRE']; ?></strong> - 
                    Precio: <?php echo $prod['PVP']; ?>€
                </li> [14]
            <?php endforeach; ?>
        <?php else: ?>
            <li>No tiene productos asignados en esta sesión.</li>
        <?php endif; ?>
    </ul>
</body>
</html>

```
### MVC

MVC es una forma de organizar un proyecto PHP separando responsabilidades para que el código sea claro y fácil de mantener.

#### 1. Modelo
- Se encarga de **los datos**.
- Conecta con la base de datos usando **PDO**.
- Ejecuta consultas SQL y devuelve resultados como **arrays u objetos**.
- No muestra HTML ni decide qué se ve.

Ejemplo: obtener productos de un proveedor.

#### 2. Controlador
- Es el **intermediario**.
- Recibe la petición del usuario (formularios, sesión, URL).
- Llama al modelo para obtener los datos.
- Decide **qué vista** se debe mostrar y con qué datos.

Ejemplo: lee el id del proveedor desde la sesión y pide los productos al modelo.

#### 3. Vista
- Solo se encarga de **mostrar información**.
- Recibe los datos ya preparados por el controlador.
- Genera HTML.
- No contiene lógica de base de datos.

Ejemplo: mostrar la lista de productos en una tabla.

---

### Flujo básico MVC
1. El usuario hace una petición.
2. El **Controlador** la recibe.
3. El controlador pide datos al **Modelo**.
4. El modelo devuelve los datos.
5. El controlador envía esos datos a la **Vista**.
6. La vista los muestra al usuario.

---

### Resumen rápido
- **Modelo** → datos y base de datos  
- **Controlador** → lógica y decisiones  
- **Vista** → presentación (HTML)


# SQL snippets

### SELECT
```sql
SELECT * FROM tabla;
SELECT columna1, columna2 FROM tabla;

```

### INSERT
```sql
INSERT INTO usuarios (nombre, edad) VALUES ('Ana', 25);
```

### DELETE
```sql
DELETE FROM usuarios WHERE id = 3;
```

### UPDATE
```sql
SET edad = 26 WHERE nombre = 'Ana';
```

### WHERE
```sql
SELECT * FROM usuarios WHERE edad > 18;
SELECT * FROM usuarios WHERE nombre = 'Juan';
```

### ORDER BY
```sql
SELECT * FROM usuarios ORDER BY edad;
SELECT * FROM usuarios ORDER BY edad DESC;
```

### ORDER BY
```sql
SELECT * FROM tabla LIMIT 5;
```


### AND / OR
```sql
WHERE edad > 18 AND ciudad = 'Madrid';
WHERE edad < 18 OR edad > 65;
```

### LIKE
```sql
SELECT * FROM usuarios WHERE nombre LIKE 'A%';
```


