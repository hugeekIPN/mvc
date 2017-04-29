

--  MYSQL CONNECTION

-- Para conectarse desde consola.
-- mysql -hotmaa16c1i9nwrek.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -uy8fov3ok27xmfm0d -povh9qhskodzi5hj9 ubecyl5k9bukhqtd

DROP TABLE IF EXISTS `proveedores_apoyos-gastos`;
DROP TABLE IF EXISTS `apoyosgastos` ;
DROP TABLE IF EXISTS `eventos` ;
DROP TABLE IF EXISTS `subprogramas` ;
DROP TABLE IF EXISTS `programas` ;
DROP TABLE IF EXISTS `especies` ;
DROP TABLE IF EXISTS `proveedores` ;
DROP TABLE IF EXISTS `usuarios` ;

-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`email` VARCHAR(128)
  ,`nombre` VARCHAR(64)
  ,`password` VARCHAR(32) NOT NULL
  ,`estado` TINYINT NULL
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_usuario`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `proveedores` ;

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor`  INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`razon_social` VARCHAR(32)
  ,`referencia` VARCHAR(250)
  ,`cuenta` VARCHAR(64)
  ,`banco` VARCHAR(128)
  ,`sucursal` VARCHAR(128)
  ,`plaza` VARCHAR(128)
  ,`rfc` VARCHAR(32)
  ,`telefono` VARCHAR(16)
  ,`calle` VARCHAR(255)
  ,`colonia` VARCHAR(255)
  ,`cp` VARCHAR(5)
  ,`delegacion` VARCHAR(128)
  ,`pais` VARCHAR(128)
  ,`entidad` VARCHAR(250)
  ,`tipo` TINYINT DEFAULT 0 COMMENT '1- Proveedor\n2- Donatario\n'
  ,`contacto` VARCHAR(128) NULL
  ,`correo_contacto` VARCHAR(128) NULL
  ,`estado` TINYINT
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_proveedor`)
  )ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `especies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `especies` ;

CREATE TABLE IF NOT EXISTS `especies` (
  `id_especie`  INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`descripcion` VARCHAR(512) 
  ,`estado` TINYINT
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_especie`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `programas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `programas` ;

CREATE TABLE IF NOT EXISTS `programas` (
  `id_programa` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`nombre` VARCHAR(128)
  ,`descripcion` VARCHAR(512)
  ,`estado` TINYINT
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  ,PRIMARY KEY (`id_programa`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `subprogramas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subprogramas` ;

CREATE TABLE IF NOT EXISTS `subprogramas` (
  `id_subprograma` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`programas_id_programa` INT UNSIGNED NOT NULL
  ,`nombre` VARCHAR(128)
  ,`descripcion` VARCHAR(512)
  ,`estado` TINYINT
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
-- Table `eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `eventos` ;

CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`nombre` VARCHAR(128)
  ,`subprogramas_idsubprogramas` INT UNSIGNED NOT NULL
  ,`descripcion` VARCHAR(512)
  ,`pais` VARCHAR(128)
  ,`ciudad` VARCHAR(128)
  ,`entidad` VARCHAR(128)
  ,`estado` TINYINT
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
-- Table `apoyosgastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `apoyosgastos` ;

CREATE TABLE IF NOT EXISTS `apoyosgastos` (
  `id_apoyo` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`apoyo-gasto` TINYINT DEFAULT 1 COMMENT '1-Apoyo\n2-Gasto\n'
  ,`especies_id_especie` INT UNSIGNED NOT NULL
  ,`anio` INT NULL
  ,`folio` VARCHAR(255) NULL COMMENT 'Folio asignado internamente por el usuario\n'
  ,`tipo` CHAR(2) NULL COMMENT '1-Dinero\n2-Especie\n'
  ,`cantidad` FLOAT NULL
  ,`unidad` VARCHAR(45) NULL COMMENT 'Unidad en la que se cuantificará el apoyo\n'
  ,`pais` VARCHAR(45) NULL
  ,`entidad` VARCHAR(45) NULL
  ,`descripcion` VARCHAR(45) NULL
  ,`moneda` CHAR(2) NULL
  ,`tipo_cambio` VARCHAR(45) NULL
  ,`fcambio` DATE NULL
  ,`freferencia` DATE NULL
  ,`fcaptura` DATE NULL
  ,`observaciones` VARCHAR(255) NULL
  ,`frecuencia` INT NULL
  ,`eventos_id_evento` INT UNSIGNED NOT NULL
  ,`estado` INT NULL
  ,`fecha_creacion` DATETIME NULL
  ,`ultima_modificacion` TIMESTAMP NULL
  ,PRIMARY KEY (`id_apoyo`)
  ,INDEX `fk_apoyos-gastos_especies1_idx` (`especies_id_especie` ASC)
  ,INDEX `fk_apoyos-gastos_eventos1_idx` (`eventos_id_evento` ASC)
  ,CONSTRAINT `fk_apoyos-gastos_especies1`
    FOREIGN KEY (`especies_id_especie`)
    REFERENCES `especies` (`id_especie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apoyos-gastos_eventos1`
    FOREIGN KEY (`eventos_id_evento`)
    REFERENCES `eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `proveedores_apoyos-gastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `proveedores_apoyos-gastos`;

CREATE TABLE IF NOT EXISTS `proveedores_apoyos-gastos` (
  `proveedores_id_donatario`  INT UNSIGNED NOT NULL,
  `apoyos-gastos_id_apoyo-gasto`  INT UNSIGNED NOT NULL,
  `tipo_transaccion` VARCHAR(4) NULL COMMENT 'Refiere si es proveedor o donatario\n',
  PRIMARY KEY (`proveedores_id_donatario`, `apoyos-gastos_id_apoyo-gasto`),
  INDEX `fk_proovedores_has_apoyos_apoyos1_idx` (`apoyos-gastos_id_apoyo-gasto` ASC),
  INDEX `fk_proovedores_has_apoyos_proovedores1_idx` (`proveedores_id_donatario` ASC),
  CONSTRAINT `fk_proovedores_has_apoyos_proovedores1`
    FOREIGN KEY (`proveedores_id_donatario`)
    REFERENCES `proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proovedores_has_apoyos_apoyos1`
    FOREIGN KEY (`apoyos-gastos_id_apoyo-gasto`)
    REFERENCES `apoyosgastos` (`id_apoyo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `captura`
-- -----------------------------------------------------

Create Table If Not Exists `captura`(
  `idCaptura` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`mesContable` varchar(250) Not Null
  ,`referencia` int Not Null
  ,`fecha_docSalida` date Not Null
  ,`docSalida` varchar(250) Not Null
  ,`concepto` varchar(250) Not Null
  ,`cargo` Double Not Null
  ,`saldo` Double Not Null
  ,`fecha_creacion` DATETIME Null
  ,`ultima_modi` TIMESTAMP Null
);