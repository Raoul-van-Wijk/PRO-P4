-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema project-p4
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema project-p4
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `project-p4` DEFAULT CHARACTER SET latin1 ;
USE `project-p4` ;

-- -----------------------------------------------------
-- Table `project-p4`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-p4`.`users` (
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(128) NOT NULL,
  `profilePicture` VARCHAR(1000) NULL DEFAULT NULL,
  `bio` VARCHAR(2500) NULL DEFAULT NULL,
  `age` INT(3) NOT NULL,
  `userrole` ENUM('root', 'admin', 'user', '') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userID`),
  UNIQUE INDEX `username` (`username` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
