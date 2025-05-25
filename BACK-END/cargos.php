<?php 
include'./conexão.php';

$nomeCargo = $_POST["NomeCargo"];
$descCargo = $_POST['DescCargo'];
$dataAdmissao = $_POST['data_inicio'];
$dataDemissao = $_POST['data_fim'];
$status = $_POST['Status'];

try {
    $pdo = conn();
    $sql = "INSERT INTO cargo ( idCargo, descricao, data_inicio, data_fim, ind_ativo, nomeCargo) 
            VALUES (:descricao, :data_inicio, :data_fim, :ind_ativo, :nomeCargo)";
            
    $stmt = $pdo->prepare($sql);
    $stmt ->bindValue('idCargo', null);
    $stmt->bindValue('descricao', $descCargo);
    $stmt->bindValue('data_inicio', $dataAdmissao);
    $stmt->bindValue('data_fim', $dataDemissao);
    $stmt->bindValue('ind_ativo', $status);
    $stmt->bindValue('nomeCargo', $nomeCargo);

    $stmt->execute();

} catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>