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
    <title>Login</title>
    <link rel="stylesheet" href="../css/TelaCadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <main>
        <div id="lado_esquerdo"></div>  
        <div id="lado_direito">
            <form action="../../BACK-END/RegistroUsuario.php" method="post">
                <h1>Registra-se</h1>
                <p>Será necessario fornecer as seguintes informações:</p>

                <?php if (!empty($mensagem_registro)): ?>
                <div style="color: <?php echo ($tipo_mensagem === 'sucesso' ? 'green' : 'red'); ?>;">
                    <?php echo $mensagem_registro; ?>
                </div>
                <?php endif; ?>

                <label for="email"> Informe seu Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="email">Confirme seu Email:</label>
                <input type="email" id="email" name="email" placeholder="Informe seu email" required>


                <label for="senha">Informe sua Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="senha" required>

                <label for="senha">Confirme sua Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Informe sua senha" required>        

                <div class="botoes">
                    <button type="button" class="cancelar"><a href="../html/index.html">Cancelar</a></button>
                    <button type="submit" class="confirmar">Confirmar</button>
                </div> 
            </form>
        </div>  
    </main>
</body>