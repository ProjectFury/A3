-- MySQL Script generated by MySQL Workbench
-- dj 08 nov 2018 17:54:09 CET
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema todo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema todo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `todo` DEFAULT CHARACTER SET utf8 ;
USE `todo` ;

-- -----------------------------------------------------
-- Table `todo`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `todo`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(90) NOT NULL,
  PRIMARY KEY (`iduser`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `iduser_UNIQUE` (`iduser` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `todo`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `todo`.`task` (
  `idtask` INT NOT NULL AUTO_INCREMENT,
  `taskcol` VARCHAR(45) NULL,
  `user_iduser` INT NOT NULL,
  PRIMARY KEY (`idtask`),
  INDEX `fk_task_user_idx` (`user_iduser` ASC),
  CONSTRAINT `fk_task_user`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `todo`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
