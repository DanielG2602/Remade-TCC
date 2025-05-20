<?php

session_start();
include_once '../conexão/conexão.php';

function verificarCredenciais($email, $senha) {
    try {
        $pdo = conn();
        if (!$pdo) {
            throw new PDOException("Falha na conexão com o banco de dados.");
        }
        $sql = "SELECT idUsuario, nomeUsuario, senhaHash FROM RC_Usuario WHERE emailUsuario = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $usuario['senhaHash'])) {
                return $usuario;
            } else {

                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log("Erro na verificação de usuário: " . $e->getMessage());
        return null; 
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $_SESSION['erro_login'] = "Por favor, preencha todos os campos.";
        header("Location: login.php");
        exit();
    }

    $usuario = verificarCredenciais($email, $senha);

    if ($usuario) {
        $_SESSION['id_usuario'] = $usuario['idUsuario'];
        $_SESSION['nome_usuario'] = $usuario['nomeUsuario'];
        header("Location: painel.php");
        exit();
    } else {
        $_SESSION['erro_login'] = "Email ou senha incorretos.";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

echo'oi'
?>