<?php
require_once '../../conexao.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['usuario_email'])) {
    
    $_SESSION['erro_login'] = "Você precisa estar logado para acessar esta página.";
    header('Location: ../../FRONT-END/html/FormLogin.php');
    exit();
}


try {
    $pdo = conn(); 

    $stmt = $pdo->prepare("SELECT nivel_acesso FROM `usuarios` WHERE id = :id");
    $stmt->bindParam(':id', $_SESSION['usuario_id'], PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario || $usuario['nivel_acesso'] !== 'admin') {
        
        $_SESSION['erro_acesso'] = "Você não tem permissão para acessar esta área.";
        header('Location: ../../FRONT-END/html/index.php'); 
        exit();
    }

} catch (PDOException $e) {

    error_log("Erro de permissão no admin: " . $e->getMessage());
    $_SESSION['erro_acesso'] = "Ocorreu um erro interno ao verificar suas permissões. Tente novamente mais tarde.";
    header('Location: ../../FRONT-END/html/index.php');
    exit();
}
?>