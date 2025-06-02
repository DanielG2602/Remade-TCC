<?php 
include_once'./conexao.php';

$nomeCargo = $_POST["NomeCargo"];
$descCargo = $_POST['DescCargo'];
$data_inicio = $_POST['data_inicio'];// Default to current date if not provided
$status = $_POST['Status'];

try {
    $pdo = conn();
    $sql = "INSERT INTO cargo (nomeCargo, DescCargo, data_inicio ind_ativo) 
            VALUES (:nomeCargo, :descricao, :data_inicio, :idn_ativo)";
            
    $stmt = $pdo->prepare($sql);

    $stmt->execute( [
        ':nomeCargo' => $nomeCargo,
        ':descricao' => $descCargo,
        ':data_inicio'=> $data_inicio,
        ':idn_ativo' => $status
    ]);

    echo "Dados inseridos com sucesso!";

} catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>