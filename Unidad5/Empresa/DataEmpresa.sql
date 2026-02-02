USE EMPRESA;
INSERT INTO EMPRESA.CLIENTE (DNI, NOMBRE, APELLIDOS, DIRECCION, POBLACION, TELEFONO, FECHA_NAC) 
VALUES 
('00371569G', 'Beatriz', 'García Martín', 'C/ Lliria, 8', 'Manises', '961546852', '1975-06-25'),
('00445760C', 'Sandra', 'Flores Jorge', 'C/ Molí, 22', 'Alboraya', '961856877', '1992-07-14'),
('00740365H', 'Carlos', 'López Carvajal', 'C/ Sedaví, 15', 'Torrente', '961556542', '1943-05-01'),
('02748375J', 'Vanessa', 'Rodríguez Recio', 'C/ Alcañiz, 29', 'Valencia', '963655716', '1976-12-29'),
('03549358K', 'Ismael', 'Pazos Rincón', 'C/ Calisto III, 25', 'Valencia', '963604679', '1972-07-14'),
('07385709H', 'Esther', 'Zamora Castillo', 'C/ Colón, 14', 'Alboraya', '961856832', '1940-09-26'),
('07834658F', 'Alberto', 'Velez Rodrigo', 'C/ Santa Teresa, 11', 'Mislata', '963596486', '1993-08-23'),
('08785691J', 'Mariano', 'Dorado Serrano', 'C/ Fuencaliente, 1', 'Valencia', '963564495', '1942-12-30'),
('09856064N', 'Ana', 'Rodríguez Alonso', 'Avda. Gregrio Gea, 59', 'Mislata', '963591236', '1996-01-19'),
('12348630E', 'Soraya', 'Bru Corzo', 'C/ Maestro Palau, 12', 'Mislata', '963597459', '1941-10-20'),
('23503875Z', 'Carlos', 'Pineda Cruz', 'C/ Padre Mendez, 80', 'Torrente', '961556398', '1977-04-25'),
('24589635J', 'Marta', 'Paniagüa Alonso', 'C/ Maestro Serrano, 8', 'Manises', '961547750', '1978-09-13'),
('28759595G', 'Roberto', 'Pinilla Corzo', 'C/ Serpis, 84', 'Valencia', '963752687', '1941-09-15'),
('37409800R', 'Abraham', 'Vicó Ramírez', 'C/ Alicante, 14', 'Alfafar', '963962578', '1992-05-04'),
('43809540Z', 'Natalia', 'Montoya Arroyo', 'C/ del Sol, 55', 'Alfafar', '963963348', '1974-11-24'),
('58347695F', 'Ana', 'Belén Fuentes Rojas', 'C/ Tomás Sanz, 31', 'Mislata', '963594587', '1943-03-30');

INSERT INTO EMPRESA.PROVEEDOR (NIF, NOMBRE, DIRECCION)
VALUES
('A12345678', 'APP INFORMÁTICA', 'Gran Vía, 28'),
('G45632598', 'MEDIAMARKT', 'C/ Colón 67'),
('T98723467', 'PCBOX', 'C/ San Vicente, 228');

INSERT INTO EMPRESA.PRODUCTO (COD_PROD, NOMBRE, PROVEEDOR, PVP)
VALUES
('P0001', 'MONITOR','A12345678', 200.50),
('P0002', 'TECLADO','A12345678',25.49),
('P0003', 'RATÓN','A12345678', 15),
('P0004', 'ALTAVOCES','T98723467',15.50),
('P0005', 'PC SOBREMESA','A12345678', 400.75),
('P0006', 'MINI PC','T98723467', 200.99),
('P0007', 'PC ALL IN ONE','G45632598', 800.50),
('P0008', 'PC PORTÁTIL GAMING','G45632598', 1200),
('P0009', 'PC PORTÁTIL','T98723467',750.99),
('P0010', 'PC PORTÁTIL CONVERTIBLE','G45632598', 1000.99),
('P0011', 'ALTAVOCES','G45632598',17),
('P0012', 'ALTAVOCES','A12345678',12.95);

INSERT INTO EMPRESA.COMPRA(CLIENTE, PRODUCTO, FECHA, UDES)
VALUES
('00371569G', 'P0001', CURRENT_DATE(),2),
('00371569G', 'P0002', CURRENT_DATE(),2),
('00371569G', 'P0003', CURRENT_DATE(),2),
('00371569G', 'P0004', CURRENT_DATE(),2),
('00371569G', 'P0005', CURRENT_DATE(),2),
('23503875Z', 'P0001', CURRENT_DATE(),1),
('23503875Z', 'P0002', CURRENT_DATE(),1),
('23503875Z', 'P0003', CURRENT_DATE(),1),
('23503875Z', 'P0004', CURRENT_DATE(),1),
('23503875Z', 'P0005', CURRENT_DATE(),1),
('03549358K','P0007',CURRENT_DATE(),1),
('08785691J', 'P0010', CURRENT_DATE(),1),
('00740365H', 'P0008', CURRENT_DATE(),1),
('00740365H', 'P0011', CURRENT_DATE(),1),
('12348630E', 'P0009', CURRENT_DATE(),2),
('12348630E', 'P0012', CURRENT_DATE(),2),
('00445760C', 'P0006', CURRENT_DATE(),5);