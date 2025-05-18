<?php

require_once '../conexão/conexão.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["email"]) && isset($_POST["confirmar_email"]) &&
        isset($_POST["senha"]) && isset($_POST["confirmar_senha"])
    ) {
        $email = trim($_POST["email"]);
        $confirmar_email = trim($_POST["confirmar_email"]);
        $senha = $_POST["senha"];
        $confirmar_senha = $_POST["confirmar_senha"];

        // Validação de formato de e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color: red;'>E-mail inválido.</p>";
            exit;
        }

        // Validar se os emails coincidem
        if ($email !== $confirmar_email) {
            echo "<p style='color: red;'>Os emails não coincidem.</p>";
            exit;
        }

        // Validar se as senhas coincidem
        if ($senha !== $confirmar_senha) {
            echo "<p style='color: red;'>As senhas não coincidem.</p>";
            exit;
        }

        // Criptografar a senha
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

        try {
            // Preparar a consulta SQL para inserir dados na tabela usuario
            $stmt = $conexao->prepare("INSERT INTO Usuario (Email, Senha) VALUES (:email, :senha)");

            // Vincular os parâmetros
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha_criptografada);

            // Executar a consulta
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Usuário registrado com sucesso!</p>";
            } else {
                echo "<p style='color: red;'>Erro ao registrar o usuário.</p>";
            }

        } catch(PDOException $e) {
            echo "<p style='color: red;'>Erro no banco de dados: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Por favor, preencha todos os campos do formulário.</p>";
    }
} else {
    echo "<p style='color: yellow;'>Este script só aceita requisições POST.</p>";
}
?>