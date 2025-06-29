<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="../../BACK-END/receitas.php" enctype="multipart/form-data" method="post">

        <label for="">Foto da Receita</label>
        <input type="file" name="foto">

        <label for="">Nome da Receita</label>
        <input type="text" name="nomeReceita" id="">

        <?php

        include_once '../../BACK-END/conexao.php';

        $conn = conn();

        $sql = "SELECT idCategoria, nomeCategoria FROM categoria";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <label for="">Categoria</label>
        <select name="categoria" id="">
            <?php
            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<option value='" . htmlspecialchars($row["idCategoria"]) . "'>" . htmlspecialchars($row["nomeCategoria"]) . "</option>";
                }
            } else {
                echo "<option>Nenhum resultado encontrado</option>";
            }
            ?>
        </select>

        <label for="">Data de Criação</label>
        <input type="date" name="dataCriacao">
        <?php

        include_once '../../BACK-END/conexao.php';

        $conn = conn();

        $sql = "SELECT idIngrediente, nome FROM ingrediente";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <label for="">Ingredientes</label>
        <select name="ingredientes[]" id="" multiple size="5">
            <?php
            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<option value='" . htmlspecialchars($row["idIngrediente"]) . "'>" . htmlspecialchars($row["nome"]) . "</option>";
                }
            } else {
                echo "<option>Nenhum resultado encontrado</option>";
            }
            ?>
        </select>
        <button><a href="./FormIngredientes.php">Adicionar mais Ingredientes</a></button>

        
        <label for="">Modo de Preparo</label>
        <textarea name="preparo" id=""></textarea>
        
        <input type="submit" value="Criar Receita">
    </form>
</body>

</html>