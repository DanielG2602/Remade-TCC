<!DOCTYPE html>
<html lang="en">
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
        <input type="number" name="cargo_idCargo" required>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>