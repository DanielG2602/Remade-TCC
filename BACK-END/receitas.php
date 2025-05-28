<<?php

// 1. Incluir o arquivo de conexão com o banco de dados
// Ele contém a função conn() que retorna um objeto PDO
require_once 'conexao.php'; // Ajuste o caminho se necessário

// 2. Chamar a função conn() para obter o objeto PDO
try {
    $pdo = conn(); // Agora $pdo é seu objeto de conexão PDO
    // Remova a linha "Conexão bem-sucedida!" do conexao.php para não poluir a saída.
} catch (PDOException $e) {
    die("Erro crítico: Não foi possível obter a conexão PDO. " . $e->getMessage());
}

// 3. Processar Dados do Formulário
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nome_chefe = isset($_GET['nome_chefe']) ? $_GET['nome_chefe'] : '';
    $restaurante = isset($_GET['restaurante']) ? $_GET['restaurante'] : '';
    $nome_livro = isset($_GET['nome_livro']) ? $_GET['nome_livro'] : '';
    $data_criacao = isset($_GET['data_criacao']) ? $_GET['data_criacao'] : '';
    $ingredientes = isset($_GET['ingredientes']) ? $_GET['ingredientes'] : '';
    $modo_preparo = isset($_GET['modo_preparo']) ? $_GET['modo_preparo'] : '';
    $descricao = isset($_GET['descricao']) ? $_GET['descricao'] : '';

    // 4. Preparar e Executar a Instrução SQL de Inserção (Usando Prepared Statements com PDO)
    $sql = "INSERT INTO receitas (nome_chefe, restaurante, nome_livro, data_criacao, ingredientes, modo_preparo, descricao) VALUES (?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql); // Usando $pdo->prepare()

        // Vincula os parâmetros à instrução preparada
        // PDO usa bindValue ou bindParam, não 'sssssss'
        $stmt->bindValue(1, $nome_chefe);
        $stmt->bindValue(2, $restaurante);
        $stmt->bindValue(3, $nome_livro);
        $stmt->bindValue(4, $data_criacao);
        $stmt->bindValue(5, $ingredientes);
        $stmt->bindValue(6, $modo_preparo);
        $stmt->bindValue(7, $descricao);

        // Executa a instrução preparada
        if ($stmt->execute()) {
            echo "Receita cadastrada com sucesso!";
            // Opcional: Redirecionar
            // header("Location: ../../Frontend/pages/receitas_lista.php?status=success");
            // exit();
        } else {
            echo "Erro ao cadastrar receita: " . implode(" - ", $stmt->errorInfo());
        }

        // Fechar a instrução preparada (opcional, PDO libera automaticamente na destruição)
        $stmt = null;

    } catch (PDOException $e) {
        die("Erro na operação do banco de dados: " . $e->getMessage());
    }

} else {
    echo "Método de requisição inválido. Por favor, utilize o formulário de cadastro.";
}

// 5. Fechar a Conexão com o Banco de Dados
// Em PDO, a conexão é geralmente fechada definindo o objeto PDO como null.
$pdo = null;

?>

