<?php
include_once __DIR__ . '/../../BACK-END/conexao.php';
$conn = conn();

$funcionario = null;

if (isset($_GET['idFuncionario']) && !empty($_GET['idFuncionario'])) {
    $idFuncionario = $_GET['idFuncionario'];
    
    $sql = "SELECT idFuncionario, nome, rg, dt_admissao, salario, nome_fantasia, Cargo_idCargo FROM funcionario WHERE idFuncionario = :idFuncionario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_INT);
    $stmt->execute();
    
    $funcionario = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$funcionario) {
    die("Erro: funcionario não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1><?php echo htmlspecialchars($funcionario['nome']); ?></h1>
    <h2><?php echo htmlspecialchars($funcionario['rg']); ?></h2>
    <h2><?php echo htmlspecialchars($funcionario['dt_admissao']); ?></h2>
    <h2><?php echo htmlspecialchars($funcionario['salario']); ?></h2>
    <h2><?php echo htmlspecialchars($funcionario['nome_fantasia']); ?></h2>
    <h2><?php echo htmlspecialchars($funcionario['Cargo_idCargo']); ?></h2>
    
</body>
</html>