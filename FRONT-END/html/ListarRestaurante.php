<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Restaurantes</title>
    <link rel="stylesheet" href="../css/ListarRestaurante.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <ul>
                <li><a href="#">LIVROS</a></li>
                <li><a href="#">RECEITAS</a></li>
                <li><a href="#">CARGOS</a></li>
                <li><a href="#">FUNCIONÁRIOS</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">RESTAURANTES</a>
                </li>
                <li class="user"><a href="#">USUÁRIO</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>LISTAR RESTAURANTES</h1>
        <div class="controls-container">
            <div class="search-container">
                <input type="text" placeholder="FAÇA SUA PESQUISA">
                <button>BUSCAR</button>
            </div>
            <button class="add-button">+ INCLUIR RESTAURANTES</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>NOME DO RESTAURANTE</th>
                    <th>GERENTE</th>
                    <th>MENU</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>PIZZAR MAR</td>
                    <td>MATHEUS</td>
                    <td>CLÁSSICO</td>
                </tr>
                <tr>
                    <td>BURGKING</td>
                    <td>PEDRO</td>
                    <td>CASUAL OU FAMILIAR</td>
                </tr>
                <tr>
                    <td>GIRRAFAS</td>
                    <td>DAVI</td>
                    <td>SELF-SERVICE</td>
                </tr>
                <tr>
                    <td>PETISCOS DO MAR</td>
                    <td>DANIEL</td>
                    <td>CASUAL OU FAMILIAR</td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>
