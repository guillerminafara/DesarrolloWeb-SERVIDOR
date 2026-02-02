-- Script de prueba para el examen PHP
-- Crea la base de datos "aprendices" con una única tabla
-- que contiene todos los campos del formulario.

-- 1. Crear base de datos
CREATE DATABASE IF NOT EXISTS aprendices CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE aprendices;

-- 2. Tabla de aprendices / personajes
-- Coincide con los campos enviados por el formulario
-- y con el INSERT que se hace en aprendizcontrollers.php
CREATE TABLE IF NOT EXISTS aprendiz (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    edad INT NULL,
    rol VARCHAR(50) NULL,
    varita VARCHAR(150) NULL,
    patronus VARCHAR(150) NULL,
    habilidades TEXT NULL,      -- se puede guardar como CSV "pociones,defensa,..."
    comentario TEXT NULL,
    foto VARCHAR(255) NULL,     -- ruta al archivo subido
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. (Opcional) Ejemplo de inserción manual de un aprendiz / personaje
-- INSERT INTO aprendiz (nombre, apellido, email, edad, rol, varita, patronus, habilidades, comentario, foto)
-- VALUES ('Harry', 'Potter', 'harry@hogwarts.edu', 17, 'Gryffindor', 'Acebo y pluma de fénix', 'Ciervo', 'defensa,encantamientos', 'El elegido', 'uploads/harry.jpg');
