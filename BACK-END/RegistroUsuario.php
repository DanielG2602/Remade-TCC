<?php
// C:\xampp\htdocs\RCBR\BACK-END\RegistroUsuario.php
session_start();

require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

// Função para redirecionar com mensagem
function redirecionarComMensagem($mensagem, $tipo_mensagem = 'erro') {
    $_SESSION['mensagem_registro'] = $mensagem;
    $_SESSION['tipo_mensagem'] = $tipo_mensagem;
    header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $confirmar_email = trim($_POST['confirmar_email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // 1. Validação dos campos
    if (empty($email) || empty($confirmar_email) || empty($senha) || empty($confirmar_senha)) {
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

    // Você pode adicionar validações mais robustas para a senha, por exemplo:
    // - Mínimo de caracteres
    // - Uso de letras maiúsculas, minúsculas, números e caracteres especiais
    if (strlen($senha) < 6) {
        redirecionarComMensagem('A senha deve ter no mínimo 6 caracteres.');
    }

    // 2. Verificar se o e-mail já existe
    try {
        $pdo = conn(); // Obtém a conexão com o banco de dados
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            redirecionarComMensagem('Este e-mail já está em uso. Por favor, escolha outro.');
        }
    } catch (PDOException $e) {
        // Logar o erro para depuração
        // error_log('Erro ao verificar e-mail: ' . $e->getMessage());
        redirecionarComMensagem('Erro interno ao verificar o e-mail. Tente novamente mais tarde.');
    }

    // 3. Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // 4. Inserir novo usuário no banco de dados
    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
        $stmt->execute([
            'email' => $email,
            'senha' => $senha_hash
        ]);

        if ($stmt->rowCount() > 0) {
            redirecionarComMensagem('Registro realizado com sucesso! Agora você pode fazer login.', 'sucesso');
        } else {
            redirecionarComMensagem('Não foi possível registrar o usuário. Tente novamente.');
        }

    } catch (PDOException $e) {
        // Logar o erro para depuração
        // error_log('Erro ao registrar usuário: ' . $e->getMessage());
        redirecionarComMensagem('Erro interno ao registrar. Tente novamente mais tarde.');
    }

} else {
    // Se o acesso não foi via POST, redireciona para o formulário
    header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
    exit();
}
?>