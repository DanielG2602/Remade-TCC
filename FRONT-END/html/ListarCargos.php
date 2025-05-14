<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cargos</title>
    <link rel="stylesheet" href="../css/ListarCargos.css">
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
        <h1>LISTAR CARGOS</h1>
        <div class="search-container">
            <input type="text" placeholder="FAÇA SUA PESQUISA">
            <button>BUSCAR</button>
        </div>

        <button class="add-button">ADICIONAR CARGO</button>

        <table>
            <thead>
                <tr>
                    <th>CARGO</th>
                    <th>DESCRIÇÃO</th>
                    <th>DATA DA ADMISSÃO</th>
                    <th>DATA DO FIM</th>
                    <th>ATIVO?</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>DEGUSTADOR</td>
                    <td>Degusta a receita</td>
                    <td>26/03/2016</td>
                    <td>26/03/2026</td>
                    <td><button class="status-button active">SIM</button></td>
                </tr>
                <tr>
                    <td>EDITOR</td>
                    <td>Escreve a receita</td>
                    <td>26/03/2016</td>
                    <td>26/03/2024</td>
                    <td><button class="status-button inactive">NÃO</button></td>
                </tr>
                <tr>
                    <td>COZINHEIRO</td>
                    <td>Prepara a receita</td>
                    <td>26/03/2016</td>
                    <td>26/03/2039</td>
                    <td><button class="status-button inactive">NÃO</button></td>
                </tr>
                <tr>
                    <td>GERENTE</td>
                    <td>Organiza o restaurante</td>
                    <td>26/03/2016</td>
                    <td>26/03/2050</td>
                    <td><button class="status-button active">SIM</button></td>
                </tr>
    
            </tbody>
        </table>
    </main>
</body>
</html>