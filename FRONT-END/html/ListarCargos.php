<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
include_once '../../BACK-END/PesquisarCargo.php'; // Inclui a pesquisa

// Criar a conexão

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
        <div class="controls-container">
            <div class="search-container">
                <form action="../../BACK-END/PesquisarCargo.php" method="get">
                    <input type="text" name="pesquisarCargo" placeholder="FAÇA SUA PESQUISA">
                    <input type="submit" value="Buscar">
                </form>
            </div>
            <button class="add-button">ADICIONAR CARGO</button>
        </div>

        <table>
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
                <form method='POST' action='../../BACK-END/excluirCargo.php'>
                    <input type='hidden' name='idCargo' value='" . htmlspecialchars($cargo["idCargo"]) . "'>
                    <button type='submit'>Excluir</button>
                </form>
              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum cargo encontrado</td></tr>";
                }
                ?>
            </tbody>

        </table>
    </main>
</body>
<script>
document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault();
    const pesquisa = document.querySelector("input[name='pesquisarCargo']").value;

    fetch(`../../BACK-END/PesquisarCargo.php?pesquisarCargo=${pesquisa}`)
        .then(response => response.json())
        .then(data => {
            const tbody = document.querySelector("tbody");
            tbody.innerHTML = "";

            if (data.length > 0) {
                data.forEach(cargo => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${cargo.idCargo}</td>
                            <td>${cargo.nomeCargo}</td>
                            <td>${cargo.descricao}</td>
                            <td>${cargo.ind_ativo}</td>
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
                tbody.innerHTML = "<tr><td colspan='5'>Nenhum cargo encontrado</td></tr>";
            }
        });
});
</script>

</html>