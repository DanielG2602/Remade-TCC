<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'] ?? '';
    $novaSenha = $_POST['nova_senha'] ?? '';
    $confirmaSenha = $_POST['confirma_senha'] ?? '';

    $erros = [];
    require_once '../conexao.php';

    
    $stmt = $pdo->prepare("SELECT user_id FROM redefinicao_senhas WHERE token = ? AND expires_at > NOW()");
    $stmt->execute([$token]);
    $redefinicao = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$redefinicao) {
        $erros[] = "Token de redefinição inválido ou expirado. Por favor, solicite um novo link.";
    } else {
        $idUsuario = $redefinicao['user_id'];
        if (empty($novaSenha) || empty($confirmaSenha)) {
            $erros[] = "Por favor, preencha ambos os campos de senha.";
        } elseif ($novaSenha !== $confirmaSenha) {
            $erros[] = "As senhas não correspondem.";
        }

        
        if (strlen($novaSenha) < 8) {
            $erros[] = "A senha deve ter pelo menos 8 caracteres.";
        }
        if (!preg_match("/[A-Z]/", $novaSenha)) {
            $erros[] = "A senha deve conter pelo menos uma letra maiúscula.";
        }
        if (!preg_match("/[a-z]/", $novaSenha)) {
            $erros[] = "A senha deve conter pelo menos uma letra minúscula.";
        }
        if (!preg_match("/[0-9]/", $novaSenha)) {
            $erros[] = "A senha deve conter pelo menos um número.";
        }
        if (!preg_match("/[^a-zA-Z0-9]/", $novaSenha)) {
            $erros[] = "A senha deve conter pelo menos um caractere especial.";
        }

        if (count($erros) === 0) {

            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

      
            $stmtUpdate = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE id = ?");
            $stmtUpdate->execute([$senhaHash, $idUsuario]);

            $stmtDeleteToken = $pdo->prepare("DELETE FROM redefinicao_senhas WHERE token = ?");
            $stmtDeleteToken->execute([$token]);

            echo "Senha redefinida com sucesso! Você pode fechar esta página e tentar fazer login.";
            header("Location: login.php?sucesso=redefinido");
         exit();
        }
    }

    if (count($erros) > 0) {
        echo "<h3>Erros:</h3><ul>";
        foreach ($erros as $erro) {
            echo "<li>" . htmlspecialchars($erro) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Lógica de redefinição de senha simulada. Inclua suas conexões com o banco de dados e regras de validação.";
        echo "<br>Senha validada e hash gerado (se não houvesse erros).";
    }

} else {
    echo "Requisição inválida.";
}
?>