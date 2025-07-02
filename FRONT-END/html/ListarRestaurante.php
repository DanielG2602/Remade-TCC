<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$is_logged_in = isset($_SESSION['usuario_id']);
$is_admin = ($is_logged_in && isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin');
$username_display = $is_logged_in ? htmlspecialchars($_SESSION['usuario_email']) : 'Visitante';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Restaurantes</title>
    <style>
        /* Estilos básicos (mantidos dos exemplos anteriores) */
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #002D5F;
            margin-bottom: 30px;
        }
        .search-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-section form {
            display: flex;
            align-items: center;
            width: 100%; /* Para que o search input e botão fiquem alinhados */
            max-width: 450px; /* Limite de largura para o formulário de busca */
        }
        .search-section input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 70px); /* Ajusta largura para o botão BUSCAR */
            margin-right: 10px;
        }
        .search-section button {
            padding: 10px 20px;
            background-color: #002D5F;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-section button:hover {
            background-color: #001f3f;
        }
        .add-button-container {
            text-align: right;
            margin-bottom: 20px;
            flex-grow: 1; /* Permite que o botão ocupe o espaço restante */
        }
        .add-button-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #002D5F; /* Azul escuro */
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
        .add-button-container a:hover {
            background-color: #001f3f;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #002D5F; /* Azul escuro */
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .action-links .edit {
            background-color: #28a745; /* Verde */
            color: white;
        }
        .action-links .delete {
            background-color: #dc3545; /* Vermelho */
            color: white;
        }
        .action-links .edit:hover {
            background-color: #218838;
        }
        .action-links .delete:hover {
            background-color: #c82333;
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
        <h1>LISTAR RESTAURANTES</h1>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <div class="search-section">
                <form action="listar_restaurantes.php" method="GET">
                    <input type="text" name="pesquisa" placeholder="FAÇA SUA PESQUISA" value="<?php echo htmlspecialchars($_GET['pesquisa'] ?? ''); ?>">
                    <button type="submit">BUSCAR</button>
                </form>
            </div>
            <div class="add-button-container">
                <a href="./FormRestaurante.php">+ INCLUIR RESTAURANTES</a>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NOME DO RESTAURANTE</th>
                    <th>CONTATO</th>
                    <th>TELEFONE</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclui o arquivo de conexão com o banco de dados
                require_once '../../BACK-END/conexao.php'; // Ajuste o caminho se necessário

                $restaurantes_filtrados = [];
                $termo_pesquisa = $_GET['pesquisa'] ?? '';

                try {
                    $pdo = conn(); // Chama a função de conexão definida no arquivo conexao.php
                    // Seleciona idRestaurante (necessário para as ações), nome, contato, telefone
                    $sql = "SELECT idRestaurante, nome, contato, telefone FROM restaurante";
                    $params = [];

                    if ($termo_pesquisa) {
                        $sql .= " WHERE nome LIKE ? OR contato LIKE ? OR telefone LIKE ?";
                        $params = ["%$termo_pesquisa%", "%$termo_pesquisa%", "%$termo_pesquisa%"];
                    }

                    $stmt = $pdo->prepare($sql);
                    $stmt->execute($params);
                    $restaurantes_filtrados = $stmt->fetchAll();

                } catch (PDOException $e) {
                    // O colspan foi ajustado para 4, já que o ID não é mais visível
                    echo "<tr><td colspan='4' style='text-align: center; color: red;'>Erro ao buscar dados do banco de dados: " . $e->getMessage() . "</td></tr>";
                }

                if (!empty($restaurantes_filtrados)) {
                    foreach ($restaurantes_filtrados as $restaurante) {
                        echo "<tr>";
                        // Removido echo "<td>" . htmlspecialchars($restaurante['idRestaurante']) . "</td>";
                        echo "<td>" . htmlspecialchars($restaurante['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($restaurante['contato']) . "</td>";
                        echo "<td>" . htmlspecialchars($restaurante['telefone']) . "</td>";
                        echo "<td class='action-links'>";
                        // Os links de Editar e Excluir continuam usando 'idRestaurante'
                        echo "<a href='../../BACK-END/atualizarRestaurante.php?id=" . htmlspecialchars($restaurante['idRestaurante']) . "' class='edit'>Editar</a>";
                        echo "<a href='../../BACK-END/excluirRestaurante.php?id=" . htmlspecialchars($restaurante['idRestaurante']) . "' class='delete' onclick=\"return confirm('Tem certeza que deseja excluir este restaurante?');\">Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Colspan ajustado para 4, pois há 4 colunas visíveis agora
                    echo "<tr><td colspan='4' style='text-align: center;'>Nenhum restaurante encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>