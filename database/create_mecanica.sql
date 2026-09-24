-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mecanica
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `mecanica` DEFAULT CHARACTER SET utf8;
USE `mecanica`;


-- -----------------------------------------------------
-- Table `mecanica`.`servico`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`servico` (
  `id_servico` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(80) NOT NULL,
  `tempo` INT NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `descricao` TEXT NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `update_at` DATETIME NOT NULL,
  `create_at` DATETIME NOT NULL,
  PRIMARY KEY (`id_servico`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`cliente`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  `endereco` VARCHAR(100) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`carro`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`carro` (
  `id_carro` INT NOT NULL AUTO_INCREMENT,
  `placa` VARCHAR(10) NOT NULL,
  `marca` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(45) NOT NULL,
  `ano` YEAR NOT NULL,
  `cor` VARCHAR(45) NULL,
  `active` TINYINT(1) NOT NULL,
  `id_cliente` INT NOT NULL,
  `update_at` DATETIME NOT NULL,
  `create_at` DATETIME NOT NULL,
  PRIMARY KEY (`id_carro`),
  INDEX `fk_carro_cliente1_idx` (`id_cliente`),
  CONSTRAINT `fk_carro_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `mecanica`.`cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`usuario`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NOT NULL,
  `senha_hash` VARCHAR(255) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`os`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`os` (
  `id_os` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `data_saida` DATE NULL,
  `data_entrada` DATE NOT NULL,
  `data_agendamento` DATE NOT NULL,
  `carro_id_carro` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `create_at` DATETIME NOT NULL,
  `update_at` DATETIME NOT NULL,
  PRIMARY KEY (`id_os`),

  INDEX `fk_os_carro1_idx` (`carro_id_carro`),
  INDEX `fk_os_usuario1_idx` (`id_usuario`),

  CONSTRAINT `fk_os_carro1`
    FOREIGN KEY (`carro_id_carro`)
    REFERENCES `mecanica`.`carro` (`id_carro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

  CONSTRAINT `fk_os_usuario1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `mecanica`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`mecanico`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`mecanico` (
  `id_mecanico` INT NOT NULL AUTO_INCREMENT,
  `cpf` VARCHAR(11) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `especialidade` TEXT NOT NULL,
  `telefone` VARCHAR(11) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `update_at` DATETIME NOT NULL,
  `create_at` DATETIME NOT NULL,
  PRIMARY KEY (`id_mecanico`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf`)
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`os_has_mecanico`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`os_has_mecanico` (
  `os_id_os` INT NOT NULL,
  `mecanico_id_mecanico` INT NOT NULL,

  PRIMARY KEY (`os_id_os`, `mecanico_id_mecanico`),

  INDEX `fk_os_has_mecanico_mecanico1_idx`
    (`mecanico_id_mecanico`),

  INDEX `fk_os_has_mecanico_os1_idx`
    (`os_id_os`),

  CONSTRAINT `fk_os_has_mecanico_os1`
    FOREIGN KEY (`os_id_os`)
    REFERENCES `mecanica`.`os` (`id_os`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

  CONSTRAINT `fk_os_has_mecanico_mecanico1`
    FOREIGN KEY (`mecanico_id_mecanico`)
    REFERENCES `mecanica`.`mecanico` (`id_mecanico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mecanica`.`servico_has_os`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mecanica`.`servico_has_os` (
  `servico_id_servico` INT NOT NULL,
  `os_id_os` INT NOT NULL,

  PRIMARY KEY (`servico_id_servico`, `os_id_os`),

  INDEX `fk_servico_has_os_os1_idx`
    (`os_id_os`),

  INDEX `fk_servico_has_os_servico1_idx`
    (`servico_id_servico`),

  CONSTRAINT `fk_servico_has_os_servico1`
    FOREIGN KEY (`servico_id_servico`)
    REFERENCES `mecanica`.`servico` (`id_servico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

  CONSTRAINT `fk_servico_has_os_os1`
    FOREIGN KEY (`os_id_os`)
    REFERENCES `mecanica`.`os` (`id_os`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

CREATE VIEW vw_ordens_servico AS
SELECT
    os.id_os,
    os.data_entrada,
    os.data_saida,
    os.data_agendamento,
    os.status,
    os.valor,
    c.nome AS cliente_nome,
    c.cpf AS cliente_cpf,
    carro.placa,
    carro.marca,
    carro.modelo,
    carro.ano,
    u.nome AS usuario_nome
FROM os
INNER JOIN carro
    ON carro.id_carro = os.carro_id_carro
INNER JOIN cliente c
    ON c.id_cliente = carro.id_cliente
INNER JOIN usuario u
    ON u.id_usuario = os.id_usuario;