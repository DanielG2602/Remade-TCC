<?php
// RegistroLogin.php
session_start();
require_once 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    // Validação básica
    if (empty($email) || empty($senha)) {
        $_SESSION['erro_login'] = "Por favor, preencha todos os campos.";
        header('Location: ../FRONT-END/html/FormLogin.php');
        exit();
    }

    // Validação de formato de e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['erro_login'] = "E-mail inválido.";
        header('Location: ../FRONT-END/html/FormLogin.php');
        exit();
    }

    try {
        // Prepare a consulta para buscar o usuário pelo e-mail
        $stmt = $pdo->prepare("SELECT idusuario, Email, Senha FROM `Usuario` WHERE Email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['Senha'])) {
            // Login bem-sucedido: Armazena informações do usuário na sessão
            $_SESSION['usuario_id'] = $usuario['idusuario'];
            $_SESSION['usuario_email'] = $usuario['Email'];


            header('Location: ../FRONT-END/html/index.php'); 
            exit();
        } else {
            // Credenciais inválidas
            $_SESSION['erro_login'] = "E-mail ou senha incorretos.";
            header('Location: ../FRONT-END/html/FormLogin.php');
            exit();
        }
    } catch (PDOException $e) {
        // Erro no banco de dados
        error_log("Erro no login: " . $e->getMessage()); // Registra o erro no log do servidor
        $_SESSION['erro_login'] = "Ocorreu um erro ao tentar fazer login. Por favor, tente novamente mais tarde.";
        header('Location: ../FRONT-END/html/FormLogin.php');
        exit();
    }
} else {
    
    header('Location: ../FRONT-END/html/FormLogin.php');
    exit();
}
?>