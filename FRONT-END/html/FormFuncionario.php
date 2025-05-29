<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionarios</title>
</head>

<body>
    <form action="../../BACK-END/funcionario.php" method="POST">
        <h1>Cadastro de Funcionarios</h1>

        <label for="nome">Nome do Funcionario</label>
        <input type="text" name="nomeFuncionario" required>

        <label for="rg">RG</label>
        <input type="number" name="rgFuncionario" required>

        <label for="dt_admissao">Data Admissao</label>
        <input type="date" name="dt_admissao" required>

        <label for="salarioFunc">Salario</label>
        <input type="number" name="salarioFunc" required>

        <label for="nome_fantasia">Nome Fantasia</label>
        <input type="text" name="nome_fantasia" required>

        <label for="cargo_idCargo">Id do Cargo</label>
        <?php

        include_once'../../BACK-END/conexao.php';

        $conn = conn(); 
        
        $sql = "SELECT idCargo, nomeCargo FROM Cargo";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <select name="cargo_idCargo">
            <?php
            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<option value='" . htmlspecialchars($row["idCargo"]) . "'>" . htmlspecialchars($row["nomeCargo"]) . "</option>";
                }
            } else {
                echo "<option>Nenhum resultado encontrado</option>";
            }
            ?>
        </select>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>