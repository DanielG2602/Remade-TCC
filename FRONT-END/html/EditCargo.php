<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$cargo = null;

if (isset($_GET['idCargo']) && !empty($_GET['idCargo'])) {
    $idCargo = $_GET['idCargo'];
    
    $sql = "SELECT idCargo, nomeCargo, descricao, ind_ativo FROM Cargo WHERE idCargo = :idCargo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idCargo', $idCargo, PDO::PARAM_INT);
    $stmt->execute();
    
    $cargo = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$cargo) {
    die("Erro: Cargo não encontrado.");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cargo</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; text-align: center; }
        form { display: inline-block; text-align: left; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input, select, button { display: block; margin-bottom: 10px; }
        .msg { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Atualizar Cargo</h2>

    <?php if (isset($_GET['success'])) echo "<p class='msg'>Cargo atualizado com sucesso!</p>"; ?>
    <?php if (isset($_GET['error'])) echo "<p class='error'>Erro ao atualizar cargo.</p>"; ?>

    <form action="../../BACK-END/atualizarCargo.php" method="POST">
        <input type="hidden" name="idCargo" value="<?php echo htmlspecialchars($cargo['idCargo']); ?>">

        <label for="nomeCargo">Nome do Cargo:</label>
        <input type="text" name="nomeCargo" id="nomeCargo" value="<?php echo htmlspecialchars($cargo['nomeCargo']); ?>" required>

        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($cargo['descricao']); ?>" required>

        <label for="ind_ativo">Status:</label>
        <select name="ind_ativo" id="StatusCargo" required>
            <option value="">Selecione o status</option>
            <option value="1" <?php echo ($cargo['ind_ativo'] == 1 ? "selected" : ""); ?>>Ativo</option>
            <option value="0" <?php echo ($cargo['ind_ativo'] == 0 ? "selected" : ""); ?>>Desativado</option>
        </select>

        <button type="submit">Atualizar</button>
    </form>
</body>
</html>