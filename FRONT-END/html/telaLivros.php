<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Gerenciar Livros</title> <link rel="stylesheet" href="../css/telaLivros.css" />
    <style>
        /* Basic styles for the new buttons for quick visualization */
        .action-button {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: white;
            font-size: 0.9em;
            text-align: center;
        }
        .add-button { background-color: #28a745; } /* Green */
        .edit-button { background-color: #007bff; } /* Blue */
        .delete-button { background-color: #dc3545; } /* Red */
        .add-new-button {
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <button>LIVROS</button>
        <button>RECEITAS</button>
        <button>FUNCIONARIOS</button>
        <button>CHEFES DE COZINHAS</button>
        <div class="dropdown">
            <button>RESTAURANTES ▼</button>
        </div>
        <button class="usuario">USUÁRIO</button>
    </header>

    <main class="main-content">
        <h1>LIVROS:</h1>
        <p>Gerenciamento de Livros Registrados no sistema</p>

        <a href="formLivros.php" class="action-button add-button add-new-button">Incluir Novo Livro</a>

        <div class="card-container">
            <?php
            include_once '../../BACK-END/conexao.php'; 

            try {
             
                $sql = "SELECT idLivro, titulo, isbn FROM Livro ORDER BY titulo ASC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();


                $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($livros) {
                    foreach ($livros as $livro) {
                        ?>
                        <div class="card">
                            <div class="image-placeholder">
                                </div>
                            <div class="card-content">
                                <h2><?php echo htmlspecialchars($livro['titulo']); ?></h2>
                                <p>ISBN: <?php echo htmlspecialchars($livro['isbn'] ?? 'N/A'); ?></p>

                                <div class="card-actions">
                                    <a href="formLivro.php?id=<?php echo htmlspecialchars($livro['idLivro']); ?>" class="action-button edit-button">Editar</a>
                                    <a href="../../BACK-END/excluir_livro.php?id=<?php echo htmlspecialchars($livro['idLivro']); ?>"
                                       class="action-button delete-button"
                                       onclick="return confirm('Tem certeza que deseja excluir o livro: <?php echo htmlspecialchars($livro['titulo']); ?>?');">
                                       Excluir
                                    </a>
                                    <a href="avaliarLivro.php?id=<?php echo htmlspecialchars($livro['idLivro']); ?>" class="action-button">Avaliar →</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>Nenhum livro registrado no momento. Clique em "Incluir Novo Livro" para adicionar um.</p>';
                }

            } catch (PDOException $e) {
                echo '<p style="color: red;">Erro ao carregar os livros: ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
            ?>
        </div>

        <div class="dots">
            <span class="dot active"></span>
            <span class="dot"></span>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
