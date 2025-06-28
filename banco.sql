-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema AcervoRct
-- -----------------------------------------------------
-- Acervos de recetas a serem publicados em forna de livros a serem vendidos no mecado.
-- 

-- -----------------------------------------------------
-- Schema AcervoRct
--
-- Acervos de recetas a serem publicados em forna de livros a serem vendidos no mecado.
-- 
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `AcervoRct` ;
-- -----------------------------------------------------
-- Schema new_schema1
-- -----------------------------------------------------
USE `AcervoRct` ;

-- -----------------------------------------------------
-- Table `AcervoRct`.`Cargo`cargo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Cargo` (
  `idCargo` INT NOT NULL AUTO_INCREMENT COMMENT 'Contém o atributo identificador do cargo.',
  `nomeCargo` CHAR(30) NOT NULL,
  `descricao` CHAR(15) NOT NULL,
  `ind_ativo` TINYINT NOT NULL COMMENT 'Contém o status do cargo.ex:Nome       Status:Joao        Ativo:maria       Inativo ',
  PRIMARY KEY (`idCargo`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `AcervoRct`.`Funcionario`receitareceitareceitareceita
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Funcionario` (
  `idFuncionario` INT NOT NULL AUTO_INCREMENT COMMENT 'Atributo identificador do funcionário',
  `nome` VARCHAR(100) NOT NULL COMMENT 'Nome do funcionário. Exemplo: José',
  `rg` INT NOT NULL COMMENT 'Registro geral do funcionário (número da identidade)',
  `dt_admissao` DATE NOT NULL COMMENT 'Data em que o funcionário foi admitido. Exemplo: 2024-08-13',
  `salario` DECIMAL(9,2) NOT NULL COMMENT 'Salário do funcionário',
  `nome_fantasia` VARCHAR(45) NULL COMMENT 'Nome fantasia do funcionário',
  `foto_func` BLOB NULL COMMENT 'Foto do funcionário',
  `Cargo_idCargo` INT NOT NULL COMMENT 'Chave estrangeira para o cargo',
  PRIMARY KEY (`idFuncionario`),
  INDEX `fk_Funcionario_Cargo1_idx` (`Cargo_idCargo` ASC),
  CONSTRAINT `fk_Funcionario_Cargo1`
    FOREIGN KEY (`Cargo_idCargo`)
    REFERENCES `AcervoRct`.`Cargo` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Receita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Receita` (
  `idReceita` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador único da receita',
  `nome_rct` VARCHAR(50) NOT NULL COMMENT 'Nome da receita. Exemplo: Bolo de Cenoura',
  `dt_criacao` DATE NOT NULL COMMENT 'Data da criação da receita pelo cozinheiro',
  `cozinheiro` INT NOT NULL COMMENT 'ID do cozinheiro responsável pela receita',
  `preparo` VARCHAR(5000) NOT NULL COMMENT 'Modo de preparo da receita',
  `quantidade_porcao` DECIMAL(3,1) NOT NULL COMMENT 'Quantidade de porções da receita. Exemplo: 2.0',
  `ind_rec_inedita` CHAR(1) NOT NULL COMMENT 'Indicador de receita inédita. Ex: S = Sim, N = Não',
  PRIMARY KEY (`nome_rct`, `cozinheiro`),
  UNIQUE INDEX `idReceita_UNIQUE` (`idReceita` ASC),
  INDEX `fk_Receita_Funcionario_idx` (`cozinheiro` ASC),
  CONSTRAINT `fk_Receita_Funcionario`
    FOREIGN KEY (`cozinheiro`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `AcervoRct`.`Ingrediente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Ingrediente` (
  `idIngrediente` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificação do ingrediente. Exemplo: 0001 - Açúcar',
  `nome` VARCHAR(45) NOT NULL COMMENT 'Nome do ingrediente utilizado nas receitas. Exemplo: Açúcar',
  `descricao` VARCHAR(1000) NULL COMMENT 'Descrição do ingrediente. Exemplo: Removido da folha de uma árvore...',
  PRIMARY KEY (`idIngrediente`)
)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `AcervoRct`.`Medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Medida` (
  `idMedida` INT NOT NULL COMMENT 'Identificador da medida. Exemplo: 00001 - Copo',
  `descricao` VARCHAR(45) NOT NULL COMMENT 'Descrição da medida. Exemplo: Copo',
  PRIMARY KEY (`idMedida`)
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `AcervoRct`.`Parametro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Parametro` (
  `idmes` SMALLINT NOT NULL COMMENT 'Mês de referência',
  `idano` SMALLINT NOT NULL COMMENT 'Ano de referência',
  `quant_rec_meta` SMALLINT NOT NULL COMMENT 'Quantidade de receitas definidas como meta para os cozinheiros. Exemplo: 1, 2, 3, 4',
  PRIMARY KEY (`idmes`, `idano`)
)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `AcervoRct`.`FotoReceita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`FotoReceita` (
  `idFoto_Receita` INT NOT NULL AUTO_INCREMENT COMMENT 'Identificador da foto da receita. Exemplo: 00001',
  `foto` BLOB NOT NULL COMMENT 'Foto da receita',
  `descricao` VARCHAR(45) NOT NULL COMMENT 'Descrição principal da foto. Exemplo: Feijoada',
  PRIMARY KEY (`idFoto_Receita`)
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `AcervoRct`.`Receita_e_Ingrediente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Receita_e_Ingrediente` (
  `FKidIngrediente` INT NOT NULL COMMENT 'ID do ingrediente utilizado na receita',
  `FKnome_rct` VARCHAR(50) NOT NULL COMMENT 'Nome da receita. Exemplo: Bolo de Cenoura',
  `FKcozinheiro` INT NOT NULL COMMENT 'ID do cozinheiro autor da receita',
  `quant_ingrediente` DECIMAL(5,1) NOT NULL COMMENT 'Quantidade do ingrediente na receita',
  `RC_Parametro_idmes` SMALLINT NOT NULL COMMENT 'Mês de referência',
  `RC_Parametro_idano` SMALLINT NOT NULL COMMENT 'Ano de referência',
  `RC_FotoReceita_idFoto_Receita` INT NOT NULL COMMENT 'ID da foto associada à receita',
  PRIMARY KEY (
    `FKnome_rct`, 
    `FKcozinheiro`, 
    `FKidIngrediente`, 
    `RC_Parametro_idmes`, 
    `RC_Parametro_idano`, 
    `RC_FotoReceita_idFoto_Receita`
  ),
  INDEX `fk_Receita_has_Ingrediente_Ingrediente1_idx` (`FKidIngrediente` ASC),
  INDEX `fk_Receita_has_Ingrediente_Receita1_idx` (`FKcozinheiro` ASC, `FKnome_rct` ASC),
  INDEX `fk_RC_Receita_e_Ingrediente_RC_Parametro1_idx` (`RC_Parametro_idmes` ASC, `RC_Parametro_idano` ASC),
  INDEX `fk_RC_Receita_e_Ingrediente_RC_FotoReceita1_idx` (`RC_FotoReceita_idFoto_Receita` ASC),
  
  CONSTRAINT `fk_Receita_has_Ingrediente_Receita1`
    FOREIGN KEY (`FKcozinheiro`, `FKnome_rct`)
    REFERENCES `AcervoRct`.`Receita` (`cozinheiro`, `nome_rct`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

  CONSTRAINT `fk_Receita_has_Ingrediente_Ingrediente1`
    FOREIGN KEY (`FKidIngrediente`)
    REFERENCES `AcervoRct`.`Ingrediente` (`idIngrediente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

  CONSTRAINT `fk_RC_Receita_e_Ingrediente_RC_Parametro1`
    FOREIGN KEY (`RC_Parametro_idmes`, `RC_Parametro_idano`)
    REFERENCES `AcervoRct`.`Parametro` (`idmes`, `idano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

  CONSTRAINT `fk_RC_Receita_e_Ingrediente_RC_FotoReceita1`
    FOREIGN KEY (`RC_FotoReceita_idFoto_Receita`)
    REFERENCES `AcervoRct`.`FotoReceita` (`idFoto_Receita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `AcervoRct`.`Restaurante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Restaurante` (
  `idRestaurante` SMALLINT NOT NULL COMMENT 'Identificador do restaurante. Exemplo: 001',
  `nome` VARCHAR(45) NOT NULL COMMENT 'Nome do restaurante. Exemplo: Rota 001',
  `contato` VARCHAR(45) NOT NULL COMMENT 'Nome da pessoa de contato no restaurante',
  `telefone` CHAR(15) NOT NULL COMMENT 'Telefone de contato do restaurante',
  PRIMARY KEY (`idRestaurante`)
)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `AcervoRct`.`Referencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Referencia` (
  `FKcozinheiro` INT NOT NULL COMMENT 'ID do funcionário (cozinheiro)',
  `FKRestaurante` SMALLINT NOT NULL COMMENT 'ID do restaurante',
  `data_inicio` DATE NOT NULL COMMENT 'Data de início do contrato do funcionário com o restaurante',
  `data_fim` DATE NULL COMMENT 'Data de término do contrato (se aplicável)',
  PRIMARY KEY (`FKcozinheiro`, `FKRestaurante`),
  INDEX `fk_Funcionario_has_Restaurante_Restaurante1_idx` (`FKRestaurante` ASC),
  INDEX `fk_Funcionario_has_Restaurante_Funcionario1_idx` (`FKcozinheiro` ASC),
  CONSTRAINT `fk_Funcionario_has_Restaurante_Funcionario1`
    FOREIGN KEY (`FKcozinheiro`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Funcionario_has_Restaurante_Restaurante1`
    FOREIGN KEY (`FKRestaurante`)
    REFERENCES `AcervoRct`.`Restaurante` (`idRestaurante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `AcervoRct`.`Degustacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Degustacao` (
  `idDegustacao` INT NOT NULL AUTO_INCREMENT COMMENT 'Contém a identificação única da degustação. Exemplo: 0001, 0002, 0003',
  `nota_degustacao` DECIMAL(3,1) NOT NULL COMMENT 'Contém a nota da degustação. Exemplo: 5.1, 8.1, 2.1',
  `data_degustacao` DATE NOT NULL COMMENT 'Contém a data da degustação efetuada pelo degustador da receita. Exemplo: 2013-09-01, 2022-04-30',
  `FKnome_rct` VARCHAR(50) NOT NULL,
  `FKcozinheiro` INT NOT NULL,
  `FKdegustador` INT NOT NULL,
  PRIMARY KEY (`idDegustacao`),
  INDEX `fk_Degustacao_Receita1_idx` (`FKnome_rct` ASC, `FKcozinheiro` ASC),
  INDEX `fk_Degustacao_Funcionario1_idx` (`FKdegustador` ASC),
  CONSTRAINT `fk_Degustacao_Receita1`
    FOREIGN KEY (`FKnome_rct`, `FKcozinheiro`)
    REFERENCES `AcervoRct`.`Receita` (`nome_rct`, `cozinheiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Degustacao_Funcionario1`
    FOREIGN KEY (`FKdegustador`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Livro` (
  `idLivro` SMALLINT NOT NULL COMMENT 'Contém o identificador do livro. Exemplo: 0001',
  `titulo` VARCHAR(45) NOT NULL COMMENT 'Contém o título do livro. Exemplo: A bela e a fera',
  `FKeditor` INT NOT NULL,
  `isbn` CHAR(20) NULL COMMENT 'Código ISBN que identifica autor, título, país, editora e edição da obra. Exemplo: 978-9-85417-00-9',
  PRIMARY KEY (`idLivro`),
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC),
  INDEX `fk_Livro_Funcionario1_idx` (`FKeditor` ASC),
  CONSTRAINT `fk_Livro_Funcionario1`
    FOREIGN KEY (`FKeditor`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Publicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Publicacao` (
  `FKLivro` SMALLINT NULL,
  `FKnome_rct` VARCHAR(50) NOT NULL,
  `FKcozinheiro` INT NOT NULL,
  PRIMARY KEY (`FKLivro`, `FKnome_rct`, `FKcozinheiro`),
  INDEX `fk_Livro_has_Receita_Receita1_idx` (`FKnome_rct` ASC, `FKcozinheiro` ASC),
  INDEX `fk_Livro_has_Receita_Livro1_idx` (`FKLivro` ASC),
  CONSTRAINT `fk_Livro_has_Receita_Livro1`
    FOREIGN KEY (`FKLivro`)
    REFERENCES `AcervoRct`.`Livro` (`idLivro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_has_Receita_Receita1`
    FOREIGN KEY (`FKnome_rct`, `FKcozinheiro`)
    REFERENCES `AcervoRct`.`Receita` (`nome_rct`, `cozinheiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE=InnoDB;


CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    nomeUser VARCHAR(50) NOT NULL,
    nivel_acesso varchar(50) NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE redefinicao_senhas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) UNIQUE NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
);



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

