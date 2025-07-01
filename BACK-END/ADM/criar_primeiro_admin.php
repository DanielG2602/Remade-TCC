<?php


require_once '../conexao.php'; // Ajuste o caminho para o seu arquivo de conexão

$email_admin = 'Bossadm@gmail.com'; // 
$senha_admin_texto_puro = 'dagdhafhafhafagfa7'; 
$role_admin = 'admin'; // Não mude este valor, a menos que sua coluna 'role' use outro nome para admin

try {
    $pdo = conn(); 
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro para exceções

    
    $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM `usuarios` WHERE email = :email");
    $stmt_check->bindParam(':email', $email_admin, PDO::PARAM_STR);
    $stmt_check->execute();
    if ($stmt_check->fetchColumn() > 0) {
        echo "<h3>ERRO: O e-mail '$email_admin' já existe no banco de dados.</h3>";
        echo "<p>Por favor, use um e-mail diferente ou verifique se o administrador já foi criado.</p>";
        exit(); 
    }

    
    $hash_senha = password_hash($senha_admin_texto_puro, PASSWORD_DEFAULT);

   
    $stmt_insert = $pdo->prepare("INSERT INTO `usuarios` (email, senha, role) VALUES (:email, :senha, :role)");
    $stmt_insert->bindParam(':email', $email_admin, PDO::PARAM_STR);
    $stmt_insert->bindParam(':senha', $hash_senha, PDO::PARAM_STR);
    $stmt_insert->bindParam(':role', $role_admin, PDO::PARAM_STR);

    if ($stmt_insert->execute()) {
        echo "<h1>Administrador criado com sucesso!</h1>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($email_admin) . "</p>";
        echo "<p><strong>Senha:</strong> (A senha foi hasheada, não exibiremos o texto puro aqui)</p>";
        echo "<p><strong>Nível de Acesso:</strong> " . htmlspecialchars($role_admin) . "</p>";
        echo "<p><strong>Lembre-se de DELETAR ou REMOVER o acesso a este arquivo após a execução bem-sucedida por segurança!</strong></p>";
    } else {
        echo "<h1>Erro ao criar o administrador.</h1>";
        echo "<p>Verifique o log de erros do servidor para mais detalhes.</p>";
    }

} catch (PDOException $e) {
    echo "<h1>Erro de conexão ou SQL:</h1>";
    echo "<p>Detalhes do Erro: " . htmlspecialchars($e->getMessage()) . "</p>";
    error_log("Erro no script de criação de admin: " . $e->getMessage());
}
?>