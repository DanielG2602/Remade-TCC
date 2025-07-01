<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$livro = null;

// Consulta os dados do funcionário
if (isset($_GET['idLivro']) && !empty($_GET['idLivro'])) {
    $idLivro = $_GET['idLivro'];

    $sql = "SELECT * FROM livros WHERE idLivro = :idLivro";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idLivro', $idLivro, PDO::PARAM_INT);
    $stmt->execute();

    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    $receitasSelecionados = [];
    if (!empty($livro['receitas'])) {
        $receitasSelecionados = explode(',', $livro['receitas']);
    }

}

if (!$livro) {
    die("Erro: Funcionário não encontrado.");
}

// Carrega os receitas disponíveis
$sqlReceitas = "SELECT * FROM receitanovo ";
$stmtReceitas = $conn->prepare($sqlReceitas);
$stmtReceitas->execute();
$resultadosReceita = $stmtReceitas->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Livro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input,
        select,
        button {
            display: block;
            margin-bottom: 10px;
        }

        .msg {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Atualizar Livro</h2>

    <?php if (isset($_GET['success']))
        echo "<p class='msg'>Funcionário atualizado com sucesso!</p>"; ?>
    <?php if (isset($_GET['error']))
        echo "<p class='error'>Erro ao atualizar Funcionário.</p>"; ?>

    <form action="../../BACK-END/atualizarLivro.php" method="POST">

        <!-- CORRIGIDO -->
        <label for="nomeLivro">Nome do Livro</label>
        <input type="text" name="nomeLivro" value="<?= htmlspecialchars($livro['nomeLivro']) ?>" required>

        <label for="editora">Nome da editora</label>
        <input type="text" name="editora" value="<?= htmlspecialchars($livro['editora']) ?>" required>

        <label for="autor">Autor</label>
        <input type="text" name="autor" value="<?= htmlspecialchars($livro['autor']) ?>" required>

        <label for="receitas">Receitas</label>
        <select name="receitas[]" multiple size="5" required>
            <option value="" disabled>-- Selecione --</option>
            <?php foreach ($resultadosReceita as $row): ?>
                <?php $selected = in_array($row['idReceita'], $receitasSelecionados) ? 'selected' : ''; ?>
                <option value="<?= htmlspecialchars($row["idReceita"]) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($row["nomeReceita"]) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="hidden" name="idLivro" value="<?= htmlspecialchars($livro['idLivro']) ?>">

        <input type="submit" value="Enviar">
    </form>
</body>

</html>