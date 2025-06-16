<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/FormLivros.css" /> <title>Cadastro/Edição de Livro</title>
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
        <div class="form-container">
            <h2><?php echo $form_title; ?></h2>

            <form action="../../BACK-END/processar_livro.php" method="POST">
                <?php if ($idLivro): ?>
                    <input type="hidden" name="idLivro" value="<?php echo htmlspecialchars($idLivro); ?>" />
                <?php endif; ?>

                <label for="titulo">Título do Livro:</label>
                <input type="text" name="titulo" id="titulo"
                       placeholder="Digite o título do livro"
                       value="<?php echo htmlspecialchars($titulo); ?>" required />
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn"
                       placeholder="Digite o ISBN do livro"
                       value="<?php echo htmlspecialchars($isbn); ?>" />

                <div class="botoes">
                    <button type="button" class="cancelar"><a href="telaLivros.php">Cancelar</a></button>
                    <button type="submit" class="confirmar"><?php echo $form_action_text; ?></button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>