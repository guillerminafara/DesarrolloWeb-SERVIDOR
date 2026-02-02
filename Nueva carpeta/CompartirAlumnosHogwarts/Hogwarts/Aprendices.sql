CREATE TABLE aprendices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    casa VARCHAR(50) NOT NULL,
    varita VARCHAR(100) NOT NULL,
    asignaturas TEXT NOT NULL,
    nivel INT,
    foto VARCHAR(255),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);
