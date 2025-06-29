<?php
include_once './conexao.php';

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idReceita"])) {
    $id = $_POST["idReceita"];

    $sql = "DELETE FROM receitanovo WHERE idReceita = :idReceita;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idReceita', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: ../FRONT-END/html/ListarReceitas.php');
    exit(); 
}