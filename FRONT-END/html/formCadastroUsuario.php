<?php
// C:\xampp\htdocs\RCBR\FRONT-END\html\FormCadastroUsuario.php
session_start(); // Inicia a sessão para exibir mensagens

$mensagem_registro = '';
$tipo_mensagem = ''; 

if (isset($_SESSION['mensagem_registro'])) {
    $mensagem_registro = $_SESSION['mensagem_registro'];
    $tipo_mensagem = $_SESSION['tipo_mensagem'] ?? 'erro'; // Define 'erro' como padrão se não houver tipo
    unset($_SESSION['mensagem_registro']); // Limpa a mensagem da sessão após exibição
    unset($_SESSION['tipo_mensagem']);    // Limpa o tipo da mensagem da sessão
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/TelaCadastro.css"> <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div id="lado_esquerdo">
            </div> 
        <div id="lado_direito">
            <form action="../../BACK-END/ADM/RegistroUsuario.php" method="post">
                <h1>Registra-se</h1>
                <p>Será necessário fornecer as seguintes informações:</p>

                <?php if (!empty($mensagem_registro)): ?>
                <div style="color: <?php echo ($tipo_mensagem === 'sucesso' ? 'green' : 'red'); ?>; margin-bottom: 15px;">
                    <?php echo htmlspecialchars($mensagem_registro); ?>
                </div>
                <?php endif; ?>

                <label for="NomeUser">Informe seu Nome:</label>
                <input type="text" id="email" name="NomeUser" placeholder="Nome completo" required>

                <label for="email">Informe seu Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="confirmar_email">Confirme seu Email:</label>
                <input type="email" id="confirmar_email" name="confirmar_email" placeholder="Confirme seu email" required>

                <label for="senha">Informe sua Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Senha" required>

                <label for="confirmar_senha">Confirme sua Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" required>        

                <div class="botoes">
                    <button type="button" class="cancelar"><a href="./FormLogin.php">Cancelar</a></button>
                    <button type="submit" class="confirmar"><a href="./FormLogin.php"></a>Confirmar</button>
                </div> 
            </form>
        </div>  
    </main>
</body>
</html>