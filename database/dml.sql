
INSERT INTO usuarios (email,nombre,password) VALUES ('usuario','dummy','inseguro');

-- -----------------------------------------------------
-- CATALOGO DE MONEDAS
-- -----------------------------------------------------
INSERT INTO moneda(id_moneda,acronimo,nombre,descripcion) VALUES
(1,'M.N.','Moneda Nacional','Pesos mexicanos')
,(2,'USD','Dólares','Dólares')
,(3,'EUR','EURO','Euros')
;

-- -----------------------------------------------------
-- CARGO INICIAL
-- -----------------------------------------------------
INSERT INTO cargo(id_cargo,concepto,cargo,fecha_creacion,ultima_modificacion)
VALUES(1,'cargo inicial',100000.00,'0000-00-00','0000-00-00')
;

-- -----------------------------------------------------
-- CATALOGO DE FRECUENCIA DE APOOYOS
-- -----------------------------------------------------
INSERT INTO frecuencia_apoyo(id_frecuencia_apoyo,nombre)
VALUES(1,'unico')
,(2,'semanal')
,(3,'quincenal')
,(4,'mensual')
,(5,'bimestral')
,(6,'anual')
;

-- -----------------------------------------------------
-- CATALOGO DE PAISES
-- -----------------------------------------------------

-- -----------------------------------------------------
-- CATALOGO DE ESTADOS
-- -----------------------------------------------------
