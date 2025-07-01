<?php
// Inicia ou retoma a sessão.
// Sempre no topo do arquivo, antes de qualquer saída HTML.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variáveis para controlar o que será exibido
$is_logged_in = isset($_SESSION['usuario_id']);
$is_admin = ($is_logged_in && isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin');
$username_display = $is_logged_in ? htmlspecialchars($_SESSION['usuario_email']) : 'Visitante'; // Usando o email para display, pode ser o nome se você tiver

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <title>Home | Sistema RCBR</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">RCBR</a></li>
                <li><a href="FormReceitas.php">Receitas</a></li>
                <li><a href="./GerenciarCargos.php">Cargos</a></li> <li><a href="./ListarFuncionarios.php">Funcionarios</a></li> <li class="divider">|</li>
                <li><a href="./ListarRestaurante.php">Restaurantes</a></li>

                <li class="user-section">
                    <?php if ($is_logged_in): // Se o usuário está logado ?>
                        <a href="#" class="user-name"><?php echo $username_display; ?></a>
                        <div class="user-dropdown-content">
                            <?php if ($is_admin): // Se o usuário é um administrador ?>
                                <a href="./PainelADM.php" class="btn-painel-adm">Painel ADM</a>
                            <?php endif; ?>
                            <p>Logado como: <?php echo $username_display; ?></p>
                            <form action="../../BACK-END/ADM/logout.php" method="POST">
                                <button type="submit">Sair</button>
                            </form>
                        </div>
                    <?php else: // Se o usuário NÃO está logado, mostre link de login ?>
                        <a href="./FormLogin.php" class="user-name">Login / Cadastro</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="containerHome">
            <h1>Bem Vindo ao Sistema RCBR</h1>
            <div id="infoPrincipal">
                <div id="ladoEsquerdo">
                    <p>
                        Sistema Criado em proposito para vizualizar Livros/receitas de acordo com sua permissão de usuario.
                        O sistema tambem permite avaliar receitas, cadastra receitas criadas por Chefe de Cozinha
                    </p>
                    <div class="botoes">
                        <button class="btn-azul"><a href="telaLivros.php">VISUALIZAR LIVROS</a></button>
                        <button class="btn-azul"><a href="formLivros.php">REGISTRAR LIVRO</a></button>
                    </div>
                </div>
                <div id="ladoDireito"></div>
            </div>
        </section>
    </main>
</body>
</html>