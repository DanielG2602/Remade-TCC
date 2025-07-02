<?php
// Inclui o arquivo de conexão com o banco de dados
// Se este arquivo (atualizarRestaurante.php) está dentro da pasta BACK-END,
// e conexao.php também está, então o caminho é simplesmente 'conexao.php'.
require_once 'conexao.php';

$id_restaurante = $_GET['id'] ?? null; // Pega o ID da URL
$restaurante_para_editar = null;
$mensagem_erro = '';

// Se o formulário for submetido (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega os dados do formulário
    $id_restaurante_post = $_POST['id_restaurante_hidden'] ?? null; // ID vindo do campo hidden
    $novo_nome = $_POST['nome'] ?? '';
    $novo_contato = $_POST['contato'] ?? '';     // Campo 'contato'
    $novo_telefone = $_POST['telefone'] ?? '';   // Campo 'telefone'

    // Validação básica
    if (empty($id_restaurante_post) || empty($novo_nome) || empty($novo_contato) || empty($novo_telefone)) {
        $mensagem_erro = "Por favor, preencha todos os campos obrigatórios.";
    } else {
        try {
            $pdo = conn(); // Chama a função de conexão definida no arquivo conexao.php
            // Prepara a query de UPDATE
            // As colunas agora são 'nome', 'contato', 'telefone'.
            $stmt = $pdo->prepare("UPDATE restaurante SET nome = :nome, contato = :contato, telefone = :telefone WHERE idRestaurante = :id");
            $stmt->execute([
                ':nome' => $novo_nome,
                ':contato' => $novo_contato,
                ':telefone' => $novo_telefone,
                ':id' => $id_restaurante_post
            ]);

            // Verifica se alguma linha foi afetada
            if ($stmt->rowCount() > 0) {
                // Redireciona de volta para a lista de restaurantes com uma mensagem de sucesso
                echo "<script>alert('Restaurante atualizado com sucesso!');</script>";
                echo "<script>window.location.href = '../FRONT-END/html/listarRestaurante.php';</script>"; // Caminho para listarRestaurantes.php
                exit();
            } else {
                $mensagem_erro = "Nenhuma alteração foi feita ou restaurante não encontrado.";
            }

        } catch (PDOException $e) {
            $mensagem_erro = "Erro ao atualizar restaurante: " . htmlspecialchars($e->getMessage());
            // Em um ambiente de produção, logue o erro: error_log($e->getMessage());
        }
    }
    // Se houve erro no POST, o script continua para exibir o formulário novamente com a mensagem de erro.
}


// Lógica para carregar os dados do restaurante para exibição no formulário
if ($id_restaurante) {
    try {
        $pdo = conn(); 
        $stmt = $pdo->prepare("SELECT idRestaurante, nome, contato, telefone FROM restaurante WHERE idRestaurante = :id");
        $stmt->execute([':id' => $id_restaurante]);
        $restaurante_para_editar = $stmt->fetch();

        if (!$restaurante_para_editar) {
            $mensagem_erro = "Restaurante não encontrado.";
        }
    } catch (PDOException $e) {
        $mensagem_erro = "Erro ao carregar dados do restaurante: " . htmlspecialchars($e->getMessage());
    }
} else {
    $mensagem_erro = "ID do restaurante não fornecido.";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Restaurante</title>
    <style>
        /* Estilos do formulário (mantidos) */
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
        .navbar {
            background-color: #002D5F; /* Azul escuro */
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            padding: 0 15px;
            font-weight: bold;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .navbar .user-btn {
            background-color: #337ab7; /* Azul mais claro para o botão USUÁRIO */
            padding: 8px 15px;
            border-radius: 5px;
        }
        .container { max-width: 600px; margin: 50px auto; padding: 20px; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 8px; }
        h1 { text-align: center; color: #002D5F; margin-bottom: 20px; }
        form div { margin-bottom: 15px; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        form input[type="text"],
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        form button {
            padding: 10px 20px;
            background-color: #002D5F;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        form button:hover { background-color: #001f3f; }
        .back-link {
            display: inline-block; /* Para ficar lado a lado com o botão */
            text-align: center;
            color: white;
            text-decoration: none;
            background-color: #6c757d; /* Cinza para o botão cancelar */
            padding: 10px 20px;
            border-radius: 4px;
        }
        .back-link:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div>
            <a href="#">LIVROS</a>
            <a href="../FRONT-END/html/listar_cargos.php">CARGOS</a>
            <a href="#">FUNCIONÁRIOS</a>
            <a href="../FRONT-END/html/listarRestaurantes.php">RESTAURANTES</a>
        </div>
        <div class="user-btn">
            <a href="#">USUÁRIO</a>
        </div>
    </div>

    <div class="container">
        <h1>Editar Restaurante</h1>

        <?php if ($mensagem_erro): ?>
            <p class="error-message"><?php echo $mensagem_erro; ?></p>
        <?php endif; ?>

        <?php if ($restaurante_para_editar): ?>
            <form action="atualizarRestaurante.php?id=<?php echo htmlspecialchars($restaurante_para_editar['idRestaurante']); ?>" method="POST">
                <input type="hidden" name="id_restaurante_hidden" value="<?php echo htmlspecialchars($restaurante_para_editar['idRestaurante']); ?>">

                <div>
                    <label for="id_display">ID do Restaurante:</label>
                    <input type="text" id="id_display" value="<?php echo htmlspecialchars($restaurante_para_editar['idRestaurante']); ?>" disabled>
                </div>
                <div>
                    <label for="nome">Nome do Restaurante:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($restaurante_para_editar['nome']); ?>" required>
                </div>
                <div>
                    <label for="contato">Contato:</label> <input type="text" id="contato" name="contato" value="<?php echo htmlspecialchars($restaurante_para_editar['contato']); ?>" required>
                </div>
                <div>
                    <label for="telefone">Telefone:</label> <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($restaurante_para_editar['telefone']); ?>" required>
                </div>
                <button type="submit">Salvar Alterações</button>
                <a href="../FRONT-END/html/listarRestaurante.php" class="back-link">Cancelar</a>
            </form>
        <?php else: ?>
            <p style="text-align: center; color: red;">Restaurante não encontrado ou ID inválido.</p>
            <a href="../FRONT-END/html/listarRestaurante.php" class="back-link">Voltar para a lista de Restaurantes</a>
        <?php endif; ?>

    </div>

</body>
</html>