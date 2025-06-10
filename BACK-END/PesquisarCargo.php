<?php 
include_once 'C:/xampp/htdocs/RCBR/BACK-END/conexao.php';

$conn = conn();
$cargos = [];

if (isset($_GET['pesquisarCargo']) && !empty($_GET['pesquisarCargo'])) {
    $search = '%' . $_GET['pesquisarCargo'] . '%';
    $sql = "SELECT idCargo, nomeCargo, descricao, ind_ativo FROM Cargo WHERE nomeCargo LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->execute();

    $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cargos);
}
?>