<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../../BACK-END/livro.php" method="post">
        <label for="nomeLivro">Nome do Livro:</label>
        <input type="text" name="nomeLivro">

        <label for="editora">Nome da Editora:</label>
        <input type="text" name="editora">

        <label for="autor">Autor:</label>
        <input type="text" name="autor">

        <?php

        include_once '../../BACK-END/conexao.php';

        $conn = conn();

        $sql = "SELECT idReceita, nomeReceita FROM receitanovo";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>

        <label for="receitas">Receitas:</label>
        <select name="receitas[]" id="" multiple size="5" required>
            <?php
            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<option value='" . htmlspecialchars($row["idReceita"]) . "'>" . htmlspecialchars($row["nomeReceita"]) . "</option>";
                }
            } else {
                echo "<option>Nenhum resultado encontrado</option>";
            }
            ?>
        </select>

        <input type="submit" value="Criar">

    </form>
    
</body>
</html>