-- ============================================
-- AcervoRCT - Schema
-- ============================================

CREATE DATABASE IF NOT EXISTS acervo_rct
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE acervo_rct;

-- ============================================
-- AUTENTICAÇÃO
-- ============================================

CREATE TABLE cargo (
    id          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome        VARCHAR(50)     NOT NULL,
    descricao   VARCHAR(100)    DEFAULT NULL,
    ativo       TINYINT(1)      NOT NULL DEFAULT 1,
    criado_em   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_cargo_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE funcionario (
    id              INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome            VARCHAR(100)    NOT NULL,
    nome_fantasia   VARCHAR(50)     DEFAULT NULL,
    rg              VARCHAR(20)     DEFAULT NULL,
    email           VARCHAR(255)    NOT NULL,
    senha           VARCHAR(255)    NOT NULL,
    salario         DECIMAL(9,2)    DEFAULT NULL,
    dt_admissao     DATE            DEFAULT NULL,
    foto            VARCHAR(255)    DEFAULT NULL,
    role            ENUM('admin', 'funcionario') NOT NULL DEFAULT 'funcionario',
    ativo           TINYINT(1)      NOT NULL DEFAULT 1,
    cargo_id        INT UNSIGNED    DEFAULT NULL,
    criado_em       TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_funcionario_email (email),
    CONSTRAINT fk_funcionario_cargo
        FOREIGN KEY (cargo_id) REFERENCES cargo (id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- RESTAURANTE
-- ============================================

CREATE TABLE restaurante (
    id          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome        VARCHAR(100)    NOT NULL,
    contato     VARCHAR(100)    DEFAULT NULL,
    telefone    VARCHAR(20)     DEFAULT NULL,
    ativo       TINYINT(1)      NOT NULL DEFAULT 1,
    criado_em   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- RECEITAS
-- ============================================

CREATE TABLE categoria (
    id      INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome    VARCHAR(50)     NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_categoria_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE medida (
    id          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    descricao   VARCHAR(50)     NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_medida_descricao (descricao)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ingrediente (
    id          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome        VARCHAR(100)    NOT NULL,
    descricao   VARCHAR(500)    DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_ingrediente_nome (nome)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE receita (
    id                  INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome                VARCHAR(100)    NOT NULL,
    preparo             TEXT            NOT NULL,
    quantidade_porcao   DECIMAL(5,1)    DEFAULT NULL,
    inedita             TINYINT(1)      NOT NULL DEFAULT 0,
    foto                VARCHAR(255)    DEFAULT NULL,
    dt_criacao          DATE            NOT NULL,
    categoria_id        INT UNSIGNED    DEFAULT NULL,
    cozinheiro_id       INT UNSIGNED    NOT NULL,
    criado_em           TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em       TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_receita_categoria
        FOREIGN KEY (categoria_id) REFERENCES categoria (id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT fk_receita_cozinheiro
        FOREIGN KEY (cozinheiro_id) REFERENCES funcionario (id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE receita_ingrediente (
    receita_id      INT UNSIGNED    NOT NULL,
    ingrediente_id  INT UNSIGNED    NOT NULL,
    quantidade      DECIMAL(8,2)    NOT NULL,
    medida_id       INT UNSIGNED    DEFAULT NULL,
    PRIMARY KEY (receita_id, ingrediente_id),
    CONSTRAINT fk_ri_receita
        FOREIGN KEY (receita_id) REFERENCES receita (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_ri_ingrediente
        FOREIGN KEY (ingrediente_id) REFERENCES ingrediente (id)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_ri_medida
        FOREIGN KEY (medida_id) REFERENCES medida (id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- DEGUSTAÇÃO
-- ============================================

CREATE TABLE degustacao (
    id              INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nota            DECIMAL(3,1)    NOT NULL,
    data            DATE            NOT NULL,
    receita_id      INT UNSIGNED    NOT NULL,
    degustador_id   INT UNSIGNED    NOT NULL,
    criado_em       TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    CONSTRAINT fk_degustacao_receita
        FOREIGN KEY (receita_id) REFERENCES receita (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_degustacao_degustador
        FOREIGN KEY (degustador_id) REFERENCES funcionario (id)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- LIVROS
-- ============================================

CREATE TABLE livro (
    id          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
    nome        VARCHAR(100)    NOT NULL,
    editora     VARCHAR(100)    DEFAULT NULL,
    autor       VARCHAR(100)    DEFAULT NULL,
    criado_em   TIMESTAMP       NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE livro_receita (
    livro_id    INT UNSIGNED    NOT NULL,
    receita_id  INT UNSIGNED    NOT NULL,
    PRIMARY KEY (livro_id, receita_id),
    CONSTRAINT fk_lr_livro
        FOREIGN KEY (livro_id) REFERENCES livro (id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_lr_receita
        FOREIGN KEY (receita_id) REFERENCES receita (id)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- SEED: admin padrão
-- senha: admin123 (bcrypt)
-- ============================================

INSERT INTO cargo (nome, descricao) VALUES
    ('Administrador', 'Acesso total ao sistema'),
    ('Cozinheiro', 'Criação e gestão de receitas'),
    ('Degustador', 'Avaliação de receitas');

INSERT INTO funcionario (nome, email, senha, role, cargo_id, dt_admissao) VALUES (
    'Administrador',
    'admin@acervo.com',
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin',
    1,
    CURDATE()
);

INSERT INTO medida (descricao) VALUES
    ('grama'),
    ('kg'),
    ('ml'),
    ('litro'),
    ('colher de chá'),
    ('colher de sopa'),
    ('xícara'),
    ('unidade'),
    ('pitada'),
    ('a gosto');