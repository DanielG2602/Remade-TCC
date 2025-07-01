<?php
include_once './conexao.php';

$conn = conn();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idLivro"])) {
    $id = $_POST["idLivro"];

    $sql = "DELETE FROM livros WHERE idLivro = :idLivro;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idLivro', $id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: ../FRONT-END/html/ListarLivros.php');
    exit(); 
}