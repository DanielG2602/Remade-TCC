<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/FormCargos.css" /> <title>Cadastro/Edição de Livro</title>
    <style>
        /* Optional: Add specific styles if FormCargos.css doesn't cover everything or you want distinct look */
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container textarea { /* Added textarea for potentially longer descriptions */
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container textarea {
            resize: vertical;
            min-height: 80px;
        }
        .form-container .botoes {
            text-align: right;
            margin-top: 20px;
        }
        .form-container .botoes button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            text-decoration: none; /* For the 'a' inside button */
            display: inline-block;
        }
        .form-container .botoes .cancelar {
            background-color: #6c757d;
            color: white;
            margin-right: 10px;
        }
        .form-container .botoes .cancelar a {
            color: white;
            text-decoration: none;
        }
        .form-container .botoes .confirmar {
            background-color: #007bff;
            color: white;
        }
        .form-container .botoes .confirmar a {
            color: white;
            text-decoration: none;
        }
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
            <?php
            include_once '../../BACK-END/conexao.php'; // Adjust path if needed

            $idLivro = null;
            $titulo = '';
            $fkEditor = '';
            $isbn = '';
            $form_action_text = 'Criar';
            $form_title = 'Cadastro de Livro';

            // Check if an ID is passed for editing
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $idLivro = htmlspecialchars($_GET['id']);
                $form_action_text = 'Atualizar';
                $form_title = 'Editar Livro';

                try {
                    $stmt = $pdo->prepare("SELECT idLivro, FKeditor, titulo, isbn FROM Livro WHERE idLivro = :id");
                    $stmt->bindParam(':id', $idLivro, PDO::PARAM_INT);
                    $stmt->execute();
                    $livro_data = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($livro_data) {
                        $titulo = $livro_data['titulo'];
                        $fkEditor = $livro_data['FKeditor'];
                        $isbn = $livro_data['isbn'];
                        // If you had a 'descricao' column, you'd fetch it here too.
                    } else {
                        // Book not found, redirect or show error
                        header('Location: telaLivros.php?status=erro&msg=Livro+não+encontrado');
                        exit();
                    }
                } catch (PDOException $e) {
                    error_log("Erro ao buscar dados do livro para edição: " . $e->getMessage());
                    header('Location: telaLivros.php?status=erro&msg=Erro+ao+carregar+dados+do+livro');
                    exit();
                }
            }
            ?>

            <h2><?php echo $form_title; ?></h2>

            <form action="../../BACK-END/processar_livro.php" method="POST">
                <?php if ($idLivro): ?>
                    <input type="hidden" name="idLivro" value="<?php echo htmlspecialchars($idLivro); ?>" />
                <?php endif; ?>

                <label for="titulo">Título do Livro:</label>
                <input type="text" name="titulo" id="titulo"
                       placeholder="Digite o título do livro"
                       value="<?php echo htmlspecialchars($titulo); ?>" required />

                <label for="fk_editor">ID do Editor (FKeditor):</label>
                <input type="number" name="fk_editor" id="fk_editor"
                       placeholder="Digite o ID do editor"
                       value="<?php echo htmlspecialchars($fkEditor); ?>" required />

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