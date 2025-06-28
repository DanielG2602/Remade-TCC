<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastroReceita.css">
    <title>Home | Sistema RCBR</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="telaLivros.php">Livros</a></li> <li>
                <li><a href="#">Funcionários</a></li>
                <li><a href="#">Chefes de Cozinha</a></li>
                <li class="divider">|</li>
                <li><a href="#">Restaurantes</a></li>
                <li><button class="btn-user">USUÁRIO</button></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="../../BACK-END/receitas.php" method="get">
            <h2>Cadastrar Receita</h2>
            <label for="nome_chefe">Nome do Chefe:</label>
            <input type="text" id="nome_chefe" name="nome_chefe" placeholder="Digite o nome do chefe" required>
    
            <label for="restaurante">Restaurante:</label>
            <input type="text" id="restaurante" name="restaurante" placeholder="Nome do restaurante" required>
    
            <label for="nome_livro">Nome do Livro:</label>
            <input type="text" id="nome_livro" name="nome_livro" placeholder="Nome do livro" required>
    
            <label for="data_criacao">Data da Criação da Receita:</label>
            <input type="date" id="data_criacao" name="data_criacao" required>
    
            <label for="ingredientes">Ingredientes:</label>
            <textarea id="ingredientes" name="ingredientes" placeholder="Liste os ingredientes" rows="4" required></textarea>
    
            <label for="modo_preparo">Modo de Preparo:</label>
            <textarea id="modo_preparo" name="modo_preparo" placeholder="Descreva o modo de preparo" rows="4" required></textarea>
    
            <label for="descricao">Receita (Descrição da Receita):</label>
            <textarea id="descricao" name="descricao" placeholder="Descrição geral da receita" rows="3" required></textarea>
    
            <div class="botoes">
                <button type="button" class="cancelar">Cancelar</button>
                <button type="submit" class="confirmar">Confirmar</button>
            </div>
        </form>
    </main>
    
</body>
</html>
