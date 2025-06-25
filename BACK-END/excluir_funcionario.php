<?php
include_once './conexao.php';

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idFuncionario"])) {

    $id = $_POST["idFuncionario"];

    $sql = "DELETE FROM Funcionario WHERE idFuncionario = :idFuncionario;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idFuncionario', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: ../FRONT-END/html/ListarFuncionarios.php');
    exit(); 
}
?>
