<?php

require_once 'conexao.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $confirmar_email = filter_input(INPUT_POST, 'confirmar_email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    $erros = [];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O email é inválido.";
    } elseif ($email !== $confirmar_email) {
        $erros[] = "Os emails não coincidem.";
    } else {
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();
        if ($stmt_check->fetchColumn() > 0) {
            $erros[] = "Este email já está cadastrado.";
        }
    }

    if (empty($senha)) {
        $erros[] = "A senha é obrigatória.";
    } elseif (strlen($senha) < 6) {
        $erros[] = "A senha deve ter pelo menos 6 caracteres.";
    }

    if ($senha !== $confirmar_senha) {
        $erros[] = "A senha e a confirmação de senha não coincidem.";
    }

    if (empty($erros)) {

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);


        $stmt_insert = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
        $stmt_insert->bindParam(':idEmail', $email);
        $stmt_insert->bindParam(':idSenha', $senha_hash);

        if ($stmt_insert->execute()) {
            header("Location: login.php?registro_sucesso=1");
            exit();
        } else {
            $erros[] = "Erro ao registrar o usuário.";
        }
    }


    if (!empty($erros)) {
        foreach ($erros as $erro) {
            echo "<p style='color:red;'>$erro</p>";
        }
    }
}
?>