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
  `age` INT(3) NOT NULL,
  `userrole` ENUM('root', 'admin', 'user', '') NOT NULL DEFAULT 'user',
  `firstLogin` INT(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`userID`),
  UNIQUE INDEX `username` (`username` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 19
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-p4`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-p4`.`chat` (
  `chatID` INT(11) NOT NULL AUTO_INCREMENT,
  `FromUserID` INT(11) NOT NULL,
  `ToUserID` INT(11) NOT NULL,
  `Message` VARCHAR(2500) NOT NULL,
  UNIQUE INDEX `chatID` (`chatID` ASC) VISIBLE,
  INDEX `FromUserID` (`FromUserID` ASC) VISIBLE,
  INDEX `ToUserID` (`ToUserID` ASC) VISIBLE,
  CONSTRAINT `fk_FromUserID`
    FOREIGN KEY (`FromUserID`)
    REFERENCES `project-p4`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ToUserID`
    FOREIGN KEY (`ToUserID`)
    REFERENCES `project-p4`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 89
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-p4`.`userfriends`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-p4`.`userfriends` (
  `friendID` INT(11) NOT NULL AUTO_INCREMENT,
  `fuserID` INT(11) NOT NULL,
  `friendUserID` INT(11) NOT NULL,
  PRIMARY KEY (`friendID`),
  INDEX `userID` (`fuserID` ASC) VISIBLE,
  INDEX `friendUserID` (`friendUserID` ASC) VISIBLE,
  CONSTRAINT `fk_uf_fuserID`
    FOREIGN KEY (`friendUserID`)
    REFERENCES `project-p4`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_uf_userID`
    FOREIGN KEY (`fuserID`)
    REFERENCES `project-p4`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `project-p4`.`userprofile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `project-p4`.`userprofile` (
  `userID` INT(11) NOT NULL,
  `profilePicture` VARCHAR(500) NULL DEFAULT NULL,
  `bio` VARCHAR(2500) NULL DEFAULT NULL,
  `backGroundImage` VARCHAR(500) NULL DEFAULT NULL,
  UNIQUE INDEX `userID` (`userID` ASC),
  CONSTRAINT `fk_userID`
    FOREIGN KEY (`userID`)
    REFERENCES `project-p4`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
