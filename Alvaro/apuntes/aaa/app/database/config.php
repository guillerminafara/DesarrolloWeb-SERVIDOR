<?php
// Configuración básica de la base de datos para el examen.
// Opción 1: MySQL (requiere tener servidor y extensión pdo_mysql)
// Opción 2: SQLite (.db), ideal si no quieres instalar MySQL.

// --- MySQL ---
$host    = 'localhost';
$db      = 'aprendices'; // "USE aprendices;" según las indicaciones del examen
$user    = 'root';       // Cámbialo si usas otro usuario (por ejemplo, 'dwes')
$pass    = '';
$charset = 'utf8mb4';

// --- SQLite ---
// Ruta al archivo de base de datos SQLite (se crea automáticamente si no existe)
$db_sqlite_path = __DIR__ . '/aprendices.db';


