<?php
// C:\xampp\htdocs\RCBR\BACK-END\RegistroUsuario.php
session_start(); // Inicia a sessão PHP para gerenciar mensagens
require_once './conexao.php'; // Inclui o script de conexão com o banco de dados

// Verifica se a requisição é do tipo POST (ou seja, veio de um formulário)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta e sanitiza os dados do formulário
    $email = trim($_POST['email'] ?? '');
    $confirmar_email = trim($_POST['confirmar_email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $confirmar_senha = trim($_POST['confirmar_senha'] ?? '');

    // Validação: Verifica se todos os campos estão preenchidos
    if (empty($email) || empty($confirmar_email) || empty($senha) || empty($confirmar_senha)) {
        $_SESSION['mensagem_registro'] = "Por favor, preencha todos os campos.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php'); // Redireciona de volta ao formulário
        exit();
    }

    // Validação: Verifica o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensagem_registro'] = "E-mail inválido.";
        $_SESSION['tipo_mensagem'] = "erro";
        // Nota: O redirecionamento original estava 'FormCadastroUsuario.php', que é relativo ao backend.
        // Mudei para '../FRONT-END/html/FormCadastroUsuario.php' para consistência, se essa for a estrutura de pastas.
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }

    // Validação: Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        $_SESSION['mensagem_registro'] = "As senhas não coincidem.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }

    // Validação: Verifica o comprimento mínimo da senha
    if (strlen($senha) < 6) {
        $_SESSION['mensagem_registro'] = "A senha deve ter pelo menos 6 caracteres.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }

    try {
        // Verifica se o e-mail já está cadastrado no banco de dados
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `usuario` WHERE Email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            $_SESSION['mensagem_registro'] = "Este e-mail já está cadastrado. Por favor, use outro.";
            $_SESSION['tipo_mensagem'] = "erro";
            header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
            exit();
        }

        // Gera o hash da senha de forma segura
        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

        // Define um valor para JWSL_Funcionario_idFuncionario. Ajuste conforme sua lógica.
        // Atualmente, está fixo em 1.
        $jws_funcionario_id = 1; 

        // Prepara a query SQL para inserir o novo usuário
        $stmt_insert = $pdo->prepare("INSERT INTO `usuario` (Email, Senha, JWSL_Funcionario_idFuncionario) VALUES (:email, :senha, :idFuncionario)");
        // Associa os parâmetros para prevenir SQL Injection
        $stmt_insert->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt_insert->bindParam(':senha', $senha_hashed, PDO::PARAM_STR);
        $stmt_insert->bindParam(':idFuncionario', $jws_funcionario_id, PDO::PARAM_INT);

        // Executa a inserção no banco de dados
        if ($stmt_insert->execute()) {
            $_SESSION['mensagem_registro'] = "Cadastro realizado com sucesso! Agora você pode fazer login.";
            $_SESSION['tipo_mensagem'] = "sucesso";
            header('Location: ../FRONT-END/html/FormLogin.php'); // Redireciona para a página de login após o cadastro
            exit();
        } else {
            // Se a execução falhar (por exemplo, devido a uma restrição do DB não tratada antes)
            $_SESSION['mensagem_registro'] = "Ocorreu um erro ao cadastrar o usuário. Por favor, tente novamente.";
            $_SESSION['tipo_mensagem'] = "erro";
            header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
            exit();
        }

    } catch (PDOException $e) {
        // Captura e registra exceções do PDO (erros de banco de dados)
        error_log("Erro no cadastro: " . $e->getMessage()); // Registra o erro para depuração
        $_SESSION['mensagem_registro'] = "Ocorreu um erro no servidor. Por favor, tente novamente mais tarde.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }
} else {
    // Se o script for acessado diretamente sem um POST (via GET, por exemplo), redireciona para o formulário
    header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
    exit();
}
?>