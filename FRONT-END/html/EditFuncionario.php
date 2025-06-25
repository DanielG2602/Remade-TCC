<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$funcionario = null;

// Consulta os dados do funcionário
if (isset($_GET['idFuncionario']) && !empty($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];

    $sql = "SELECT idFuncionario, nome, rg, dt_admissao, salario, nome_fantasia, Cargo_idCargo FROM funcionario WHERE idFuncionario = :idFuncionario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_INT);
    $stmt->execute();

    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$funcionario) {
    die("Erro: Funcionário não encontrado.");
}

// Carrega os cargos disponíveis
$sqlCargos = "SELECT idCargo, nomeCargo FROM Cargo";
$stmtCargo = $conn->prepare($sqlCargos);
$stmtCargo->execute();
$resultados = $stmtCargo->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Funcionário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        form { display: inline-block; text-align: left; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input, select, button { display: block; margin-bottom: 10px; }
        .msg { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Atualizar Funcionário</h2>

    <?php if (isset($_GET['success'])) echo "<p class='msg'>Funcionário atualizado com sucesso!</p>"; ?>
    <?php if (isset($_GET['error'])) echo "<p class='error'>Erro ao atualizar Funcionário.</p>"; ?>

    <form action="../../BACK-END/atualizarFuncionario.php" method="POST">
        <input type="hidden" name="idFuncionario" value="<?php echo htmlspecialchars($funcionario['idFuncionario']); ?>">

        <label for="nomeFuncionario">Nome do Funcionário</label>
        <input type="text" name="nomeFuncionario" value="<?php echo htmlspecialchars($funcionario['nome']); ?>" required>

        <label for="rgFuncionario">RG</label>
        <input type="number" name="rgFuncionario" value="<?php echo htmlspecialchars($funcionario['rg']); ?>" required>

        <label for="dt_admissao">Data de Admissão</label>
        <input type="date" name="dt_admissao" value="<?php echo htmlspecialchars($funcionario['dt_admissao']); ?>" required>

        <label for="salarioFunc">Salário</label>
        <input type="number" name="salarioFunc" value="<?php echo htmlspecialchars($funcionario['salario']); ?>" required>

        <label for="nome_fantasia">Nome Fantasia</label>
        <input type="text" name="nome_fantasia" value="<?php echo htmlspecialchars($funcionario['nome_fantasia']); ?>" required>

        <label for="cargo_idCargo">Cargo</label>
        <select name="cargo_idCargo" required>
            <option value="">-- Selecione --</option>
            <?php
            foreach ($resultados as $row) {
                $selected = ($row['idCargo'] == $funcionario['Cargo_idCargo']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row["idCargo"]) . "' $selected>" . htmlspecialchars($row["nomeCargo"]) . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>