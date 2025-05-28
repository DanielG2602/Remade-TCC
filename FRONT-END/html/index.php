<?php

session_start(); 

if (!isset($_SESSION['usuario_id'])) {

    $_SESSION['erro_login'] = "Você precisa estar logado para acessar esta página.";
    header('Location: FormLogin.php'); // FormLogin.php está na mesma pasta 'html'
    exit();
}


$usuario_email = $_SESSION['usuario_email'] ?? 'Usuário'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css"> <title>Home | Sistema RCBR</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Livros</a></li>
                <li><a href="#">Receitas</a></li>
                <li><a href="#">Funcionários</a></li>
                <li><a href="#">Chefes de Cozinha</a></li>
                <li class="divider">|</li>
                <li><a href="ListaRestaurantes.php">Restaurantes</a></li> <li>
                    <button class="btn-user">
                        <?php echo htmlspecialchars($usuario_email); ?> </button>
                    <form action="../../logout.php" method="POST" style="display:inline;">
                        <button type="submit" class="btn-user" style="margin-left: 10px;">Sair</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="containerHome">
            <h1>BEM VINDO AO SISTEMA RCBR, <?php echo htmlspecialchars($usuario_email); ?>!</h1>
            <div id="infoPrincipal">
                <div id="ladoEsquerdo">
                    <p>
                        O Sistema RCBR é uma plataforma integrada para organização de receitas, livros e gestão de restaurantes. Explore nossos recursos e facilite o dia a dia da sua cozinha.
                    </p>
                    <div class="botoes">
                        <button class="btn-azul">Visualizar Livros</button>
                        <button class="btn-azul">Cadastrar Livro</button>
                    </div>
                </div>
                <div id="ladoDireito" aria-hidden="true"></div>
            </div>
        </section>
    </main>
</body>
</html>