<?php
include_once 'C:/xampp/htdocs/RCBR/BACK-END/conexao.php';
$conn = conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCargo = $_POST['idCargo'];
    $nomeCargo = $_POST['nomeCargo'];
    $descricao = $_POST['descricao'];
    $ind_ativo = $_POST['ind_ativo'];

    $sql = "UPDATE Cargo SET nomeCargo = :nomeCargo, descricao = :descricao, ind_ativo = :ind_ativo WHERE idCargo = :idCargo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nomeCargo', $nomeCargo, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':ind_ativo', $ind_ativo, PDO::PARAM_INT);
    $stmt->bindParam(':idCargo', $idCargo, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../FRONT-END/html/ListarCargos.php?success=1");
        exit();
    } else {
        header("Location: atualizarCargo.php?error=1");
        exit();
    }
}
?>