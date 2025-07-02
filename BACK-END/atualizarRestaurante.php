<?php
$id_restaurante = $_GET['id'] ?? null;
$restaurante_para_editar = null;

// Simulação de dados de restaurantes (os mesmos usados em listar_restaurantes.php)
$restaurantes = [
    ['id' => 1, 'nome' => 'Sabor Divino', 'gerente' => 'Ana Paula', 'menu' => 'Brasileira'],
    ['id' => 2, 'nome' => 'Pizzaria Napolitana', 'gerente' => 'Roberto Carlos', 'menu' => 'Italiana'],
    ['id' => 3, 'nome' => 'Sushi Master', 'gerente' => 'Takashi Sato', 'menu' => 'Japonesa'],
    ['id' => 4, 'nome' => 'O Burger King', 'gerente' => 'João Silva', 'menu' => 'Fast Food'],
];

if ($id_restaurante) {
    // Em um ambiente real, você faria uma consulta SQL: SELECT * FROM restaurantes WHERE id = $id_restaurante
    foreach ($restaurantes as $restaurante) {
        if ($restaurante['id'] == $id_restaurante) {
            $restaurante_para_editar = $restaurante;
            break;
        }
    }
}

// Se o formulário for submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aqui você processaria os dados do formulário
    $novo_nome = $_POST['nome'] ?? '';
    $novo_gerente = $_POST['gerente'] ?? '';
    $novo_menu = $_POST['menu'] ?? '';

    // Em um ambiente real:
    // 1. Validar os dados.
    // 2. Executar um UPDATE no banco de dados:
    //    UPDATE restaurantes SET nome = '$novo_nome', gerente = '$novo_gerente', menu = '$novo_menu' WHERE id = $id_restaurante
    // 3. Redirecionar o usuário de volta para a lista de restaurantes com uma mensagem de sucesso.
    //    header('Location: listar_restaurantes.php?mensagem=sucesso_edicao');
    //    exit();

    echo "<script>alert('Restaurante ID " . htmlspecialchars($id_restaurante) . " editado (simulação)! Novo Nome: " . htmlspecialchars($novo_nome) . "');</script>";
    echo "<script>window.location.href = 'listar_restaurantes.php';</script>"; // Redireciona de volta
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Restaurante</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f4f4f4; }
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
        .back-link { display: block; text-align: center; margin-top: 20px; color: #002D5F; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Editar Restaurante</h1>

        <?php if ($restaurante_para_editar): ?>
            <form action="editar_restaurante.php?id=<?php echo htmlspecialchars($id_restaurante); ?>" method="POST">
                <div>
                    <label for="id">ID do Restaurante:</label>
                    <input type="text" id="id" name="id" value="<?php echo htmlspecialchars($restaurante_para_editar['id']); ?>" disabled>
                </div>
                <div>
                    <label for="nome">Nome do Restaurante:</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($restaurante_para_editar['nome']); ?>" required>
                </div>
                <div>
                    <label for="gerente">Gerente:</label>
                    <input type="text" id="gerente" name="gerente" value="<?php echo htmlspecialchars($restaurante_para_editar['gerente']); ?>" required>
                </div>
                <div>
                    <label for="menu">Menu:</label>
                    <input type="text" id="menu" name="menu" value="<?php echo htmlspecialchars($restaurante_para_editar['menu']); ?>" required>
                </div>
                <button type="submit">Salvar Alterações</button>
                <a href="listar_restaurantes.php" class="back-link" style="display: inline-block; background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px;">Cancelar</a>
            </form>
        <?php else: ?>
            <p style="text-align: center; color: red;">Restaurante não encontrado ou ID inválido.</p>
            <a href="listar_restaurantes.php" class="back-link">Voltar para a lista de Restaurantes</a>
        <?php endif; ?>

    </div>

</body>
</html>