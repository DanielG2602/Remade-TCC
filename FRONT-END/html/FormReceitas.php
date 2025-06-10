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

        <label for="nome_rct">Nome da Receita</label>
        <input type="text" name="nome_rct" maxlength="50" required>
        <br><br>

        <label for="dt_criacao">Data de Criação da Receita</label>
        <input type="date" name="dt_criacao" required>
        <br><br>
        
        <label for="preparo">Método de Preparo</label>
        <textarea name="preparo" rows="10" cols="50" maxlength="5000" required></textarea>
        <br><br>

        <label for="quantidade_porcao">Quantidade de Porção</label>
        <input type="number" name="quantidade_porcao" step="0.1" required>
        <br><br>

        <label for="ind_rec_inedita">Receita Inédita?</label>
        <select name="ind_rec_inedita" required>
            <option value="">Selecione</option>
            <option value="S">Sim</option>
            <option value="N">Não</option>
        </select>
        <br><br>

        <input type="submit" value="Cadastrar Receita">

    </form>
</body>

</html>