<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "acervorct";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $manter_conectado = isset($_POST['manter_conectado']);

  
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $stmt = $pdo->prepare("SELECT id, senha FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {

                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_logado'] = true;


                if ($manter_conectado) {
                    $token = bin2hex(random_bytes(32)); // Gera um token seguro
                    $expiry = time() + (30 * 24 * 3600); // Validade de 30 dias
                    setcookie('lembrar_usuario', $token, $expiry, '/', '', true, true);


                    $stmt_token = $pdo->prepare("UPDATE usuarios SET token_lembrar = :token WHERE id = :id");
                    $stmt_token->bindParam(':token', $token);
                    $stmt_token->bindParam(':id', $usuario['id']);
                    $stmt_token->execute();
                }

                header("Location: index.php");
                exit();
            } else {

                $erro = "Senha incorreta.";
            }
        } else {

            $erro = "Usuário não encontrado.";
        }
    } else {
        
        $erro = "Formato de email inválido.";
    }


    if (isset($erro)) {
        echo "<p style='color:red;'>$erro</p>";
    }
}
?>