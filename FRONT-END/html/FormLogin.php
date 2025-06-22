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
    <link rel="stylesheet" href="../css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div id="lado_esquerdo"></div>
        <div id="lado_direito">
            <form action="../../BACK-END/ADM/ValidaUsuario.php" method="post">
                <h1>Informe os dados de acesso</h1>
                <p>Preencha os campos abaixo para acessar sua conta.</p>

                <?php if (!empty($erro_login)): ?>
                <div style="color: red;"><?php echo $erro_login; ?></div>
                <?php endif; ?>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Informe seu email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Informe sua senha" required>

                <label>
                    <input type="checkbox" name="manter_conectado"> Manter Conectado
                </label>

                <div class="botoes">
                    <button type="button" class="esqueceu-senha"><a href="./FormEsqueceuSenha.php">Esqueceu sua Senha?</a> </button>
                    <button type="submit" class="conectar">Conecta-se</button>

                    <div class="nao-tem-conta"> <p>Não tem uma conta?</p>
                    </div>
                    <button type="button" class="criar-conta-button"><a href="./formCadastroUsuario.php">Criar conta</a></button>
                </div>

            </form>
        </div>
    </main>
</body>
</html>