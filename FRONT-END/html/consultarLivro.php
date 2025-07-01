<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$livro = null;

if (isset($_GET['idLivro']) && !empty($_GET['idLivro'])) {
    $idLivro = $_GET['idLivro'];

    $sql = "SELECT * FROM livros WHERE idLivro = :idLivro";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idLivro', $idLivro, PDO::PARAM_INT);
    $stmt->execute();

    $livro = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$livro) {
    die("Erro: funcionario não encontrado.");
}

$sqlReceita = "SELECT * FROM receitanovo ";
$stmtReceita = $conn->prepare($sqlReceita);
$stmtReceita->execute();
$resultadosReceita = $stmtReceita->fetchAll(PDO::FETCH_ASSOC);

$receitaPorId = [];
foreach ($resultadosReceita as $cat) {
    $receitaPorId[$cat['idReceita']] = $cat['nomeReceita'];
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

    <h1><?php echo htmlspecialchars($livro['nomeLivro']); ?></h1>
    <h2><?php echo htmlspecialchars($livro['editora']); ?></h2>
    <h2><?php echo htmlspecialchars($livro['autor']); ?></h2>
    <?php
    $nomesReceitas = [];
    $idsReceitas = explode(',', $livro['receitas']);
    foreach ($idsReceitas as $id) {
        $id = trim($id);
        if (isset($receitaPorId[$id])) {
            $nomesReceitas[] = $receitaPorId[$id];
        }
    }
    ?>
    <h2><?= htmlspecialchars(implode(', ', $nomesReceitas)) ?></h2>

</body>

</html>