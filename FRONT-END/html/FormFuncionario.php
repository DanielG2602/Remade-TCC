<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/FormCargos.css" /> <title>Cadastro de Funcionários</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="telaLivros.php">Livros</a></li>
                <li><a href="FormReceitas.php">Receitas</a></li>
                <li><a href="FormFuncionario.php">Funcionários</a></li>
                <li class="divider">|</li>
                <li><a href="ListarRestaurante.php">Restaurantes</a></li>
                <li><button class="btn-user">USUÁRIO</button></li>
            </ul>
        </nav>
    </header>

    <main>
        <form action="../../BACK-END/funcionario.php" method="POST">
            <h2>Cadastro de Funcionários</h2>

            <label for="nome">Nome do Funcionário:</label>
            <input type="text" name="nomeFuncionario" id="nome" placeholder="Digite o nome do funcionário" required />

            <label for="rg">RG:</label>
            <input type="number" name="rgFuncionario" id="rg" placeholder="Digite o RG do funcionário" required />

            <label for="dt_admissao">Data de Admissão:</label>
            <input type="date" name="dt_admissao" id="dt_admissao" required />

            <label for="salarioFunc">Salário:</label>
            <input type="number" step="0.01" name="salarioFunc" id="salarioFunc" placeholder="Digite o salário" required />

            <label for="nome_fantasia">Nome Fantasia (Restaurante):</label>
            <input type="text" name="nome_fantasia" id="nome_fantasia" placeholder="Digite o nome fantasia do restaurante" required />

            <label for="cargo_idCargo">Cargo:</label>
            <?php
            // Este bloco PHP gera as opções do select dinamicamente.
            // Para "separar" totalmente, você precisaria de JavaScript para buscar esses dados de outro arquivo PHP.

            // Garante que o arquivo de conexão seja incluído apenas uma vez
            include_once '../../BACK-END/conexao.php';

            $conn = null;
            try {
                $conn = conn();
            } catch (PDOException $e) {
                error_log("Erro de conexão: " . $e->getMessage());
                // Poderia redirecionar ou mostrar um erro amigável ao usuário
            }

            $resultados = []; // Inicializa para garantir que seja um array
            if ($conn) {
                $sql = "SELECT idCargo, nomeCargo FROM Cargo";
                $stmt = $conn->prepare($sql);
                if ($stmt->execute()) {
                    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    error_log("Erro ao executar consulta de cargos: " . implode(" ", $stmt->errorInfo()));
                }
            }
            ?>
            <select name="cargo_idCargo" id="cargo_idCargo" required>
                <option value="">Selecione um Cargo</option>
                <?php
                if ($resultados) {
                    foreach ($resultados as $row) {
                        echo "<option value='" . htmlspecialchars($row["idCargo"]) . "'>" . htmlspecialchars($row["nomeCargo"]) . "</option>";
                    }
                } else {
                    echo "<option disabled>Nenhum cargo encontrado</option>";
                }
                ?>
            </select>

            <div class="botoes">
                <button type="button" class="cancelar"><a href="FormFuncionario.php">cancelar</a></button>
                <button type="submit" class="confirmar">Criar</button>
            </div>
        </form>
    </main>
</body>
</html>