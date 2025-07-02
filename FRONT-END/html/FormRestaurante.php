<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_restaurante = $_POST['nome'] ?? '';
    $gerente_restaurante = $_POST['gerente'] ?? '';
    $menu_restaurante = $_POST['menu'] ?? '';

    // Em um ambiente real, você faria o seguinte:
    // 1. Validar os dados recebidos (ex: verificar se não estão vazios, formato correto, etc.).
    // 2. Conectar-se ao banco de dados.
    // 3. Preparar e executar uma instrução SQL INSERT para adicionar o novo restaurante.
    //    Exemplo (usando PDO):
    //    $stmt = $pdo->prepare("INSERT INTO restaurantes (nome, gerente, menu) VALUES (:nome, :gerente, :menu)");
    //    $stmt->execute([
    //        ':nome' => $nome_restaurante,
    //        ':gerente' => $gerente_restaurante,
    //        ':menu' => $menu_restaurante
    //    ]);
    // 4. Verificar se a inserção foi bem-sucedida.

    // Simulação de salvamento e feedback para o usuário
    echo "<script>alert('Restaurante \\\"" . htmlspecialchars($nome_restaurante) . "\\\" adicionado com sucesso (simulação)!');</script>";

    // Redireciona o usuário de volta para a página de listagem de restaurantes
    // É importante usar exit() após header() para garantir que o script pare de ser executado
    echo "<script>window.location.href = 'listar_restaurantes.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incluir Restaurante</title>
    <style>
        /* Estilos básicos para o formulário */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }
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
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #002D5F;
            margin-bottom: 20px;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        form input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Garante que padding e border não aumentem a largura total */
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
        form button:hover {
            background-color: #001f3f;
        }
        .back-link {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
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
            <a href="listar_cargos.php">CARGOS</a>
            <a href="#">FUNCIONÁRIOS</a>
            <a href="listar_restaurantes.php">RESTAURANTES</a>
        </div>
        <div class="user-btn">
            <a href="#">USUÁRIO</a>
        </div>
    </div>

    <div class="container">
        <h1>Incluir Novo Restaurante</h1>

        <form action="../../BACK-END/restaurante.php" method="POST">
            <div>
                <label for="nome">Nome do Restaurante:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div>
                <label for="gerente">Gerente:</label>
                <input type="text" id="gerente" name="gerente" required>
            </div>
            <div>
                <label for="menu">Menu:</label>
                <input type="text" id="menu" name="menu" required>
            </div>
            <button type="submit">Adicionar Restaurante</button>
            <a href="./listarRestaurantes.php" class="back-link">Cancelar</a>
        </form>
    </div>

</body>
</html>