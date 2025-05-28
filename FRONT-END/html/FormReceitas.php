<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Receita</title>
</head>

<body>
    <form action="../../BACK-END/receitas.php" method="get">

        <h1>Cadastro de Receitas</h1>

        <label for="nomeReceita">Nome da Receita</label>
        <input type="text" name="nomeReceita" required>

        <label for="dataCriacao">Informe a Data de Criação da Receita</label>
        <input type="date" name="dataCriacao" required>

        <label for="nomeChefe">Nome do Chefe</label>
        <input type="text" name="nomeChefe" required>

        <label for="metodoPreparo">Metodo de preparo</label>
        <input type="text" name="metodoPreparo" required>

        <label for="qtdPorcao">Quantidade de Porção</label>
        <input type="text" name="qtdPorcao" required>

        <label for="ind_rec_inedita">Indicador de receita inédita</label>
        <input type="text" name="ind_rec_inedita" required>

        <input type="submit" value="Next">

    </form>
</body>

</html>