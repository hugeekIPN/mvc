--  MYSQL CONNECTION

-- Para conectarse desde consola.
-- mysql -hotmaa16c1i9nwrek.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -uy8fov3ok27xmfm0d -povh9qhskodzi5hj9 ubecyl5k9bukhqtd


DROP TABLE IF EXISTS `usuarios` ;
DROP TABLE IF EXISTS `especie_apoyo` ;
DROP TABLE IF EXISTS `unidades`;
DROP TABLE IF EXISTS `documento_salida`;
DROP TABLE IF EXISTS `apoyosgastos` ;
DROP TABLE IF EXISTS `frecuencia_apoyo` ;
DROP TABLE IF EXISTS `cuenta_bancaria` ;
DROP TABLE IF EXISTS `proveedores` ;
DROP TABLE IF EXISTS `eventos` ;
DROP TABLE IF EXISTS `subprogramas` ;
DROP TABLE IF EXISTS `programas`; 
DROP TABLE IF EXISTS `especies` ;
DROP TABLE IF EXISTS cargo;
DROP TABLE IF EXISTS moneda;
DROP TABLE IF EXISTS estado;
DROP TABLE IF EXISTS pais;



-- -----------------------------------------------------
-- CATALOGO DE PAISES
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pais`(
  id_pais INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,nombre VARCHAR(64)
  ,acronimo VARCHAR(8)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY(id_pais)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- CATALOGO DE ESTADOS PERTENECIENTES A UN PAIS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS estado (
  id_estado INT UNSIGNED NOT NULL AUTO_INCREMENT  
  ,nombre VARCHAR (64)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,id_pais INT UNSIGNED NOT NULL
  ,PRIMARY KEY(id_estado)
  ,CONSTRAINT `fk_estado_pais`
    FOREIGN KEY (`id_pais`)
    REFERENCES `pais` (`id_pais`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- CATALOGO DE MONEDAS POR NACIONALIDAD. MXN, USD, EURO
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS moneda(
  id_moneda INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,acronimo VARCHAR(8) NOT NULL
  ,nombre VARCHAR(32) NOT NULL
  ,descripcion VARCHAR(128)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  ,PRIMARY KEY(id_moneda)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- DEPOSITOS DE DINERO PARA GASTAR EN APOYOS Y GASTOS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS cargo
(
  id_cargo INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,mes_contable VARCHAR(16)
  ,fecha_docto_salida DATETIME DEFAULT CURRENT_TIMESTAMP
  ,id_documento_salida INT UNSIGNED
  ,concepto VARCHAR(512)
  ,cargo DECIMAL(11,2)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  ,PRIMARY KEY(id_cargo)
  ,CONSTRAINT `fk_docto_salida_cargo`
    FOREIGN KEY (`id_documento_salida`)
    REFERENCES `documento_salida` (`id_documento_salida`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- CATALOGO DE ESPECIES
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `especies` (
  `id_especie`  INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`descripcion` VARCHAR(512)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_especie`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- CATALOGO DE PROGRAMAS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programas` (
  `id_programa` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`nombre` VARCHAR(128)
  ,`descripcion` VARCHAR(512)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_programa`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- CATALOGO DE SUBPROGRAMAS -> PROGRAMAS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `subprogramas` (
  `id_subprograma` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`programas_id_programa` INT UNSIGNED NOT NULL
  ,`nombre` VARCHAR(128)
  ,`descripcion` VARCHAR(512)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_subprograma`)  
  ,CONSTRAINT `fk_subprogramas_programas1`
    FOREIGN KEY (`programas_id_programa`)
    REFERENCES `programas` (`id_programa`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- CATALOGO DE EVENTOS -> SUBPROGRAMAS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`nombre` VARCHAR(128)
  ,`subprogramas_idsubprogramas` INT UNSIGNED NOT NULL
  ,`descripcion` VARCHAR(512)
  ,id_estado INT UNSIGNED
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_evento`)  
  ,CONSTRAINT `fk_eventos_subprogramas1`
    FOREIGN KEY (`subprogramas_idsubprogramas`)
    REFERENCES `subprogramas` (`id_subprograma`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- CATALOGO DE PROVEEDORES
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor`  INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`razon_social` VARCHAR(128)  
  ,`rfc` VARCHAR(32)
  ,`telefono` VARCHAR(16)
  ,`calle` VARCHAR(255)
  ,`colonia` VARCHAR(255)
  ,`cp` VARCHAR(5)
  ,`delegacion` VARCHAR(128) 
  ,`tipo` TINYINT(1) DEFAULT 0 COMMENT '0- Proveedor\n1- Donatario\n'
  ,`contacto` VARCHAR(128) NULL
  ,`correo_contacto` VARCHAR(128) NULL
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,id_estado INT UNSIGNED
  ,PRIMARY KEY (`id_proveedor`)
  ,CONSTRAINT `fk_proveedores_estado`
    FOREIGN KEY (`id_estado`)
    REFERENCES `estado` (`id_estado`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
  )ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- CUENTAS BANCARIAS ASOCIADAS A UN PROVEEDOR
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cuenta_bancaria` (
  id_cuenta INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`clabe` VARCHAR(18)
  ,`cuenta` VARCHAR(11)
  ,`referencia` VARCHAR(250)
  ,`banco` VARCHAR(128)--
  ,`sucursal` VARCHAR(128)
  ,`plaza` VARCHAR(128)
  ,`id_proveedor`  INT UNSIGNED NOT NULL
  ,PRIMARY KEY(id_cuenta)
  ,CONSTRAINT `fk_cuenta_proveedor`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `proveedores` (`id_proveedor`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
  )ENGINE=InnoDB  DEFAULT CHARSET=utf8;



-- -----------------------------------------------------
-- CATALOGO DE FRECUENCIAS EN LAS QUE SE HACE UN APOYO
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `frecuencia_apoyo` (
  `id_frecuencia_apoyo` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,nombre VARCHAR(32) NOT NULL
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_frecuencia_apoyo`)  
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- DOCUMENTO DE SALIDA
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `documento_salida`(
  `id_documento_salida` INT UNSIGNED NOT NULL
  ,`nombre` VARCHAR(32)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  , PRIMARY KEY(`id_documento_salida`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- TABLA PARA REGISTRAR UN APOYO
-- ----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apoyosgastos` (
  `id_apoyo` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`categoria` TINYINT(1) DEFAULT 0 COMMENT '0-Apoyo\n1-Gasto\n'
  ,`estatus` TINYINT(1) DEFAULT 0  COMMENT  '0 activo, 1 cancelado'
  ,`concepto` VARCHAR(512)
  ,`importe` DECIMAL(11,2) DEFAULT 0
  ,`tipo_cambio` DECIMAL(11,2) DEFAULT 1
  -- ,`folio` VARCHAR(16) NULL COMMENT 'folio automatico,\n' (El folio es el id)
  ,`observaciones` VARCHAR(512)
  ,`referencia` VARCHAR(32)  COMMENT 'numero de referencia'
  -- campos libreta flujo
  ,`mes_contable` VARCHAR(16)
  ,`poliza` VARCHAR(32)

  ,`fecha_referencia` DATE DEFAULT NULL
  ,`fecha_docto_salida` DATE DEFAULT NULL
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`fecha_cambio` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP    

  -- llaves foraneas
  ,`id_proveedor` INT UNSIGNED COMMENT 'aplica para proveedor y donatario'
  ,id_documento_salida INT UNSIGNED
  ,id_frecuencia_apoyo INT UNSIGNED NOT NULL
  ,id_estado INT UNSIGNED NOT NULL
  ,`id_moneda` INT UNSIGNED NOT NULL COMMENT '0 mn 1 usd 2 euros'
  ,`id_evento` INT UNSIGNED NOT NULL
  ,PRIMARY KEY (`id_apoyo`)
  ,CONSTRAINT `fk_docto_salida`
    FOREIGN KEY (`id_documento_salida`)
    REFERENCES `documento_salida` (`id_documento_salida`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_apoyo_proveedor`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_frecuencia_apoyo`
    FOREIGN KEY (`id_frecuencia_apoyo`)
    REFERENCES `frecuencia_apoyo` (`id_frecuencia_apoyo`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_estado_apoyo`
    FOREIGN KEY (`id_estado`)
    REFERENCES `estado` (`id_estado`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_moneda_apoyo`
    FOREIGN KEY (`id_moneda`)
    REFERENCES `moneda` (`id_moneda`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_evento_apoyo`
    FOREIGN KEY (`id_evento`)
    REFERENCES `eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- UNIDADES PARA ESPECIES
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unidades`(
  id_unidad INT NOT NULL PRIMARY KEY AUTO_INCREMENT
  ,nombre VARCHAR(32)
);

-- -----------------------------------------------------
-- RELACION DE ESPECIE Y APOYOS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `especie_apoyo` (
  `id_apoyo` INT UNSIGNED NOT NULL 
  ,id_especie INT UNSIGNED NOT NULL
  ,`cantidad` INT NULL 
  ,`id_unidad` INT NOT NULL
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_apoyo`)
  ,CONSTRAINT `fk_unidad`
    FOREIGN KEY (`id_unidad`)
    REFERENCES `unidades`(`id_unidad`)
  ,CONSTRAINT `fk_apoyo`
    FOREIGN KEY (`id_apoyo`)
    REFERENCES `apoyosgastos`(`id_apoyo`)  
  ,CONSTRAINT `fk_especie_apoyo`
    FOREIGN KEY (`id_especie`)
    REFERENCES `especies` (`id_especie`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`email` VARCHAR(128)
  ,`nombre` VARCHAR(64)
  ,`password` VARCHAR(32) NOT NULL
  ,`estatus` TINYINT(1) DEFAULT 0 COMMENT '0 acctivo' 
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_usuario`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Funciones
-- -----------------------------------------------------


/**
* Obtiene en string el status
**/
DROP FUNCTION IF EXISTS estatus;
DELIMITER //
CREATE FUNCTION estatus(n TINYINT(1))
  RETURNS VARCHAR(9)
  BEGIN
    DECLARE s VARCHAR(9) DEFAULT 'Activo';
    IF  n=1 THEN SET s = 'Cancelado';   
    END IF;
    RETURN s;
  END //
DELIMITER ;

/**
* Obtiene el importe*tipo_cambio
* Representa el importe real
**/
DROP FUNCTION IF EXISTS importe;
DELIMITER //
CREATE FUNCTION importe(n DECIMAL(11,2), tipoCambio DECIMAL(11,2))
  RETURNS DECIMAL(11,2)
  BEGIN    
    RETURN n*tipoCambio;
  END //
DELIMITER ;


/**
* Obtiene una cadena corta si la longitud de la misma excede los 50 caracteres
**/
DROP FUNCTION IF EXISTS textoCorto;
DELIMITER //
CREATE FUNCTION textoCorto(s VARCHAR(512))
  RETURNS VARCHAR(50)
  BEGIN    
    DECLARE temp VARCHAR(50) DEFAULT s;
    IF LENGTH(s)>50 THEN
      SET temp = CONCAT(SUBSTR(s,1,40),'...',SUBSTR(s,-7,7));
    END IF;
    RETURN temp;
  END //
DELIMITER ;


/**
** Obtiene el saldo actual
**/
DROP FUNCTION IF EXISTS saldo;
DELIMITER //
CREATE FUNCTION saldo()
  RETURNS DECIMAL(11,2)
  BEGIN
  DECLARE temp DECIMAL(11,2) DEFAULT 0;
    SET temp = (select sum(cargo) - (select sum(importe(importe,tipo_cambio)) from apoyosgastos) from cargo);
    RETURN temp;
  END //
DELIMITER ;