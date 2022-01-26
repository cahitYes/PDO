-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema pdo_1
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `pdo_1` ;

-- -----------------------------------------------------
-- Schema pdo_1
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `pdo_1` DEFAULT CHARACTER SET utf8 ;
USE `pdo_1` ;

-- -----------------------------------------------------
-- Table `pdo_1`.`theuser`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pdo_1`.`theuser` ;

CREATE TABLE IF NOT EXISTS `pdo_1`.`theuser` (
  `idtheuser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theuserlogin` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL,
  `theusername` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idtheuser`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `theuserlogin_UNIQUE` ON `pdo_1`.`theuser` (`theuserlogin` ASC);


-- -----------------------------------------------------
-- Table `pdo_1`.`thearticle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pdo_1`.`thearticle` ;

CREATE TABLE IF NOT EXISTS `pdo_1`.`thearticle` (
  `idthearticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thearticletitle` VARCHAR(180) NOT NULL,
  `thearticletext` TEXT NOT NULL,
  `thearticledate` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `theuser_idtheuser` INT UNSIGNED NULL,
  PRIMARY KEY (`idthearticle`),
  CONSTRAINT `fk_thearticle_theuser`
    FOREIGN KEY (`theuser_idtheuser`)
    REFERENCES `pdo_1`.`theuser` (`idtheuser`)
    ON DELETE NO ACTION
    ON UPDATE SET NULL)
ENGINE = InnoDB;

CREATE INDEX `fk_thearticle_theuser_idx` ON `pdo_1`.`thearticle` (`theuser_idtheuser` ASC);


-- -----------------------------------------------------
-- Table `pdo_1`.`thesection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pdo_1`.`thesection` ;

CREATE TABLE IF NOT EXISTS `pdo_1`.`thesection` (
  `idthesection` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `thesectiontitle` VARCHAR(80) NOT NULL,
  `thesectiondesc` VARCHAR(255) NULL,
  PRIMARY KEY (`idthesection`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `thesectiontitle_UNIQUE` ON `pdo_1`.`thesection` (`thesectiontitle` ASC);


-- -----------------------------------------------------
-- Table `pdo_1`.`thearticle_has_thesection`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `pdo_1`.`thearticle_has_thesection` ;

CREATE TABLE IF NOT EXISTS `pdo_1`.`thearticle_has_thesection` (
  `thearticle_idthearticle` INT UNSIGNED NOT NULL,
  `thesection_idthesection` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`thearticle_idthearticle`, `thesection_idthesection`),
  CONSTRAINT `fk_thearticle_has_thesection_thearticle1`
    FOREIGN KEY (`thearticle_idthearticle`)
    REFERENCES `pdo_1`.`thearticle` (`idthearticle`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_thearticle_has_thesection_thesection1`
    FOREIGN KEY (`thesection_idthesection`)
    REFERENCES `pdo_1`.`thesection` (`idthesection`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;

CREATE INDEX `fk_thearticle_has_thesection_thesection1_idx` ON `pdo_1`.`thearticle_has_thesection` (`thesection_idthesection` ASC);

CREATE INDEX `fk_thearticle_has_thesection_thearticle1_idx` ON `pdo_1`.`thearticle_has_thesection` (`thearticle_idthearticle` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
