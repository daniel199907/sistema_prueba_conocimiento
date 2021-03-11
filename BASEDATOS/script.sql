-- MySQL Workbench Forward Engineering
-- DANIEL RODRIGUEZ HERRERA
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema inventario
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema inventario
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `inventario` DEFAULT CHARACTER SET utf8 ;
USE `inventario` ;

-- -----------------------------------------------------
-- Table `inventario`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`perfil` (
  `idperfil` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idperfil`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido_paterno` VARCHAR(45) NOT NULL,
  `apellido_materno` VARCHAR(45) NOT NULL,
  `acceso` INT NOT NULL,
  `perfil` INT NOT NULL,
  `usuario` VARCHAR(12) NOT NULL UNIQUE,
  `contrasenia` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idusuario`),
  INDEX `idperfil_idx` (`perfil` ASC) VISIBLE,
  CONSTRAINT `idperfil`
    FOREIGN KEY (`perfil`)
    REFERENCES `inventario`.`perfil` (`idperfil`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`.`visita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`visita` (
  `idvisitas` INT NOT NULL AUTO_INCREMENT,
  `inicio_sesion_fecha` DATE NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idvisitas`),
  INDEX `fk_visita_usuario1_idx` (`usuario_idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_visita_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `inventario`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`estado` (
  `idestados` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idestados`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`.`sucursal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`sucursal` (
  `idsucursal` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idsucursal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `inventario`.`producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventario`.`producto` (
  `idproducto` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(30) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `precio` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `sucursal_idsucursal` INT NOT NULL,
  `categoria_idcategoria` INT NOT NULL,
  `estado_idestados` INT NOT NULL,
  `ultima_modificacion` DATE NULL,
  `comentario` VARCHAR(100) NULL,
  `usuario_idusuario` INT NOT NULL,
  PRIMARY KEY (`idproducto`),
  INDEX `fk_producto_sucursal1_idx` (`sucursal_idsucursal` ASC) VISIBLE,
  INDEX `fk_producto_categoria1_idx` (`categoria_idcategoria` ASC) VISIBLE,
  INDEX `fk_producto_estado1_idx` (`estado_idestados` ASC) VISIBLE,
  INDEX `fk_producto_usuario1_idx` (`usuario_idusuario` ASC) VISIBLE,
  CONSTRAINT `fk_producto_sucursal1`
    FOREIGN KEY (`sucursal_idsucursal`)
    REFERENCES `inventario`.`sucursal` (`idsucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `inventario`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_estado1`
    FOREIGN KEY (`estado_idestados`)
    REFERENCES `inventario`.`estado` (`idestados`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `inventario`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


-- INGRESO DE DATOS A LOS CATÁLOGOS 
INSERT INTO sucursal (descripcion) VALUES ('Cuernavaca');
INSERT INTO sucursal (descripcion) VALUES ('Yautepec');
INSERT INTO sucursal (descripcion) VALUES ('Cuautla');
INSERT INTO sucursal (descripcion) VALUES ('Acapulco');

INSERT INTO categoria (descripcion) VALUES ('Electrónica');
INSERT INTO categoria (descripcion) VALUES ('Línea Blanca');
INSERT INTO categoria (descripcion) VALUES ('Deportes');
INSERT INTO categoria (descripcion) VALUES ('Alimentos');
INSERT INTO categoria (descripcion) VALUES ('Jardín');

INSERT estado (descripcion) VALUES ('Abierto');
INSERT estado (descripcion) VALUES ('Cerrado');

INSERT INTO perfil (descripcion) VALUES ('Capturista');
INSERT INTO perfil (descripcion) VALUES ('Gestor');
INSERT INTO perfil (descripcion) VALUES ('Administrador');


INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, acceso, perfil, usuario, contrasenia)
VALUES ('Daniel', 'Rodriguez', 'Herrera', 1, 1, 'danielherro', 'daniel199907');

INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, acceso, perfil, usuario, contrasenia)
VALUES ('Esmeralda', 'Ramos', 'Rosas', 1, 2, 'esme99', '1234567891');

INSERT INTO usuario (nombre, apellido_paterno, apellido_materno, acceso, perfil, usuario, contrasenia)
VALUES ('Guillermo Alfonso', 'Santander', 'Castro', 1, 3, 'guillermocas', '1234567891' );
