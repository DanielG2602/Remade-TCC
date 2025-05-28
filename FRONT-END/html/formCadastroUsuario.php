<?php

session_start(); 


$mensagem_registro = '';
$tipo_mensagem = ''; 

if (isset($_SESSION['mensagem_registro'])) {
    $mensagem_registro = $_SESSION['mensagem_registro'];
    $tipo_mensagem = $_SESSION['tipo_mensagem'] ?? 'erro';
    unset($_SESSION['mensagem_registro']); 
    unset($_SESSION['tipo_mensagem']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="css/cadastro.css"> </head>
<body>
    <div id="div_lado_esquerdo"></div>
    <div id="div_lado_direito">
        <form action="../BACK-END/RegistroUsuario.php" method="POST">
            <h1>Registre-se para criar sua conta.</h1>

            <?php if (!empty($mensagem_registro)): ?>
                <div style="color: <?php echo ($tipo_mensagem === 'sucesso' ? 'green' : 'red'); ?>;">
                    <?php echo $mensagem_registro; ?>
                </div>
            <?php endif; ?>

            <label for="email">Informe seu Email:</label>
            <input type="email" id="email" name="email" placeholder="Informe seu email" required>

            <label for="confirmar_email">Confirme seu Email:</label>
            <input type="email" id="confirmar_email" name="confirmar_email" placeholder="Confirme seu email" required>

            <label for="senha">Crie sua Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Crie sua senha" required>

            <label for="confirmar_senha">Confirme sua Senha:</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" required>

            <div class="botoes">
                <button type="submit">Cadastrar</button>
            </div>
            <p>Já tem uma conta? <a href="FormLogin.php">Faça login aqui</a>.</p>
        </form>
    </div>
</body>
</html>