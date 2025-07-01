
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css"> <title>Home | Sistema RCBR</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">RCBR</a></li>
                <li><a href="FormReceitas.php">Receitas</a></li>
                <li><a href="./GerenciarCargos.php">Cargos</a></li>
                <li><a href="./ListarFuncionarios.php">Funcionarios</a></li>
                <li class="divider">|</li>
                <li><a href="./ListarRestaurantes.php">Restaurantes</a></li>
                <li class="user-section">
                    <span class="user-name">USUARIO</span>
                    <div class="user-dropdown-content">
                        <p><?php echo htmlspecialchars($usuario_email); ?></p>
                        <form action="../../BACK-END/ADM/logout.php" method="POST">
                            <button type="submit">Sair</button>
                        </form>
                    </div>
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
                        <button class="btn-azul"><a href="RegistrarLivro.php">REGISTRAR LIVRO</a></button>
                    </div>
                </div>
                <div id="ladoDireito"></div>
            </div>
        </section>
    </main>
</body>
</html>