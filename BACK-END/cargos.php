<?php
include_once './conexao.php'; 

$nomeCargo = $_POST["NomeCargo"];
$descCargo = $_POST['DescCargo']; 
$data_inicio = $_POST['data_inicio'];
$status = $_POST['Status']; 
$ind_ativo_value = ($status === 'Ativo') ? 1 : 0; 

try {
    
    $pdo = conn(); 

    
    $sql = "INSERT INTO cargo (nomeCargo, DescCargo, data_inicio, ind_ativo)
            VALUES (:nomeCargo, :descricao, :data_inicio, :ind_ativo)";

    $stmt = $pdo->prepare($sql);

    
    $stmt->execute( [
        ':nomeCargo' => $nomeCargo,
        ':descricao' => $descCargo, 
        ':data_inicio'=> $data_inicio,
        ':ind_ativo' => $ind_ativo_value
    ]);

    echo "Dados inseridos com sucesso!";

} catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>