<?php

require_once './conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome_restaurante = $_POST['nome'] ?? '';
    $contato_restaurante = $_POST['contato'] ?? '';
    $telefone_restaurante = $_POST['telefone'] ?? '';

    // 1. Validar os dados recebidos
    if (empty($nome_restaurante) || empty($contato_restaurante) || empty($telefone_restaurante)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios!');</script>";
        echo "<script>window.location.href = '../FRONT-END/html/FormRestaurante.php';</script>";
        exit();
    }

    try {
        $pdo = conn(); 
        $stmt = $pdo->prepare("INSERT INTO restaurante (idRestaurante, nome, contato, telefone) VALUES (NULL, :nome, :contato, :telefone)");
        $stmt->execute([
            ':nome' => $nome_restaurante,
            ':contato' => $contato_restaurante,
            ':telefone' => $telefone_restaurante
        ]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Restaurante \\\"" . htmlspecialchars($nome_restaurante) . "\\\" adicionado com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao adicionar o restaurante. Nenhuma linha afetada.');</script>";
        }

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao adicionar restaurante: " . htmlspecialchars($e->getMessage()) . "');</script>";
    }

    echo "<script>window.location.href = '../FRONT-END/html/listarRestaurante.php';</script>";
    exit();

} else {
    header('Location: ../FRONT-END/html/FormRestaurante.php');
    exit();
}
?>