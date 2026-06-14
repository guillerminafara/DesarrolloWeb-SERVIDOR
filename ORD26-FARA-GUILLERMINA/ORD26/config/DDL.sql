USE starwars;

DROP TABLE IF EXISTS planetas;

CREATE TABLE planetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    horasDia INT,        -- rotation_period de SWAPI
    diasAnyo INT,        -- orbital_period de SWAPI
    clima VARCHAR(100),
    terreno VARCHAR(150),
    imagen VARCHAR(150), 
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
