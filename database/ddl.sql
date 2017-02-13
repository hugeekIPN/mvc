-- MySQL Script generated by MySQL Workbench
-- 02/02/17 13:47:31
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sgi
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sgi
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sgi` DEFAULT CHARACTER SET utf8 ;
USE `sgi` ;

-- -----------------------------------------------------
-- Table `sgi`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`usuarios` ;

CREATE TABLE IF NOT EXISTS `sgi`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(250) NULL,
  `nombre` VARCHAR(200) NULL,
  `password` VARCHAR(250) NOT NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_usuario`));


-- -----------------------------------------------------
-- Table `sgi`.`proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`proveedores` ;

CREATE TABLE IF NOT EXISTS `sgi`.`proveedores` (
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
-- Table `sgi`.`especies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`especies` ;

CREATE TABLE IF NOT EXISTS `sgi`.`especies` (
  `id_especie` INT NOT NULL,
  `descripcion` VARCHAR(255) NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_especie`));


-- -----------------------------------------------------
-- Table `sgi`.`programas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`programas` ;

CREATE TABLE IF NOT EXISTS `sgi`.`programas` (
  `id_programa` INT AUTO_INCREMENT,
  `nombre` VARCHAR(250) NULL,
  `descripcion` VARCHAR(250) NULL,
  `estado` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_programa`));


-- -----------------------------------------------------
-- Table `sgi`.`subprogramas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`subprogramas` ;

CREATE TABLE IF NOT EXISTS `sgi`.`subprogramas` (
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
    REFERENCES `sgi`.`programas` (`id_programa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `sgi`.`eventos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`eventos` ;

CREATE TABLE IF NOT EXISTS `sgi`.`eventos` (
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
    REFERENCES `sgi`.`subprogramas` (`id_subprograma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `sgi`.`apoyosgastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`apoyosgastos` ;

CREATE TABLE IF NOT EXISTS `sgi`.`apoyosgastos` (
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
    REFERENCES `sgi`.`especies` (`id_especie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_apoyos-gastos_eventos1`
    FOREIGN KEY (`eventos_id_evento`)
    REFERENCES `sgi`.`eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `sgi`.`proveedores_apoyos-gastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`proveedores_apoyos-gastos` ;

CREATE TABLE IF NOT EXISTS `sgi`.`proveedores_apoyos-gastos` (
  `proveedores_id_donatario` INT NOT NULL,
  `apoyos-gastos_id_apoyo-gasto` INT NOT NULL,
  `tipo_transaccion` VARCHAR(4) NULL COMMENT 'Refiere si es proveedor o donatario\n',
  PRIMARY KEY (`proveedores_id_donatario`, `apoyos-gastos_id_apoyo-gasto`),
  INDEX `fk_proovedores_has_apoyos_apoyos1_idx` (`apoyos-gastos_id_apoyo-gasto` ASC),
  INDEX `fk_proovedores_has_apoyos_proovedores1_idx` (`proveedores_id_donatario` ASC),
  CONSTRAINT `fk_proovedores_has_apoyos_proovedores1`
    FOREIGN KEY (`proveedores_id_donatario`)
    REFERENCES `sgi`.`proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_proovedores_has_apoyos_apoyos1`
    FOREIGN KEY (`apoyos-gastos_id_apoyo-gasto`)
    REFERENCES `sgi`.`apoyosgastos` (`id_apoyo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `sgi`.`referencias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`referencias` ;

CREATE TABLE IF NOT EXISTS `sgi`.`referencias` (
  `id_referencia` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(250) NULL,
  `fecha_creacion` DATETIME NULL,
  `ultima_modificacion` TIMESTAMP NULL,
  PRIMARY KEY (`id_referencia`));


-- -----------------------------------------------------
-- Table `sgi`.`referencias_has_apoyosgastos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sgi`.`referencias_has_apoyosgastos` ;

CREATE TABLE IF NOT EXISTS `sgi`.`referencias_has_apoyosgastos` (
  `referencias_id_referencia` INT NOT NULL,
  `apoyosgastos_id_apoyo` INT NOT NULL,
  PRIMARY KEY (`referencias_id_referencia`, `apoyosgastos_id_apoyo`),
  INDEX `fk_referencias_has_apoyosgastos_apoyosgastos1_idx` (`apoyosgastos_id_apoyo` ASC),
  INDEX `fk_referencias_has_apoyosgastos_referencias1_idx` (`referencias_id_referencia` ASC),
  CONSTRAINT `fk_referencias_has_apoyosgastos_referencias1`
    FOREIGN KEY (`referencias_id_referencia`)
    REFERENCES `sgi`.`referencias` (`id_referencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_referencias_has_apoyosgastos_apoyosgastos1`
    FOREIGN KEY (`apoyosgastos_id_apoyo`)
    REFERENCES `sgi`.`apoyosgastos` (`id_apoyo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

USE `sgi` ;

-- -----------------------------------------------------
-- Placeholder table for view `sgi`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgi`.`view1` (`id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sgi`.`view2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgi`.`view2` (`id` INT);

-- -----------------------------------------------------
-- Placeholder table for view `sgi`.`view3`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sgi`.`view3` (`id` INT);

-- -----------------------------------------------------
-- View `sgi`.`view1`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sgi`.`view1` ;
DROP TABLE IF EXISTS `sgi`.`view1`;
USE `sgi`;


-- -----------------------------------------------------
-- View `sgi`.`view2`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sgi`.`view2` ;
DROP TABLE IF EXISTS `sgi`.`view2`;
USE `sgi`;


-- -----------------------------------------------------
-- View `sgi`.`view3`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `sgi`.`view3` ;
DROP TABLE IF EXISTS `sgi`.`view3`;
USE `sgi`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


