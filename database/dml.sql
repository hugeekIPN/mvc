
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
VALUES(1,"Ciudad de México",1);

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
VALUES (2
	,"nuevo apoyo"
	,"123folio"
	,"123referencia"
	,1 -- proveedor
	,1 -- frecuencia
	,1 -- estado
	,1 -- moneda
	,1 -- evento
	);
