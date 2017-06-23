SET NAMES 'utf8';

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
INSERT INTO pais(id_pais,nombre,acronimo)
VALUES(1,"México","MX");
-- -----------------------------------------------------
-- CATALOGO DE ESTADOS
-- -----------------------------------------------------
INSERT INTO estado(id_estado,nombre,id_pais)
VALUES (1,"Aguascalientes",1),
(2,"Baja California",1),
(3,"Baja California Sur",1),
(4,"Campeche",1),
(5,"Chiapas",1),
(6,"Chihuahua",1),
(7,"Coahuila",1),
(8,"Colima",1),
(9,"Ciudad de México",1),
(10,"Durango",1),
(11,"Estado de México",1),
(12,"Guanajuato",1),
(13,"Guerrero",1),
(14,"Hidalgo",1),
(15,"Jalisco",1),
(16,"Michoacán",1),
(17,"Morelos",1),
(18,"Nayarit",1),
(19,"Nuevo León",1),
(20,"Oaxaca",1),
(21,"Puebla",1),
(22,"Querétaro",1),
(23,"Quintana Roo",1),
(24,"San Luis Potosí",1),
(25,"Sinaloa",1),
(26,"Sonora",1),
(27,"Tabasco",1),
(28,"Tamaulipas",1),
(29,"Tlaxcala",1),
(30,"Veracruz",1),
(31,"Yucatán",1),
(32,"Zacatecas",1);

-- -----------------------------------------------------
-- PROGRAMAS
-- -----------------------------------------------------
INSERT INTO programas(id_programa,nombre,descripcion)
VALUES(1,"programa de prueba","nombre de programa de prueba");

-- -----------------------------------------------------
-- SUBPROGRAMAS
-- -----------------------------------------------------
INSERT INTO subprogramas(id_subprograma,programas_id_programa, nombre,descripcion)
VALUES(1,1,"este es un subprogramas","descripcion del subprograma de prueba");

-- -----------------------------------------------------
-- EVENTOS
-- -----------------------------------------------------
INSERT INTO eventos(id_evento,nombre,subprogramas_idsubprogramas,descripcion)
VALUES(1,"nombre del evento",1,"descripcion del evento");


-- -----------------------------------------------------
-- PROVEEDORES
-- -----------------------------------------------------
INSERT INTO proveedores(id_proveedor,razon_social,rfc,telefono)
VALUES(1,"ACADEMIA DE MUSICA DEL PALACIO DE MINERIA, A.C.","AMP850419U45","55109821")
,(2,"GRUPO ZAMACONA, S.A. DE C.V.","unrfc","1234567890")
,(3,"HIM IMPLANTES COCLEARES","00133009914","1234567890");


-- -----------------------------------------------------
-- APOYOS
-- -----------------------------------------------------
INSERT INTO apoyosgastos(id_apoyo,concepto,folio,referencia,id_proveedor,id_frecuencia_apoyo,id_estado,id_moneda,id_evento)
VALUES (1
	,"Suministro gasolina vehículo programa de conservación mariposa monarca"
	,"123folio"
	,"123referencia"
	,1 -- proveedor
	,1 -- frecuencia
	,1 -- estado
	,1 -- moneda
	,1 -- evento
	);

INSERT INTO apoyosgastos(id_apoyo,concepto,folio,referencia,id_proveedor,id_frecuencia_apoyo,id_estado,id_moneda,id_evento)
VALUES (3
	,"Saldo honorarios por la emisión de dictamenes del imss e infonavit 2003"
	,"123folio"
	,"123referencia"
	,1 -- proveedor
	,1 -- frecuencia
	,1 -- estado
	,1 -- moneda
	,1 -- evento
	);
