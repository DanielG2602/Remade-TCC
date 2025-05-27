<?php 
include_once'./conexao.php';

$nomeCargo = $_POST["NomeCargo"];
$descCargo = $_POST['DescCargo'];
$status = $_POST['Status'];

try {
    $pdo = conn();
    $sql = "INSERT INTO cargo (nomeCargo, descricao, ind_ativo) 
            VALUES (:nomeCargo, :descricao, :idn_ativo)";
            
    $stmt = $pdo->prepare($sql);

    $stmt->execute( [
        ':nomeCargo' => $nomeCargo,
        ':descricao' => $descCargo,
        ':idn_ativo' => $status,
    ]);

    echo "Dados inseridos com sucesso!";

} catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>