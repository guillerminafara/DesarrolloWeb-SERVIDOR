<?php
session_start();


function esVacio(string $valor): bool {
    return trim($valor) === '';
}


function tieneLongitudMinima(string $valor, int $min): bool {
    return strlen($valor) >= $min;
}

function esSoloLetras(string $valor): bool {
    return (bool) preg_match('/^[[:alpha:]\s]+$/u', $valor);
}

function esAlfanumerico(string $valor): bool {
    return (bool) preg_match('/^[a-zA-Z0-9]+$/', $valor);
}

function perfilEsValido(string $perfil): bool {
    $perfilesValidos = ['Gerente', 'Sindicalista', 'Responsable de Nóminas'];
    return in_array($perfil, $perfilesValidos, true);
}


function validarNombreUsuario(string $nombre): array {
    $errores = [];

    if (esVacio($nombre)) {
        $errores[] = "El nombre de usuario es obligatorio.";
        return $errores;
    }

    if (!esSoloLetras($nombre)) {
        $errores[] = "El nombre de usuario debe contener solo letras (sin números).";
    }

    return $errores;
}


function validarPerfil(string $perfil): array {
    $errores = [];

    if (esVacio($perfil)) {
        $errores[] = "Debes seleccionar un perfil.";
        return $errores;
    }

    if (!perfilEsValido($perfil)) {
        $errores[] = "El perfil seleccionado no es válido.";
    }

    return $errores;
}

function validarPasswordCampo(string $password): array {
    $errores = [];

    if (esVacio($password)) {
        $errores[] = "La contraseña es obligatoria.";
        return $errores;
    }

    if (!tieneLongitudMinima($password, 6)) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (!esAlfanumerico($password)) {
        $errores[] = "La contraseña debe ser alfanumérica (solo letras y números, sin símbolos).";
    }

    return $errores;
}

function validarFormularioLogin(string $nombre, string $perfil, string $password): array {
    $errores = [];

    // Validar nombre
    $errores = array_merge($errores, validarNombreUsuario($nombre));

    // Validar perfil
    $errores = array_merge($errores, validarPerfil($perfil));

    // Validar contraseña
    $errores = array_merge($errores, validarPasswordCampo($password));

    return $errores;
}

function generarTokenFormulario(): string {
    $token = bin2hex(random_bytes(24));
    $_SESSION['token'] = $token;
    return $token;
}
function tokenEsValido(string $tokenRecibido): bool {
    if (!isset($_SESSION['token'])) {
        return false;
    }
    return hash_equals($_SESSION['token'], $tokenRecibido);
}

function cambiarSIDyToken(): string {
    session_regenerate_id(true);
    return generarTokenFormulario();
}

function obtenerUsuariosSimulados(): array {
    return [
        [
            'nombre'        => 'gerente',
            'perfil'        => 'Gerente',
            'password_hash' => password_hash('clavegerente', PASSWORD_DEFAULT),
        ],
        [
            'nombre'        => 'sindical',
            'perfil'        => 'Sindicalista',
            'password_hash' => password_hash('clavesindical', PASSWORD_DEFAULT),
        ],
        [
            'nombre'        => 'nominas',
            'perfil'        => 'Responsable de Nóminas',
            'password_hash' => password_hash('clavenominas', PASSWORD_DEFAULT),
        ],
    ];
}

function autenticarUsuario(string $nombre, string $perfil, string $password): bool {
    $usuarios = obtenerUsuariosSimulados();

    foreach ($usuarios as $user) {
        if (
            $user['nombre'] === $nombre &&
            $user['perfil'] === $perfil &&
            password_verify($password, $user['password_hash'])
        ) {
            return true;
        }
    }
    return false;
}

function guardarSesionUsuario(string $nombre, string $perfil): void {
    $_SESSION['usuario_nombre'] = $nombre;
    $_SESSION['usuario_perfil'] = $perfil;
}

function limpiarSesionUsuario(): void {
    unset($_SESSION['usuario_nombre'], $_SESSION['usuario_perfil']);
}

function usuarioEstaLogueado(): bool {
    return isset($_SESSION['usuario_nombre'], $_SESSION['usuario_perfil']);
}

function redirigirPorPerfil(string $perfil): void {
    $tokenParam = '';
    if (isset($_SESSION['token'])) {
        $tokenParam = '?token=' . urlencode($_SESSION['token']);
    }
    switch ($perfil) {
        case 'Gerente':
            header('Location: gerente.php' . $tokenParam);
            break;
        case 'Sindicalista':
            header('Location: sindicalista.php' . $tokenParam);
            break;
        case 'Responsable de Nóminas':
            header('Location: nominas.php' . $tokenParam);
            break;
        default:
            header('Location: index.php');
    }
    exit;
}