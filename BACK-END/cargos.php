<?php 

include_once'conexão.php';

$nomeCargo = $_POST['NomeCargo'];
$descCargo = $_POST['DescCargo'];
$dataAdmissao = $_POST['DataAdmissao'];
$status = $_POST['Status'];

try {
    $pdo = conn();
    $sql = "INSERT INTO RC_Cargo (idCargo, descricao, data_inicio, data_fim, data_fim) 
            VALUES (:idCargo, :descricao, :data_inicio, :data_fim, :data_fim)";
            
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        // TODO
        ':idCargo' => $nomeCargo,
    ]);

} catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>