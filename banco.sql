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
-- Table `AcervoRct`.`Cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Cargo` (
  `idCargo` INT NOT NULL COMMENT 'Contém o atributo identificador do cargo.',
  -- colocar nome*
  `descricao` CHAR(15) NOT NULL,
  `data_inicio` DATE NOT NULL, 
  `data_fim` DATE NULL,--tirar 
  `ind_ativo` TINYINT NOT NULL COMMENT 'Contém o status do cargo.\nex:\nNome       Status\n\nJoao        Ativo\nmaria       Inativo ',
  PRIMARY KEY (`idCargo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Funcionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Funcionario` (
  `idFuncionario` INT NOT NULL AUTO_INCREMENT COMMENT 'Atributo identificador do funcionário',
  `nome` VARCHAR(100) NOT NULL COMMENT 'Nome do funcionário.\n\nExemplo:\nNome\nJosé',
  `rg` INT NOT NULL COMMENT 'Contém o registro geral do funcionário (Número  da identidade)',
  `dt_admissao` DATE NOT NULL COMMENT 'Data em que o fucionário foi admitido\nex:\n13/08/2024',
  `salario` DECIMAL(9,2) NOT NULL COMMENT 'Contém o salário do funcionário',
  `nome_fantasia` VARCHAR(45) NULL,
  `foto_func` BLOB NULL,
  `Cargo_idCargo` INT NOT NULL,
  --colocar se o funcionario esta ativo ou não
  PRIMARY KEY (`idFuncionario`),
  INDEX `fk_Funcionario_Cargo1_idx` (`Cargo_idCargo` ASC) VISIBLE,
  CONSTRAINT `fk_Funcionario_Cargo1`
    FOREIGN KEY (`Cargo_idCargo`)
    REFERENCES `AcervoRct`.`Cargo` (`idCargo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Receita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Receita` (
  `idReceita` INT NOT NULL AUTO_INCREMENT COMMENT 'Contém o identificador único da receita',
  `nome_rct` VARCHAR(50) NOT NULL COMMENT 'Nome da receita\nEx: \nBolo de Cenoura',
  `dt_criacao` DATE NOT NULL COMMENT 'Data da criação da receita por um cozinheiro.',
  `cozinheiro` INT NOT NULL,
  `preparo` VARCHAR(5000) NOT NULL COMMENT 'Contém o modo de preparo\nEx:\nModo de preparo: Separe 3 gemas numa vasilha e bata a clara[...]',
  `quantidade_porcao` DECIMAL(3,1) NOT NULL COMMENT 'Contém a quintidade de porções obtidas nesta receita\nEx:\nQuantidade\n002',
  `ind_rec_inedita` CHAR(1) NOT NULL COMMENT 'Indicador de receita inédita\nEx:\n\nInd_Rec_Inidita\n\'S\'\n\'N\'\n',
  PRIMARY KEY (`nome_rct`, `cozinheiro`),
  INDEX `fk_Receita_Funcionario_idx` (`cozinheiro` ASC) VISIBLE,
  UNIQUE INDEX `idReceita_UNIQUE` (`idReceita` ASC) VISIBLE,
  CONSTRAINT `fk_Receita_Funcionario`
    FOREIGN KEY (`cozinheiro`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Ingrediente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Ingrediente` (
  `idIngrediente` INT NOT NULL AUTO_INCREMENT COMMENT 'Contém a identificação do ingrediente utilizado nas receitas\nEx:\nIngrediente   Nome\n   0001          Açúcar',
  `nome` VARCHAR(45) NOT NULL COMMENT 'Contém o nome do ingrediente utilizado nas receitas\nEx:\nIngrediente   Nome\n   0001          Açúcar',
  `descricao` VARCHAR(1000) NULL COMMENT 'Contém a desrição do ingrediente\nEx:\nRemovido da folha de uma árvore[...]',
  PRIMARY KEY (`idIngrediente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Medida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Medida` (
  `idMedida` INT NOT NULL COMMENT 'Contém o identificador da medida\nEx:\nId medida      Descrição\n00001           Copo',
  `descricao` VARCHAR(45) NOT NULL COMMENT 'Contém a descrição da medida\nEx:\nId medida      Descrição\n00001           Copo',
  PRIMARY KEY (`idMedida`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Parametro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Parametro` (
  `idmes` SMALLINT NOT NULL COMMENT 'Contêm o mês de referência ',
  `idano` SMALLINT NOT NULL COMMENT 'Contêm o ano de referência',
  `quant_rec_meta` SMALLINT NOT NULL COMMENT 'Contêm a quantidade de receitas a serem produzidas como metas a serem atendidas pelos cozinheiros.\n\nEx\n\nQuantidade\n   01\n   02\n   03\n   04',
  PRIMARY KEY (`idmes`, `idano`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`FotoReceita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`FotoReceita` (
  `idFoto_Receita` INT NOT NULL AUTO_INCREMENT COMMENT 'Contém o identificador da foto da receita.\n\nEx;\nidFoto\n 00001',
  `foto` BLOB NOT NULL COMMENT 'Contém a foto da receita',
  `descricao` VARCHAR(45) NOT NULL COMMENT 'Contém a descrição principa da foto.\nex:\ndescricao\n\nFeijoada',
  PRIMARY KEY (`idFoto_Receita`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Receita_e_Ingrediente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Receita_e_Ingrediente` (
  `FKidIngrediente` INT NULL,
  `FKnome_rct` VARCHAR(50) NULL COMMENT 'Nome da receita\nEx: \nBolo de Cenoura',
  `FKcozinheiro` INT NULL,
  `quant_ingrediente` DECIMAL(5,1) NOT NULL,
  `RC_Parametro_idmes` SMALLINT NULL,
  `RC_Parametro_idano` SMALLINT NULL,
  `RC_FotoReceita_idFoto_Receita` INT NULL,
  PRIMARY KEY (`FKnome_rct`, `FKcozinheiro`, `FKidIngrediente`, `RC_Parametro_idmes`, `RC_Parametro_idano`, `RC_FotoReceita_idFoto_Receita`),
  INDEX `fk_Receita_has_Ingrediente_Ingrediente1_idx` (`FKidIngrediente` ASC) VISIBLE,
  INDEX `fk_Receita_has_Ingrediente_Receita1_idx` (`FKcozinheiro` ASC, `FKnome_rct` ASC) VISIBLE,
  INDEX `fk_RC_Receita_e_Ingrediente_RC_Parametro1_idx` (`RC_Parametro_idmes` ASC, `RC_Parametro_idano` ASC) VISIBLE,
  INDEX `fk_RC_Receita_e_Ingrediente_RC_FotoReceita1_idx` (`RC_FotoReceita_idFoto_Receita` ASC) VISIBLE,
  CONSTRAINT `fk_Receita_has_Ingrediente_Receita1`
    FOREIGN KEY (`FKcozinheiro` , `FKnome_rct`)
    REFERENCES `AcervoRct`.`Receita` (`cozinheiro` , `nome_rct`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Receita_has_Ingrediente_Ingrediente1`
    FOREIGN KEY (`FKidIngrediente`)
    REFERENCES `AcervoRct`.`Ingrediente` (`idIngrediente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_RC_Receita_e_Ingrediente_RC_Parametro1`
    FOREIGN KEY (`RC_Parametro_idmes` , `RC_Parametro_idano`)
    REFERENCES `AcervoRct`.`Parametro` (`idmes` , `idano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_RC_Receita_e_Ingrediente_RC_FotoReceita1`
    FOREIGN KEY (`RC_FotoReceita_idFoto_Receita`)
    REFERENCES `AcervoRct`.`FotoReceita` (`idFoto_Receita`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Restaurante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Restaurante` (
  `idRestaurante` SMALLINT NOT NULL COMMENT 'Contém o atribito identifiador do restaurante do cozinheiro.\nEx:\nidrestaurante   nome\n  001                Rota 001',
  `nome` VARCHAR(45) NOT NULL COMMENT 'Contém o nome do restaurante\nEx:\nidresteurante   nome\n  001                Rota 001',
  `contato` VARCHAR(45) NOT NULL COMMENT 'Contém o contato do restaurante',
  --Faltando endereço;
  `telefone` CHAR(15) NOT NULL COMMENT 'Contém o telefone do contato no restaurante referência.',
  PRIMARY KEY (`idRestaurante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Referencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Referencia` (
  --idReferencia
  `FKcozinheiro` INT NOT NULL,
  `FKRestaurante` SMALLINT NOT NULL,
  `data_inicio` DATE NOT NULL COMMENT 'Contém a data de início do contrato do funcionário.',
  `data_fim` DATE NULL COMMENT 'Contém a data do fim do contrato do funcionário',
  PRIMARY KEY (`FKcozinheiro`, `FKRestaurante`),
  INDEX `fk_Funcionario_has_Restaurante_Restaurante1_idx` (`FKRestaurante` ASC) VISIBLE,
  INDEX `fk_Funcionario_has_Restaurante_Funcionario1_idx` (`FKcozinheiro` ASC) VISIBLE,
  CONSTRAINT `fk_Funcionario_has_Restaurante_Funcionario1`
    FOREIGN KEY (`FKcozinheiro`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Funcionario_has_Restaurante_Restaurante1`
    FOREIGN KEY (`FKRestaurante`)
    REFERENCES `AcervoRct`.`Restaurante` (`idRestaurante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Degustacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Degustacao` (
  `idDegustacao` INT NOT NULL AUTO_INCREMENT COMMENT 'Contém a identificação única da degustação.\n\nEx: \nidDegustação\n\n  0001\n  0002\n  0003',
  `nota_degustacao` DECIMAL(3,1) NOT NULL COMMENT 'Contém a nota da degustação.\n\nEx: \nidDegustação   Nota\n\n  0001              5,1\n  0002              8,1\n  0003              2,1',
  `data_degustacao` DATE NOT NULL COMMENT 'contém a data da degustaão efetuada pelo degustado da receita\nex:\n\ndata\n01/09/2013\n30/04/2022',
  `FKnome_rct` VARCHAR(50) NOT NULL,
  `FKcozinheiro` INT NOT NULL,
  `FKdegustador` INT NOT NULL,
  PRIMARY KEY (`idDegustacao`),
  INDEX `fk_Degustacao_Receita1_idx` (`FKnome_rct` ASC, `FKcozinheiro` ASC) VISIBLE,
  INDEX `fk_Degustacao_Funcionario1_idx` (`FKdegustador` ASC) VISIBLE,
  CONSTRAINT `fk_Degustacao_Receita1`
    FOREIGN KEY (`FKnome_rct` , `FKcozinheiro`)
    REFERENCES `AcervoRct`.`Receita` (`nome_rct` , `cozinheiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Degustacao_Funcionario1`
    FOREIGN KEY (`FKdegustador`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Livro` (
  `idLivro` SMALLINT NOT NULL COMMENT 'Contém o indentificador do livro.\nex:\n\nidLivro    Titulo                    ISBN\n0001      A bela e a fera     978-9-85417-00-9',
  `titulo` VARCHAR(45) NOT NULL COMMENT 'Contém o título do livro.\nex:\n\nidLivro    titulo                    ISBN\n0001      A bela e a fera     978-9-85417-00-9',
  `FKeditor` INT NOT NULL,
  --autor do livro
  `isbn` CHAR(20) NULL COMMENT 'Código de 13 digitos que identifica o autor, título, país, edtora e a edição da obra.\nex:\n\nidLivro    Titulo                    ISBN\n0001      A bela e a fera     978-9-85417-00-9',
  PRIMARY KEY (`idLivro`),
  UNIQUE INDEX `titulo_UNIQUE` (`titulo` ASC) VISIBLE,
  INDEX `fk_Livro_Funcionario1_idx` (`FKeditor` ASC) VISIBLE,
  CONSTRAINT `fk_Livro_Funcionario1`
    FOREIGN KEY (`FKeditor`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Publicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Publicacao` (
  `FKLivro` SMALLINT NULL,
  --Data de quando foi publicado
  `FKnome_rct` VARCHAR(50) NOT NULL,
  `FKcozinheiro` INT NOT NULL,
  PRIMARY KEY (`FKLivro`, `FKnome_rct`, `FKcozinheiro`),
  INDEX `fk_Livro_has_Receita_Receita1_idx` (`FKnome_rct` ASC, `FKcozinheiro` ASC) VISIBLE,
  INDEX `fk_Livro_has_Receita_Livro1_idx` (`FKLivro` ASC) VISIBLE,
  CONSTRAINT `fk_Livro_has_Receita_Livro1`
    FOREIGN KEY (`FKLivro`)
    REFERENCES `AcervoRct`.`Livro` (`idLivro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_has_Receita_Receita1`
    FOREIGN KEY (`FKnome_rct` , `FKcozinheiro`)
    REFERENCES `AcervoRct`.`Receita` (`nome_rct` , `cozinheiro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AcervoRct`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AcervoRct`.`Usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  --Nome do usuario;
  --Cargo/tipo de permissao do usuario;
  `Email` VARCHAR(60) NOT NULL COMMENT 'contem o email para ser registrado no sistema, permitindo o login ',
  `Senha` VARCHAR(20) NOT NULL COMMENT 'caso a senha seja correta com o email inserido, o login sera permitido',
  `JWSL_Funcionario_idFuncionario` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  INDEX `fk_usuario_JWSL_Funcionario1_idx` (`JWSL_Funcionario_idFuncionario` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_JWSL_Funcionario1`
    FOREIGN KEY (`JWSL_Funcionario_idFuncionario`)
    REFERENCES `AcervoRct`.`Funcionario` (`idFuncionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
