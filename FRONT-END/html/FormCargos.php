<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cargos</title>
</head>
<body>
    <form action="../../BACK-END/cargos.php" method="POST">
        <h1>Cadastro de Cargos</h1>

        <label for="NomeCargo">Nome do Cargo</label>
        <input type="text" name="NomeCargo" >

        <label for="DescCargo">Descrição do Cargo</label>
        <input type="text" name ="DescCargo">

        <label for="StatusCargo">Status do Cargo</label>
        <select name="Status" id="" name="Status">
            <option value="Ativo">Ativo</option>
            <option value="Desativado">Desativado</option>
        </select>
        <input type="submit" value="Criar">

    </form>
</body>
</html>