

--  MYSQL CONNECTION

-- Para conectarse desde consola.
-- mysql -hotmaa16c1i9nwrek.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -uy8fov3ok27xmfm0d -povh9qhskodzi5hj9 ubecyl5k9bukhqtd


-- -----------------------------------------------------
-- Table `usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `usuarios` ;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(250) NULL,
  `nombre` VARCHAR(200) NULL,
  `password` VARCHAR(250) NOT NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_usuario`));


-- -----------------------------------------------------
-- Table `proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `proveedores` ;

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` INT NOT NULL AUTO_INCREMENT,
  `razon_social` VARCHAR(250) NULL,
  `referencia` VARCHAR(250) NULL,
  `cuenta` VARCHAR(250) NULL,
  `banco` VARCHAR(250) NULL,
  `sucursal` VARCHAR(250) NULL,
  `plaza` VARCHAR(250) NULL,
  `rfc` VARCHAR(250) NULL,
  `telefono` VARCHAR(250) NULL,
  `calle` VARCHAR(250) NULL,
  `colonia` VARCHAR(250) NULL,
  `cp` VARCHAR(250) NULL,
  `delegacion` VARCHAR(250) NULL,
  `pais` VARCHAR(250) NULL,
  `entidad` VARCHAR(250) NULL,
  `tipo` VARCHAR(2) NULL COMMENT '1- Proveedor\n2- Donatario\n',
  `contacto` VARCHAR(250) NULL,
  `correo_contacto` VARCHAR(250) NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_proveedor`));


-- -----------------------------------------------------
-- Table `especies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `especies` ;

CREATE TABLE IF NOT EXISTS `especies` (
  `id_especie` INT AUTO_INCREMENT,
  `descripcion` VARCHAR(255) NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_especie`));
-- -----------------------------------------------------
-- Table `captura`
-- -----------------------------------------------------

Create Table If Not Exists `captura`(
`idCaptura` int Not Null Primary Key Auto_Increment,
`mesContable` varchar(250) Not Null,
`referencia` int Not Null,
`fecha_docSalida` date Not Null,
`docSalida` varchar(250) Not Null,
`concepto` varchar(250) Not Null,
`cargo` Double Not Null,
`saldo` Double Not Null,
`fecha_creacion` DATETIME Null,
`ultima_modi` TIMESTAMP Null
);

-- -----------------------------------------------------
--ALTER TABLE tablename AUTO_INCREMENT = 1;
-- -----------------------------------------------------



-- -----------------------------------------------------
-- Table `programas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `programas` ;

CREATE TABLE IF NOT EXISTS `programas` (
  `id_programa` INT AUTO_INCREMENT,
  `nombre` VARCHAR(250) NULL,
  `descripcion` VARCHAR(250) NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_programa`));


-- -----------------------------------------------------
-- Table `subprogramas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `subprogramas` ;

CREATE TABLE IF NOT EXISTS `subprogramas` (
  `id_subprograma` INT AUTO_INCREMENT,
  `programas_id_programa` INT NOT NULL,
  `nombre` VARCHAR(250) NULL,
  `descripcion` VARCHAR(250) NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_subprograma`),
  INDEX `fk_subprogramas_programas1_idx` (`programas_id_programa` ASC),
  CONSTRAINT `fk_subprogramas_programas1`
    FOREIGN KEY (`programas_id_programa`)
    REFERENCES `programas` (`id_programa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `eventos` ;

CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(250) CHARACTER SET 'big5' NULL,
  `subprogramas_idsubprogramas` INT NOT NULL,
  `descripcion` VARCHAR(250) NULL,
  `pais` VARCHAR(250) NULL,
  `ciudad` VARCHAR(250) NULL,
  `entidad` VARCHAR(250) NULL,
  `estado` INT NULL,
  `fecha_inicio` DATETIME NULL,
  `fecha_fin` DATETIME NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_evento`),
  INDEX `fk_eventos_subprogramas1_idx` (`subprogramas_idsubprogramas` ASC),
  CONSTRAINT `fk_eventos_subprogramas1`
    FOREIGN KEY (`subprogramas_idsubprogramas`)
    REFERENCES `subprogramas` (`id_subprograma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `apoyosgastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `apoyosgastos` ;

CREATE TABLE IF NOT EXISTS `apoyosgastos` (
  `id_apoyo` INT NOT NULL AUTO_INCREMENT,
  `apoyo-gasto` CHAR(2) NULL COMMENT '1-Apoyo\n2-Gasto\n',
  `especies_id_especie` INT NULL,
  `anio` INT NULL,
  `folio` VARCHAR(255) NULL COMMENT 'Folio asignado internamente por el usuario\n',
  `tipo` CHAR(2) NULL COMMENT '1-Dinero\n2-Especie\n',
  `cantidad` FLOAT NULL,
  `unidad` VARCHAR(45) NULL COMMENT 'Unidad en la que se cuantificará el apoyo\n',
  `pais` VARCHAR(45) NULL,
  `entidad` VARCHAR(45) NULL,
  `descripcion` VARCHAR(45) NULL,
  `moneda` CHAR(2) NULL,
  `tipo_cambio` VARCHAR(45) NULL,
  `fcambio` DATE NULL,
  `freferencia` DATE NULL,
  `fcaptura` DATE NULL,
  `observaciones` VARCHAR(255) NULL,
  `frecuencia` INT NULL,
  `eventos_id_evento` INT NOT NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_apoyo`),
  INDEX `fk_apoyos-gastos_especies1_idx` (`especies_id_especie` ASC),
  INDEX `fk_apoyos-gastos_eventos1_idx` (`eventos_id_evento` ASC),
  CONSTRAINT `fk_apoyos-gastos_especies1`
    FOREIGN KEY (`especies_id_especie`)
    REFERENCES `especies` (`id_especie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apoyos-gastos_eventos1`
    FOREIGN KEY (`eventos_id_evento`)
    REFERENCES `eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);


-- -----------------------------------------------------
-- Table `proveedores_apoyos-gastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `proveedores_apoyos-gastos` ;

CREATE TABLE IF NOT EXISTS `proveedores_apoyos-gastos` (
  `proveedores_id_donatario` INT NOT NULL,
  `apoyos-gastos_id_apoyo-gasto` INT NOT NULL,
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
);


