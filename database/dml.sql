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
VALUES(1,"México","MX")
,(2,"Estados Unidos","EE.UU.");
-- -----------------------------------------------------
-- CATALOGO DE ESTADOS
-- -----------------------------------------------------
INSERT INTO estado(nombre,id_pais)
VALUES ("Aguascalientes",1),
("Baja California",1),
("Baja California Sur",1),
("Campeche",1),
("Chiapas",1),
("Chihuahua",1),
("Coahuila",1),
("Colima",1),
("Ciudad de México",1),
("Durango",1),
("Estado de México",1),
("Guanajuato",1),
("Guerrero",1),
("Hidalgo",1),
("Jalisco",1),
("Michoacán",1),
("Morelos",1),
("Nayarit",1),
("Nuevo León",1),
("Oaxaca",1),
("Puebla",1),
("Querétaro",1),
("Quintana Roo",1),
("San Luis Potosí",1),
("Sinaloa",1),
("Sonora",1),
("Tabasco",1),
("Tamaulipas",1),
("Tlaxcala",1),
("Veracruz",1),
("Yucatán",1),
("Zacatecas",1),
-- ESTADOS UNIDOS --
("Alabama",2),
("Alaska",2),
("Arizona",2),
("Arkansas",2),
("California",2),
("Carolina del Norte",2),
("Carolina del Sur",2),
("Colorado",2),
("Connecticut",2),
("Dakota del Norte",2),
("Dakota del Sur",2),
("Delaware",2),
("Florida",2),
("Georgia",2),
("Hawaii",2),
("Idaho",2),
("Illinois",2),
("Indiana",2),
("Iowa",2),
("Kansas",2),
("Kentucky",2),
("Louisiana",2),
("Maine",2),
("Maryland",2),
("Massachusetts",2),
("Míchigan",2),
("Minnesota",2),
("Misisipi",2),
("Misuri",2),
("Montana",2),
("Nebraska",2),
("Nevada",2),
("Nueva Jersey",2),
("Nueva York",2),
("Nuevo Hampshire",2),
("Nuevo México",2),
("Ohio",2),
("Oklahoma",2),
("Oregón",2),
("Pensilvania",2),
("Rhode Island",2),
("Tennessee",2),
("Texas",2),
("Utah",2),
("Vermont",2),
("Virginia",2),
("Virginia Occidental",2),
("Washington",2),
("Wisconsin",2),
("Wyoming",2);
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
-- DONATOARIOS solo son de prueba
-- -----------------------------------------------------
INSERT INTO proveedores(id_proveedor,razon_social,rfc,telefono,tipo)
VALUES(4,"donador ACADEMIA DE MUSICA DEL PALACIO DE MINERIA, A.C.","AMP850419U45","55109821",1)
,(5,"donador GRUPO ZAMACONA, S.A. DE C.V.","unrfc","1234567890",1)
,(6,"donador de pruebaHIM IMPLANTES COCLEARES","00133009914","1234567890",1);

-- -----------------------------------------------------
-- UNIDADES
-- -----------------------------------------------------
INSERT INTO unidades(id_unidad,nombre)
VALUES(1,"bolsa")
,(2,"caja")
,(3,"gr")
,(4,"kg")
,(5,"lts")
,(6,"pza")
,(7,"ton");

-- -----------------------------------------------------
-- APOYOS
-- -----------------------------------------------------
INSERT INTO apoyosgastos(id_apoyo,concepto,referencia,id_proveedor,id_frecuencia_apoyo,id_estado,id_moneda,id_evento)
VALUES (1
	,"Suministro gasolina vehículo programa de conservación mariposa monarca"	
	,"123referencia"
	,1 -- proveedor
	,1 -- frecuencia
	,1 -- estado
	,1 -- moneda
	,1 -- evento
	);
INSERT INTO apoyosgastos(id_apoyo,concepto,referencia,id_proveedor,id_frecuencia_apoyo,id_estado,id_moneda,id_evento)
VALUES (2
	,"Donativo en efectivo para apoyo al 20 movimiento azteca"	
	,"123referencia"
	,2 -- proveedor
	,2 -- frecuencia
	,1 -- estado
	,1 -- moneda
	,1 -- evento
	);

INSERT INTO apoyosgastos(id_apoyo,concepto,referencia,id_proveedor,id_frecuencia_apoyo,id_estado,id_moneda,id_evento)
VALUES (3
	,"Saldo honorarios por la emisión de dictamenes del imss e infonavit 2003"	
	,"123referencia"
	,3 -- proveedor
	,1 -- frecuencia
	,1 -- estado
	,1 -- moneda
	,1 -- evento
	);

-- -----------------------------------------------------
-- ESPECIES
-- -----------------------------------------------------
INSERT INTO especies(id_especie,descripcion)
VALUES(1,"Agua botella de 1.5 lts.")
,(2,"Alimentos")
,(3,"Vestidos")
,(8,"Mantas")
,(13,"Medicamentos")
,(14,"Computadoras")
,(15,"Lentes")
,(16,"Bicicletas")
,(18,"Gasolina")
,(20,"Colchonetas")
,(21,"Hamacas")
,(22,"Impresoras")
,(23,"Sabanas")
,(24,"Toallas")
,(25,"Cobertores")
,(26,"Teléfonos celulares")
,(27,"Archiveros")
,(28,"Escritorios")
,(29,"Sillas")
,(30,"Sillones")
,(31,"Catres")
,(32,"Conmutador");

-- -----------------------------------------------------
-- RELACION APOYO CON ESPECIE
-- -----------------------------------------------------
INSERT INTO especie_apoyo(id_apoyo,id_especie,cantidad,id_unidad)
VALUES(1,1,10,2);