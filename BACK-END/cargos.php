<?php 
include'./conexão.php';

$nomeCargo = $_POST["NomeCargo"];
$descCargo = $_POST['DescCargo'];
$dataAdmissao = $_POST['DataAdmissao'];
$status = $_POST['Status'];

try {
    $pdo = conn();
    $sql = "INSERT INTO cargo ( descricao, data_inicio, data_fim, ind_ativo, nomeCargo) 
            VALUES (:descricao, :data_inicio, :data_fim, :ind_ativo, :nomeCargo)";
            
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('descricao', 'daniel');
    $stmt->bindValue('data_inicio', '2023-10-01');
    $stmt->bindValue('data_fim', '2023-10-01');
    $stmt->bindValue('ind_ativo', true);
    $stmt->bindValue('nomeCargo', 'daniel');

    $stmt->execute();

} catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>