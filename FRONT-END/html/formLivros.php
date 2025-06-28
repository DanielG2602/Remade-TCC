<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/FormCargos.css" /> <title>Cadastro/Edição de Livro</title>
    <style>
</style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="telaLivros.php">Livros</a></li>
                <li><a href="FormReceitas.php">Receitas</a></li>
                <li><a href="FormFuncionario.php">Funcionários</a></li>
                <li><a href="GerenciarCargos.php">Cargos</a></li> <li class="divider">|</li>
                <li><a href="ListarRestaurante.php">Restaurantes</a></li>
                <li><button class="btn-user">USUÁRIO</button></li>
            </ul>
        </nav>
    </header>
    <main>
    <form action="../../BACK-END/livros.php" method="GET">
      <h2>Cadastro de Livros</h2>

      <label for="Titulo">Titulo do livro:</label>
      <input type="text" name="Titulo" id="Titulo" placeholder="Digite o título do livro" required />

      <label for="Isbn">Descrição do Livro:</label>
      <input type="text" name="Isbn" id="Isbn" placeholder="Descreva o livro" required />
      <div class="botoes">
        <button type="button" class="cancelar"><a href="FormLivros.php">cancelar</a></button>
        <button type="submit" class="confirmar"><a href="" </button>>Criar</a></button>
      </div>
    </form>
  </main>
</body>
</html>