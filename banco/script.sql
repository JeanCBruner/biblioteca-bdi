-- MySQL Workbench Synchronization
-- Generated: 2023-12-10 01:32
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Jean

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `biblioteca`.`leitor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `dataNascimento` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`categoria` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`editora` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`livro` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `autor` TEXT NOT NULL,
  `anoPublicacao` YEAR NULL DEFAULT NULL,
  `qtdExemplares` INT(10) UNSIGNED NOT NULL,
  `editora_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_livro_editora1_idx` (`editora_id` ASC),
  CONSTRAINT `fk_livro_editora1`
    FOREIGN KEY (`editora_id`)
    REFERENCES `biblioteca`.`editora` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`status_locacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `biblioteca`.`livro_categoria` (
  `livro_id` INT(11) NOT NULL,
  `categoria_id` INT(11) NOT NULL,
  INDEX `fk_livro_has_categoria_categoria1_idx` (`categoria_id` ASC),
  INDEX `fk_livro_has_categoria_livro1_idx` (`livro_id` ASC),
  CONSTRAINT `fk_livro_has_categoria_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `biblioteca`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_livro_has_categoria_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `biblioteca`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;



CREATE TABLE IF NOT EXISTS `biblioteca`.`locacao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `dataLocacao` DATE NOT NULL,
  `dataDevolucaoEstimada` DATE NOT NULL,
  `dataDevolucaoReal` DATE NULL DEFAULT NULL,
  `valorLocacao` FLOAT(11) NOT NULL,
  `valorMulta` FLOAT(11) NULL DEFAULT NULL,
  `valorFinal` FLOAT(11) NULL DEFAULT NULL,
  `observacoesIniciais` TEXT NULL DEFAULT NULL,
  `observacoesFinais` TEXT NULL DEFAULT NULL,
  `livro_id` INT(11) NOT NULL,
  `leitor_id` INT(11) NOT NULL,
  `status_locacao_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_alocacao_livro1_idx` (`livro_id` ASC),
  INDEX `fk_alocacao_leitor1_idx` (`leitor_id` ASC),
  INDEX `fk_locacao_status_locacao1_idx` (`status_locacao_id` ASC),
  CONSTRAINT `fk_alocacao_livro1`
    FOREIGN KEY (`livro_id`)
    REFERENCES `biblioteca`.`livro` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alocacao_leitor1`
    FOREIGN KEY (`leitor_id`)
    REFERENCES `biblioteca`.`leitor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_locacao_status_locacao1`
    FOREIGN KEY (`status_locacao_id`)
    REFERENCES `biblioteca`.`status_locacao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


