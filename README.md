# RCBR - Projeto de Faculdade

Este é um projeto acadêmico desenvolvido como parte dos requisitos da faculdade, abrangendo funcionalidades de back-end e front-end para gerenciamento de diversas entidades.

## 🌟 Visão Geral do Projeto

O sistema RCBR é uma aplicação web [ou desktop, se for o caso, mas pelo PHP parece web] que permite [descreva o propósito principal do sistema, por exemplo: "gerenciar informações de funcionários, cargos, restaurantes, receitas, livros e ingredientes, com módulos específicos para administração."].

## 🚀 Funcionalidades Principais

As principais funcionalidades do sistema incluem:

* **Módulo de Administração (ADM):**
    * Gerenciamento de Cargos (CRUD: Criar, Ler, Atualizar, Excluir)
    * Gerenciamento de Funcionários (CRUD)
    * Gerenciamento de Livros (CRUD)
    * Gerenciamento de Receitas (CRUD)
    * Gerenciamento de Restaurantes (CRUD)
    * Gerenciamento de Ingredientes
* **Conexão com Banco de Dados:** Módulo para gerenciar a conexão com o banco de dados.
* **Interface do Usuário (Front-end):**
    * Estrutura de HTML para as páginas.
    * Estilização com CSS.
    * JavaScript,

## 🛠️ Tecnologias Utilizadas

Este projeto foi desenvolvido utilizando as seguintes tecnologias:

* **Back-end:**
    * PHP (para lógica de servidor, manipulação de dados e integração com o banco de dados)
* **Front-end:**
    * HTML (estrutura das páginas web)
    * CSS (estilização e layout)
* **Banco de Dados:**
    * MySQL 

## ⚙️ Como Configurar e Rodar o Projeto

Para configurar e executar o projeto RCBR em seu ambiente local, siga os passos abaixo:

1.  **Configuração do Banco de Dados:**
    * Abra seu gerenciador de banco de dados (ex: phpMyAdmin, MySQL Workbench).
    * Crie um novo banco de dados. O nome pode ser `rcbr_db` ou o que for definido no seu arquivo `conexao.php` (verifique-o).
    * Importe o arquivo `banco.sql` (se disponível no seu repositório ou externamente) para popular o banco de dados com as tabelas necessárias. Se não tiver um `banco.sql` no repositório, você pode criar um script DDL a partir do seu banco atual.
    * Certifique-se de que as credenciais de conexão no seu arquivo `conexao.php` (ou similar) estejam corretas para o seu ambiente local (host, usuário, senha do banco de dados).

2.  **Acessar a Aplicação:**
    * Abra seu navegador e navegue até o URL do projeto no seu servidor local (ex: `http://localhost/RCBR` ou `http://localhost/RCBR/FRONT-END/html/sua_pagina_inicial.php`).

## 🤝 Contribuidores

Este projeto foi desenvolvido em colaboração pelos seguintes estudantes:

* **Matheus Assis** 
* **Davi Souza**
* **Daniel Gomes**
* **Daniel Vitor**
* **Pedro Lucas**

---