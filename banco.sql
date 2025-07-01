CREATE SCHEMA IF NOT EXISTS `AcervoRct` ;

USE `AcervoRct` ;

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL COMMENT 'Contém o atributo identificador do cargo.',
  `nomeCargo` char(30) NOT NULL,
  `descricao` char(15) NOT NULL,
  `ind_ativo` tinyint(4) NOT NULL COMMENT 'Contém o status do cargo.ex:Nome       Status:Joao        Ativo:maria       Inativo ',
  `data_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `nomeCategoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `degustacao`
--

CREATE TABLE `degustacao` (
  `idDegustacao` int(11) NOT NULL COMMENT 'Contém a identificação única da degustação. Exemplo: 0001, 0002, 0003',
  `nota_degustacao` decimal(3,1) NOT NULL COMMENT 'Contém a nota da degustação. Exemplo: 5.1, 8.1, 2.1',
  `data_degustacao` date NOT NULL COMMENT 'Contém a data da degustação efetuada pelo degustador da receita. Exemplo: 2013-09-01, 2022-04-30',
  `FKnome_rct` varchar(50) NOT NULL,
  `FKcozinheiro` int(11) NOT NULL,
  `FKdegustador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotoreceita`
--

CREATE TABLE `fotoreceita` (
  `idFoto_Receita` int(11) NOT NULL COMMENT 'Identificador da foto da receita. Exemplo: 00001',
  `foto` blob NOT NULL COMMENT 'Foto da receita',
  `descricao` varchar(45) NOT NULL COMMENT 'Descrição principal da foto. Exemplo: Feijoada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` int(11) NOT NULL COMMENT 'Atributo identificador do funcionário',
  `nome` varchar(100) NOT NULL COMMENT 'Nome do funcionário. Exemplo: José',
  `rg` int(11) NOT NULL COMMENT 'Registro geral do funcionário (número da identidade)',
  `dt_admissao` date NOT NULL COMMENT 'Data em que o funcionário foi admitido. Exemplo: 2024-08-13',
  `salario` decimal(9,2) NOT NULL COMMENT 'Salário do funcionário',
  `nome_fantasia` varchar(45) DEFAULT NULL COMMENT 'Nome fantasia do funcionário',
  `foto_func` blob DEFAULT NULL COMMENT 'Foto do funcionário',
  `Cargo_idCargo` int(11) NOT NULL COMMENT 'Chave estrangeira para o cargo',
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ingrediente`
--

CREATE TABLE `ingrediente` (
  `idIngrediente` int(11) NOT NULL COMMENT 'Identificação do ingrediente. Exemplo: 0001 - Açúcar',
  `nome` varchar(45) NOT NULL COMMENT 'Nome do ingrediente utilizado nas receitas. Exemplo: Açúcar',
  `descricao` varchar(1000) DEFAULT NULL COMMENT 'Descrição do ingrediente. Exemplo: Removido da folha de uma árvore...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `idLivro` int(11) NOT NULL,
  `nomeLivro` varchar(50) NOT NULL,
  `editora` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `receitas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estrutura para tabela `medida`
--

CREATE TABLE `medida` (
  `idMedida` int(11) NOT NULL COMMENT 'Identificador da medida. Exemplo: 00001 - Copo',
  `descricao` varchar(45) NOT NULL COMMENT 'Descrição da medida. Exemplo: Copo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `parametro`
--

CREATE TABLE `parametro` (
  `idmes` smallint(6) NOT NULL COMMENT 'Mês de referência',
  `idano` smallint(6) NOT NULL COMMENT 'Ano de referência',
  `quant_rec_meta` smallint(6) NOT NULL COMMENT 'Quantidade de receitas definidas como meta para os cozinheiros. Exemplo: 1, 2, 3, 4'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `publicacao`
--

CREATE TABLE `publicacao` (
  `FKLivro` smallint(6) NOT NULL,
  `FKnome_rct` varchar(50) NOT NULL,
  `FKcozinheiro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita`
--

CREATE TABLE `receita` (
  `idReceita` int(11) NOT NULL COMMENT 'Identificador único da receita',
  `nome_rct` varchar(50) NOT NULL COMMENT 'Nome da receita. Exemplo: Bolo de Cenoura',
  `dt_criacao` date NOT NULL COMMENT 'Data da criação da receita pelo cozinheiro',
  `cozinheiro` int(11) NOT NULL COMMENT 'ID do cozinheiro responsável pela receita',
  `preparo` varchar(5000) NOT NULL COMMENT 'Modo de preparo da receita',
  `quantidade_porcao` decimal(3,1) NOT NULL COMMENT 'Quantidade de porções da receita. Exemplo: 2.0',
  `ind_rec_inedita` char(1) NOT NULL COMMENT 'Indicador de receita inédita. Ex: S = Sim, N = Não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receitanovo`
--

CREATE TABLE `receitanovo` (
  `idReceita` int(11) NOT NULL,
  `nomeReceita` varchar(50) DEFAULT NULL,
  `dataCriacao` date NOT NULL,
  `ingredientes` text NOT NULL,
  `preparo` text NOT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `foto` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Estrutura para tabela `receita_e_ingrediente`
--

CREATE TABLE `receita_e_ingrediente` (
  `FKidIngrediente` int(11) NOT NULL COMMENT 'ID do ingrediente utilizado na receita',
  `FKnome_rct` varchar(50) NOT NULL COMMENT 'Nome da receita. Exemplo: Bolo de Cenoura',
  `FKcozinheiro` int(11) NOT NULL COMMENT 'ID do cozinheiro autor da receita',
  `quant_ingrediente` decimal(5,1) NOT NULL COMMENT 'Quantidade do ingrediente na receita',
  `RC_Parametro_idmes` smallint(6) NOT NULL COMMENT 'Mês de referência',
  `RC_Parametro_idano` smallint(6) NOT NULL COMMENT 'Ano de referência',
  `RC_FotoReceita_idFoto_Receita` int(11) NOT NULL COMMENT 'ID da foto associada à receita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `referencia`
--

CREATE TABLE `referencia` (
  `FKcozinheiro` int(11) NOT NULL COMMENT 'ID do funcionário (cozinheiro)',
  `FKRestaurante` smallint(6) NOT NULL COMMENT 'ID do restaurante',
  `data_inicio` date NOT NULL COMMENT 'Data de início do contrato do funcionário com o restaurante',
  `data_fim` date DEFAULT NULL COMMENT 'Data de término do contrato (se aplicável)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `restaurante`
--

CREATE TABLE `restaurante` (
  `idRestaurante` smallint(6) NOT NULL COMMENT 'Identificador do restaurante. Exemplo: 001',
  `nome` varchar(45) NOT NULL COMMENT 'Nome do restaurante. Exemplo: Rota 001',
  `contato` varchar(45) NOT NULL COMMENT 'Nome da pessoa de contato no restaurante',
  `telefone` char(15) NOT NULL COMMENT 'Telefone de contato do restaurante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Índices de tabela `degustacao`
--
ALTER TABLE `degustacao`
  ADD PRIMARY KEY (`idDegustacao`),
  ADD KEY `fk_Degustacao_Receita1_idx` (`FKnome_rct`,`FKcozinheiro`),
  ADD KEY `fk_Degustacao_Funcionario1_idx` (`FKdegustador`);

--
-- Índices de tabela `fotoreceita`
--
ALTER TABLE `fotoreceita`
  ADD PRIMARY KEY (`idFoto_Receita`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`),
  ADD KEY `fk_Funcionario_Cargo1_idx` (`Cargo_idCargo`);

--
-- Índices de tabela `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD PRIMARY KEY (`idIngrediente`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`idLivro`);

--
-- Índices de tabela `medida`
--
ALTER TABLE `medida`
  ADD PRIMARY KEY (`idMedida`);

--
-- Índices de tabela `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`idmes`,`idano`);

--
-- Índices de tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD PRIMARY KEY (`FKLivro`,`FKnome_rct`,`FKcozinheiro`),
  ADD KEY `fk_Livro_has_Receita_Receita1_idx` (`FKnome_rct`,`FKcozinheiro`),
  ADD KEY `fk_Livro_has_Receita_Livro1_idx` (`FKLivro`);

--
-- Índices de tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`nome_rct`,`cozinheiro`),
  ADD UNIQUE KEY `idReceita_UNIQUE` (`idReceita`),
  ADD KEY `fk_Receita_Funcionario_idx` (`cozinheiro`);

--
-- Índices de tabela `receitanovo`
--
ALTER TABLE `receitanovo`
  ADD PRIMARY KEY (`idReceita`);

--
-- Índices de tabela `receita_e_ingrediente`
--
ALTER TABLE `receita_e_ingrediente`
  ADD PRIMARY KEY (`FKnome_rct`,`FKcozinheiro`,`FKidIngrediente`,`RC_Parametro_idmes`,`RC_Parametro_idano`,`RC_FotoReceita_idFoto_Receita`),
  ADD KEY `fk_Receita_has_Ingrediente_Ingrediente1_idx` (`FKidIngrediente`),
  ADD KEY `fk_Receita_has_Ingrediente_Receita1_idx` (`FKcozinheiro`,`FKnome_rct`),
  ADD KEY `fk_RC_Receita_e_Ingrediente_RC_Parametro1_idx` (`RC_Parametro_idmes`,`RC_Parametro_idano`),
  ADD KEY `fk_RC_Receita_e_Ingrediente_RC_FotoReceita1_idx` (`RC_FotoReceita_idFoto_Receita`);

--
-- Índices de tabela `referencia`
--
ALTER TABLE `referencia`
  ADD PRIMARY KEY (`FKcozinheiro`,`FKRestaurante`),
  ADD KEY `fk_Funcionario_has_Restaurante_Restaurante1_idx` (`FKRestaurante`),
  ADD KEY `fk_Funcionario_has_Restaurante_Funcionario1_idx` (`FKcozinheiro`);

--
-- Índices de tabela `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`idRestaurante`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Contém o atributo identificador do cargo.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `degustacao`
--
ALTER TABLE `degustacao`
  MODIFY `idDegustacao` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Contém a identificação única da degustação. Exemplo: 0001, 0002, 0003';

--
-- AUTO_INCREMENT de tabela `fotoreceita`
--
ALTER TABLE `fotoreceita`
  MODIFY `idFoto_Receita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador da foto da receita. Exemplo: 00001';

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Atributo identificador do funcionário', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `ingrediente`
--
ALTER TABLE `ingrediente`
  MODIFY `idIngrediente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificação do ingrediente. Exemplo: 0001 - Açúcar', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `idLivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador único da receita';

--
-- AUTO_INCREMENT de tabela `receitanovo`
--
ALTER TABLE `receitanovo`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `degustacao`
--
ALTER TABLE `degustacao`
  ADD CONSTRAINT `fk_Degustacao_Funcionario1` FOREIGN KEY (`FKdegustador`) REFERENCES `funcionario` (`idFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Degustacao_Receita1` FOREIGN KEY (`FKnome_rct`,`FKcozinheiro`) REFERENCES `receita` (`nome_rct`, `cozinheiro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_Funcionario_Cargo1` FOREIGN KEY (`Cargo_idCargo`) REFERENCES `cargo` (`idCargo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `fk_Livro_has_Receita_Livro1` FOREIGN KEY (`FKLivro`) REFERENCES `livro` (`idLivro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Livro_has_Receita_Receita1` FOREIGN KEY (`FKnome_rct`,`FKcozinheiro`) REFERENCES `receita` (`nome_rct`, `cozinheiro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `fk_Receita_Funcionario` FOREIGN KEY (`cozinheiro`) REFERENCES `funcionario` (`idFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `receita_e_ingrediente`
--
ALTER TABLE `receita_e_ingrediente`
  ADD CONSTRAINT `fk_RC_Receita_e_Ingrediente_RC_FotoReceita1` FOREIGN KEY (`RC_FotoReceita_idFoto_Receita`) REFERENCES `fotoreceita` (`idFoto_Receita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RC_Receita_e_Ingrediente_RC_Parametro1` FOREIGN KEY (`RC_Parametro_idmes`,`RC_Parametro_idano`) REFERENCES `parametro` (`idmes`, `idano`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Receita_has_Ingrediente_Ingrediente1` FOREIGN KEY (`FKidIngrediente`) REFERENCES `ingrediente` (`idIngrediente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Receita_has_Ingrediente_Receita1` FOREIGN KEY (`FKcozinheiro`,`FKnome_rct`) REFERENCES `receita` (`cozinheiro`, `nome_rct`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `referencia`
--
ALTER TABLE `referencia`
  ADD CONSTRAINT `fk_Funcionario_has_Restaurante_Funcionario1` FOREIGN KEY (`FKcozinheiro`) REFERENCES `funcionario` (`idFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Funcionario_has_Restaurante_Restaurante1` FOREIGN KEY (`FKRestaurante`) REFERENCES `restaurante` (`idRestaurante`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;