

--  MYSQL CONNECTION

-- Para conectarse desde consola.
-- mysql -hotmaa16c1i9nwrek.cbetxkdyhwsb.us-east-1.rds.amazonaws.com -uy8fov3ok27xmfm0d -povh9qhskodzi5hj9 ubecyl5k9bukhqtd

DROP TABLE IF EXISTS `proveedores_apoyos-gastos`;
DROP TABLE IF EXISTS cargo;
DROP TABLE IF EXISTS archivos;
DROP TABLE IF EXISTS `apoyosgastos` ;
DROP TABLE IF EXISTS saldo;
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
-- Table saldo
-- -----------------------------------------------------
DROP TABLE IF EXISTS saldo;

CREATE TABLE IF NOT EXISTS saldo
(
  id_saldo INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,saldo DECIMAL(11,2)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  ,PRIMARY KEY (id_saldo)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;



-- -----------------------------------------------------
-- Table `apoyosgastos`
-- estatus: 
--      1 activo
--      2 en espera
--      3 cancelado
--      4 finalizado
-- -----------------------------------------------------
DROP TABLE IF EXISTS `apoyosgastos` ;

CREATE TABLE IF NOT EXISTS `apoyosgastos` (
  `id_apoyo` INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,`tipo` TINYINT DEFAULT 1 COMMENT '1-Apoyo\n2-Gasto\n'
  ,`estatus` TINYINT DEFAULT 1  COMMENT  '1 activo, 2 cancelado'
  ,`concepto` VARCHAR(512)
  ,`importe` DECIMAL(11,2) DEFAULT 0
  ,`importe_ext` DECIMAL(11,2) DEFAULT 0
  ,`moneda` TINYINT DEFAULT 1 COMMENT '1 mn 2 usd 3 euros'
  ,`tipo_cambio` DECIMAL(11,2) DEFAULT 0
  ,`id_saldo` INT UNSIGNED NOT NULL

  -- campos de captura apoyo
  ,`folio` VARCHAR(255) NULL COMMENT 'Folio asignado internamente por el usuario\n'
  ,`frecuencia` TINYINT DEFAULT 1 COMMENT '1 unico 2 semanal 3 quincenal 4 mensual 5 bimestral 6 anual'
  ,`id_especie` INT UNSIGNED 
  ,`id_proveedor` INT UNSIGNED 
  ,`id_donatario` INT UNSIGNED 
  ,`tipo_apoyo` TINYINT DEFAULT 1 COMMENT '1 importe 2 especie'
  ,`id_evento` INT UNSIGNED
  ,`pais` VARCHAR(45) NULL
  ,`entidad` VARCHAR(45) NULL
  ,`observaciones` VARCHAR(512)
  ,`factura` VARCHAR(32)
  ,`referencia` VARCHAR(32)  
  ,`cantidad` INT NULL 
  ,`unidad` VARCHAR(45) NULL COMMENT 'Unidad en la que se cuantificará el apoyo\n'
  ,`anio` INT NULL  
  ,`fecha_recibo` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`fecha_cambio` DATETIME DEFAULT CURRENT_TIMESTAMP -- fecha tipo de cambio
  ,`fecha_ref` DATETIME DEFAULT CURRENT_TIMESTAMP

  -- campos libreta flujo
  ,`mes_contabel_libretaflujo` VARCHAR(16)
  ,`fecha_docto_salida` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`docto_salida` VARCHAR(64)
  ,`poliza` VARCHAR(32)  
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  ,PRIMARY KEY (`id_apoyo`)
  ,CONSTRAINT `fk_apoyo_proveedor`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_apoyo_especies`
    FOREIGN KEY (`id_especie`)
    REFERENCES `especies` (`id_especie`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_apoyo_donatario`
    FOREIGN KEY (`id_donatario`)
    REFERENCES `proveedores` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_apoyo_saldo`
    FOREIGN KEY (`id_saldo`)
    REFERENCES `saldo`(`id_saldo`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
  ,CONSTRAINT `fk_apoyo_eventos`
    FOREIGN KEY (`id_evento`)
    REFERENCES `eventos` (`id_evento`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
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
-- Table archivos
-- -----------------------------------------------------
DROP TABLE IF EXISTS archivos;

CREATE TABLE IF NOT EXISTS archivos
(
  id_archivos INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,id_apoyo_gasto INT UNSIGNED NOT NULL
  ,pdf VARCHAR(512)
  ,xml VARCHAR(512)
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  ,PRIMARY KEY(id_archivos)
  ,CONSTRAINT `fk_archivos_apoyos`
    FOREIGN KEY(`id_apoyo_gasto`)
    REFERENCES `apoyosgastos` (`id_apoyo`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table cargo
-- -----------------------------------------------------
DROP TABLE IF EXISTS cargo;

CREATE TABLE IF NOT EXISTS cargo
(
  id_cargo INT UNSIGNED NOT NULL AUTO_INCREMENT
  ,mes_contable VARCHAR(16)
  ,fecha_docto_salida DATETIME DEFAULT CURRENT_TIMESTAMP
  ,docto_salida VARCHAR(64)
  ,concepto VARCHAR(512)
  ,cargo DECIMAL(11,2)
  ,id_saldo INT UNSIGNED NOT NULL
  ,`fecha_creacion` DATETIME DEFAULT CURRENT_TIMESTAMP
  ,`ultima_modificacion` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
  ,PRIMARY KEY(id_cargo)
  ,CONSTRAINT `fk_cargo_saldo`
    FOREIGN KEY(`id_saldo`)
    REFERENCES  `saldo` (`id_saldo`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;
