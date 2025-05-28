<?php
// RegistroUsuario.php
session_start();
require_once './conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $confirmar_email = trim($_POST['confirmar_email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');
    $confirmar_senha = trim($_POST['confirmar_senha'] ?? '');

    if (empty($email) || empty($confirmar_email) || empty($senha) || empty($confirmar_senha)) {
        $_SESSION['mensagem_registro'] = "Por favor, preencha todos os campos.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mensagem_registro'] = "E-mail inválido.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: FormCadastroUsuario.php');
        exit();
    }




    if ($senha !== $confirmar_senha) {
        $_SESSION['mensagem_registro'] = "As senhas não coincidem.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }

   
    if (strlen($senha) < 6) {
        $_SESSION['mensagem_registro'] = "A senha deve ter pelo menos 6 caracteres.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }

    try {

        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM `Usuario` WHERE Email = :email");
        $stmt_check->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt_check->execute();
        if ($stmt_check->fetchColumn() > 0) {
            $_SESSION['mensagem_registro'] = "Este e-mail já está cadastrado. Por favor, use outro.";
            $_SESSION['tipo_mensagem'] = "erro";
            header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
            exit();
        }

        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

        
        $jws_funcionario_id = 1; 

        $stmt_insert = $pdo->prepare("INSERT INTO `Usuario` (Email, Senha, JWSL_Funcionario_idFuncionario) VALUES (:email, :senha, :idFuncionario)");
        $stmt_insert->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt_insert->bindParam(':senha', $senha_hashed, PDO::PARAM_STR);
        $stmt_insert->bindParam(':idFuncionario', $jws_funcionario_id, PDO::PARAM_INT); // Ajuste conforme sua lógica

        if ($stmt_insert->execute()) {
            $_SESSION['mensagem_registro'] = "Cadastro realizado com sucesso! Agora você pode fazer login.";
            $_SESSION['tipo_mensagem'] = "sucesso";
            header('Location: ../FRONT-END/html/FormLogin.php'); // Redireciona para a página de login após o cadastro
            exit();
        } else {
            $_SESSION['mensagem_registro'] = "Ocorreu um erro ao cadastrar o usuário. Por favor, tente novamente.";
            $_SESSION['tipo_mensagem'] = "erro";
            header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
            exit();
        }

    } catch (PDOException $e) {
        error_log("Erro no cadastro: " . $e->getMessage()); // Registra o erro
        $_SESSION['mensagem_registro'] = "Ocorreu um erro no servidor. Por favor, tente novamente mais tarde.";
        $_SESSION['tipo_mensagem'] = "erro";
        header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
        exit();
    }
} else {
    header('Location: ../FRONT-END/html/FormCadastroUsuario.php');
    exit();
}
?>