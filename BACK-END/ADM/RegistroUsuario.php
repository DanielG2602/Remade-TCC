<?php
session_start();

require_once '../conexao.php'; // Ajuste o caminho conforme a estrutura do seu projeto

function redirecionarComMensagem($mensagem, $tipo_mensagem = 'erro') {
    $_SESSION['mensagem_registro'] = $mensagem;
    $_SESSION['tipo_mensagem'] = $tipo_mensagem;
    header('Location: ../../FRONT-END/html/FormCadastroUsuario.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $NomeUser = trim($_POST['NomeUser'] ?? ''); // Corrigido: NomeUser (letra maiúscula)
    $email = trim($_POST['email'] ?? '');
    $confirmar_email = trim($_POST['confirmar_email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Validações
    if (empty($NomeUser) || empty($email) || empty($confirmar_email) || empty($senha) || empty($confirmar_senha)) {
        redirecionarComMensagem('Todos os campos são obrigatórios.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirecionarComMensagem('Formato de e-mail inválido.');
    }

    if ($email !== $confirmar_email) {
        redirecionarComMensagem('Os e-mails não coincidem.');
    }

    if ($senha !== $confirmar_senha) {
        redirecionarComMensagem('As senhas não coincidem.');
    }

    if (strlen($senha) < 6) {
        redirecionarComMensagem('A senha deve ter no mínimo 6 caracteres.');
    }

    // Tenta conectar ao banco uma vez só
    try {
        $pdo = conn(); // conexão com o banco
    } catch (PDOException $e) {
        redirecionarComMensagem('Erro ao conectar ao banco de dados: ' . $e->getMessage());
    }

    // Verifica se o email já existe
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            redirecionarComMensagem('Este e-mail já está em uso. Por favor, escolha outro.');
        }
    } catch (PDOException $e) {
        redirecionarComMensagem('Erro interno ao verificar o e-mail. Tente novamente mais tarde.');
    }

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Tenta registrar o usuário
    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (NomeUser, email, senha) VALUES (:NomeUser, :email, :senha)");
        $stmt->execute([
            'NomeUser' => $NomeUser,
            'email' => $email,
            'senha' => $senha_hash
        ]);

        if ($stmt->rowCount() > 0) {
            redirecionarComMensagem('Registro realizado com sucesso! Agora você pode fazer login.', 'sucesso');
        } else {
            redirecionarComMensagem('Não foi possível registrar o usuário. Tente novamente.');
        }

    } catch (PDOException $e) {
        redirecionarComMensagem('Erro interno ao registrar. Tente novamente mais tarde.');
        // Para depuração: descomente a linha abaixo
        // redirecionarComMensagem('Erro ao registrar: ' . $e->getMessage());
    }

} else {
    header('Location: ../../FRONT-END/html/FormCadastroUsuario.php');
    exit();
}
?>
/*
 *
 * Obs.: Este código foi ajustado após erro de conexão com porta incorreta (3307 em vez de 3306)
 * e problema de variável $pdo sendo usada fora do escopo. Agora o sistema conecta corretamente,
 * valida os dados e cadastra com segurança.
 *
 * 
 *