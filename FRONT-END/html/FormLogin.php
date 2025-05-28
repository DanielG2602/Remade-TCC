<?php

session_start(); 

$erro_login = '';
if (isset($_SESSION['erro_login'])) {
    $erro_login = $_SESSION['erro_login'];
    unset($_SESSION['erro_login']); 
}

if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    </head>
<body>
    <div id="div_lado_esquerdo"></div>
    <div id="div_lado_direito">
        <form action="../BACK-END/ValidaUsuario.php" method="POST">
            <h1>Preencha os campos abaixo para acessar sua conta.</h1>

            <?php if (!empty($erro_login)): ?>
                <div style="color: red;"><?php echo $erro_login; ?></div>
            <?php endif; ?>

            <label for="email">Informe seu Email:</label>
            <input type="email" id="email" name="email" placeholder="Informe seu email" required>

            <label for="senha">Informe sua senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Informe sua senha" required>

            <div class="botoes">
                <button type="submit">Entrar</button>
            </div>
            <p>Não tem uma conta? <a href="FormCadastroUsuario.php">Cadastre-se aqui</a>.</p>
        </form>
    </div>
</body>
</html>