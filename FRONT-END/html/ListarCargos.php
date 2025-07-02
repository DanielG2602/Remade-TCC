<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';

// Include desnecessário aqui se a pesquisa é via AJAX:
// include_once '../../BACK-END/PesquisarCargo.php'; 

// Criar a conexão
$conn = conn();

include_once '../../BACK-END/PesquisarCargo.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variáveis para controlar o que será exibido
$is_logged_in = isset($_SESSION['usuario_id']);
$is_admin = ($is_logged_in && isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin');
$username_display = $is_logged_in ? htmlspecialchars($_SESSION['usuario_email']) : 'Visitante';

$conn = conn(); // Chama a função que retorna o objeto PDO


// Preparar e executar a consulta
$sql = "SELECT idCargo, nomeCargo, descricao, ind_ativo FROM Cargo";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Buscar resultados
$cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
                <li><a href="index.php">RCBR</a></li>
                <li><a href="formReceitas.php">Receitas</a></li> <li><a href="telaLivros.php">Livros</a></li>
                <li><a href="FormFuncionario.php">Funcionários</a></li>
                <li><a href="./GerenciarCargos.php" class="active">Cargos</a></li> <li class="divider">|</li>
                <li><a href="ListarRestaurante.php">Restaurantes</a></li>
                <li><button class="btn-user">USUÁRIO</button></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>LISTAR CARGOS</h1>
        <div class="controls-container">
            <div class="search-container">
                <form id="searchForm" action="#" method="get">
                    <input type="text" name="pesquisarCargo" placeholder="FAÇA SUA PESQUISA">
                    <input type="submit" value="Buscar">
                </form>
            </div>
            <button class="add-button"><a href="./FormCargos.php">ADD CARGO</a></button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($cargos) {
                    foreach ($cargos as $cargo) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($cargo["idCargo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($cargo["nomeCargo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($cargo["descricao"]) . "</td>";
                        echo "<td>" . htmlspecialchars($cargo["ind_ativo"]) . "</td>";
                        echo "<td>
                            <a href='EditCargo.php?idCargo=" . htmlspecialchars($cargo["idCargo"]) . "'>
                                <button type='button'>Atualizar</button>
                            </a>
                        </td>";
                        echo "<td>
                                <form method='POST' action='../../BACK-END/excluirCargo.php'>
                                    <input type='hidden' name='idCargo' value='" . htmlspecialchars($cargo["idCargo"]) . "'>
                                    <button type='submit'>Excluir</button>
                                </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum cargo encontrado</td></tr>"; // Colspan ajustado para 6
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
<script>
    // Seleciona o formulário de pesquisa pelo ID que adicionei no HTML
    document.getElementById("searchForm").addEventListener("submit", function (event) {
        event.preventDefault();
        const pesquisa = this.querySelector("input[name='pesquisarCargo']").value;

        // Use encodeURIComponent para garantir que caracteres especiais na pesquisa sejam tratados corretamente
        fetch(`../../BACK-END/PesquisarCargo.php?pesquisarCargo=${encodeURIComponent(pesquisa)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                const tbody = document.querySelector("tbody");
                tbody.innerHTML = ""; // Limpa o corpo da tabela

                if (data.length > 0) {
                    data.forEach(cargo => {
                        // Construção da linha da tabela com os dados do cargo
                        tbody.innerHTML += `
                        <tr>
                            <td>${cargo.idCargo}</td>
                            <td>${cargo.nomeCargo}</td>
                            <td>${cargo.descricao}</td>
                            <td>${cargo.ind_ativo}</td>
                            <td>
                                <a href='EditCargo.php?idCargo=${cargo.idCargo}'>
                                    <button type='button'>Atualizar</button>
                                </a>
                            </td>
                            <td>
                                <form method='POST' action='../../BACK-END/excluirCargo.php'>
                                    <input type='hidden' name='idCargo' value='${cargo.idCargo}'>
                                    <button type='submit'>Excluir</button>
                                </form>
                            </td>
                        </tr>
                        `;
                    });
                } else {
                    tbody.innerHTML = "<tr><td colspan='6'>Nenhum cargo encontrado</td></tr>"; // Colspan ajustado para 6
                }
            })
            .catch(error => console.error('Erro na pesquisa:', error));
    });
</script>

</html>