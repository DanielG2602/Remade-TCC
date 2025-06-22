<?php

require_once '../../BACK-END/ADM/autenticacaoAdmin.php'; 

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
    <link rel="stylesheet" href="../../FRONT-END/css/admin.css"> <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, Administrador <?php echo htmlspecialchars($_SESSION['usuario_email']); ?>!</h1>

        <div class="info-box">
            Este é o painel de administração. Aqui você pode gerenciar os usuários, conteúdos e outras configurações do site.
        </div>

        <nav>
            <ul class="menu-admin">
                <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
                </ul>
        </nav>

        <p>Use o menu acima para navegar pelas seções do painel.</p>

        <div class="logout-link">
            <a href="../../BACK-END/ADM/logout.php">Sair</a>
        </div>
    </div>
</body>
</html>