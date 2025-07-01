<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$receita = null;

// Consulta os dados do funcionário
if (isset($_GET['idReceita']) && !empty($_GET['idReceita'])) {
    $idReceita = $_GET['idReceita'];

    $sql = "SELECT * FROM receitanovo WHERE idReceita = :idReceita";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idReceita', $idReceita, PDO::PARAM_INT);
    $stmt->execute();
    
    $receita = $stmt->fetch(PDO::FETCH_ASSOC);

    $ingredientesSelecionados = [];
    if (!empty($receita['ingredientes'])) {
        $ingredientesSelecionados = explode(',', $receita['ingredientes']);
    }
}

if (!$receita) {
    die("Erro: receita não encontrada.");
}

$sqlCategoria = "SELECT * FROM categoria ";
$stmtCategoria = $conn->prepare($sqlCategoria);
$stmtCategoria->execute();
$resultadosCategoria = $stmtCategoria->fetchAll(PDO::FETCH_ASSOC);


$sqlIngredientes = "SELECT * FROM ingrediente ";
$stmtIngrediente = $conn->prepare($sqlIngredientes);
$stmtIngrediente->execute();
$resultadosIngredientes = $stmtIngrediente->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Atualizar Receita</h2>

    <?php if (isset($_GET['success']))
        echo "<p class='msg'>Funcionário atualizado com sucesso!</p>"; ?>
    <?php if (isset($_GET['error']))
        echo "<p class='error'>Erro ao atualizar Funcionário.</p>"; ?>



    <form action="../../BACK-END/atualizarReceita.php" method="POST" enctype="multipart/form-data">

        <?php if (!empty($receita['foto'])): ?>
            <img src="../../BACK-END/mostrar_foto.php?id=<?= htmlspecialchars($receita['idReceita']) ?>" alt=""
                style="max-width:200px;" style="max-width:200px; display:block; margin-bottom:10px;">
        <?php endif; ?>

        <label for="foto">Alterar imagem:</label>
        <input type="file" name="foto" id="foto" accept="image/*">


        <?php if (!empty($receita['foto'])): ?>
            <img src="mostrar_foto.php?id=<?= htmlspecialchars($receita['idReceita']) ?>" alt="" style="max-width:200px;"
                style="max-width:200px;">
        <?php else: ?>
            <span>Nenhuma foto cadastrada</span>
        <?php endif; ?>

        <!-- <label for="foto">Alterar foto:</label>
        <input type="file" name="foto" id="foto" accept="image/*"> -->


        <br>

        <label for="nomeReceita">Nome da receita</label>
        <input type="text" name="nomeReceita" value="<?php echo htmlspecialchars($receita['nomeReceita']); ?>" required>

        <?php

        $conn = conn();

        $sql = "SELECT idCategoria, nomeCategoria FROM categoria";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label for="">Categoria</label>
        <select name="categoria" required>
            <option value="">-- Selecione --</option>
            <?php
            foreach ($resultadosCategoria as $row) {
                $selected = ($row['idCategoria'] == $receita['categoria']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row["idCategoria"]) . "' $selected>" . htmlspecialchars($row["nomeCategoria"]) . "</option>";
            }
            ?>
        </select>

        <!-- Data  -->
        <label for="dataCriacao">Data de Admissão</label>
        <input type="date" name="dataCriacao" value="<?php echo htmlspecialchars($receita['dataCriacao']); ?>" required>


        <label for="ingredientes">Ingredientes</label>
        <select name="ingredientes[]" multiple size="5">
            <option value="">-- Selecione --</option>
            <?php foreach ($resultadosIngredientes as $row): ?>
                <?php $selected = in_array($row['idIngrediente'], $ingredientesSelecionados) ? 'selected' : ''; ?>
                <option value="<?= htmlspecialchars($row["idIngrediente"]) ?>" <?= $selected ?>>
                    <?= htmlspecialchars($row["nome"]) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="">Modo de Preparo</label>
        <textarea name="preparo" id=""><?php echo htmlspecialchars($receita['preparo']); ?></textarea>

        <input type="hidden" name="idReceita" value="<?= htmlspecialchars($receita['idReceita']) ?>">

        <input type="submit" value="Enviar">
    </form>

</body>

</html>