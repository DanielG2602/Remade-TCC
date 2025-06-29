<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$receita = null;

if (isset($_GET['idReceita']) && !empty($_GET['idReceita'])) {
    $idReceita = $_GET['idReceita'];

    $sql = "SELECT * FROM receitanovo WHERE idReceita = :idReceita";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idReceita', $idReceita, PDO::PARAM_INT);
    $stmt->execute();

    $receita = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$receita) {
    die("Erro: funcionario não encontrado.");
}

// após conectar e antes do foreach de ingredientes
$sqlIngredientes = "SELECT * FROM ingrediente";
$stmtIngrediente = $conn->prepare($sqlIngredientes);
$stmtIngrediente->execute();
$resultadosIngredientes = $stmtIngrediente->fetchAll(PDO::FETCH_ASSOC);

$ingredientesPorId = [];
foreach ($resultadosIngredientes as $ing) {
    $ingredientesPorId[$ing['idIngrediente']] = $ing['nome'];
}

$sqlCategoria = "SELECT * FROM categoria ";
$stmtCategoria = $conn->prepare($sqlCategoria);
$stmtCategoria->execute();
$resultadosCategoria = $stmtCategoria->fetchAll(PDO::FETCH_ASSOC);

$categoriasPorId = [];
foreach ($resultadosCategoria as $cat) {
    $categoriasPorId[$cat['idCategoria']] = $cat['nomeCategoria'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php if (!empty($receita['foto'])): ?>
        <img src="../../BACK-END/mostrar_foto.php?id=<?= htmlspecialchars($receita['idReceita']) ?>" alt=""
            style="max-width:200px;" style="max-width:200px; display:block; margin-bottom:10px;">
    <?php endif; ?>

    <h1>Receita de <?php echo htmlspecialchars($receita['nomeReceita']); ?></h1>

    <h1><?php echo htmlspecialchars($receita['nomeReceita']); ?></h1>
    <h2><?php echo htmlspecialchars($receita['dataCriacao']); ?></h2>
    <?php
    $nomesIngredientes = [];
    $idsIngredientes = explode(',', $receita['ingredientes']);
    foreach ($idsIngredientes as $id) {
        $id = trim($id);
        if (isset($ingredientesPorId[$id])) {
            $nomesIngredientes[] = $ingredientesPorId[$id];
        }
    }
    ?>
    <h2><?= htmlspecialchars(implode(', ', $nomesIngredientes)) ?></h2>
    <h2><?php echo htmlspecialchars($receita['preparo']); ?></h2>
    <?php
    $nomeCategoria = $categoriasPorId[$receita['categoria']] ?? 'Categoria desconhecida';
    ?>
    <h2><?= htmlspecialchars($nomeCategoria) ?></h2>

    <button><a href="./ListarReceitas.php">Voltar</a></button>
</body>

</html>