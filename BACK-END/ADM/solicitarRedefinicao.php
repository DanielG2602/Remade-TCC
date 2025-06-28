<?php
// Exemplo: ../../BACK-END/ADM/solicitarRedefinicao.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, insira um e-mail válido.";
        exit();
    }

    require_once '../conexao.php'; 
    $pdo = conn(); 
    $stmt = $pdo->prepare("SELECT id, nomeUser FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $idUsuario = $usuario['id'];
        $nomeUsuario = $usuario['nomeUser'];

        $token = bin2hex(random_bytes(32)); 
        $expiraEm = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expira em 1 hora

        $stmt = $pdo->prepare("INSERT INTO redefinicao_senhas (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$idUsuario, $token, $expiraEm]);


        $linkRedefinicao = "http://seusite.com/pagina_redefinir_senha.php?token=" . $token;

        $assunto = "Redefinição de Senha - Seu Aplicativo";
        $mensagem = "Olá " . htmlspecialchars($nomeUsuario) . ",\n\n";
        $mensagem .= "Recebemos uma solicitação para redefinir sua senha. ";
        $mensagem .= "Clique no link abaixo para criar uma nova senha:\n\n";
        $mensagem .= $linkRedefinicao . "\n\n";
        $mensagem .= "Este link expirará em 1 hora.\n";
        $mensagem .= "Se você não solicitou esta redefinição, por favor, ignore este e-mail.\n\n";
        $mensagem .= "Atenciosamente,\nSua Equipe";

        echo "Se o e-mail estiver registrado em nosso sistema, um link de redefinição foi enviado para " . htmlspecialchars($email) . ".";

    } else {
        echo "Se o e-mail estiver registrado em nosso sistema, um link de redefinição foi enviado para " . htmlspecialchars($email) . ".";
    }
    echo "Lógica de envio de e-mail e geração de token simulada. Verifique o console ou a saída para detalhes.";
    echo "<br>Você precisará implementar a conexão com o banco de dados e o envio de e-mail real.";


} else {
    echo "Requisição inválida.";
}
?>