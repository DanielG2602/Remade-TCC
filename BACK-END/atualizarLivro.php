<?php 
include_once 'C:/xampp/htdocs/RCBR/BACK-END/conexao.php';
$conn = conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomeLivro = $_POST['nomeLivro'] ?? '';
    $editora = $_POST['editora'] ?? '';
    $autor = $_POST['autor'] ?? '';
    $idLivro = $_POST['idLivro'] ?? 0;

    $receitasArray = $_POST['receitas'] ?? [];
    $receitas = implode(',', (array)$receitasArray);

    $sql = "UPDATE livros SET nomeLivro = :nomeLivro,
                              editora = :editora,
                              autor = :autor,
                              receitas = :receitas
                            WHERE idLivro = :idLivro";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nomeLivro', $nomeLivro, PDO::PARAM_STR);
    $stmt->bindParam(':editora', $editora, PDO::PARAM_STR);
    $stmt->bindParam(':autor', $autor, PDO::PARAM_STR);
    $stmt->bindParam(':receitas', $receitas, PDO::PARAM_STR);
    $stmt->bindParam(':idLivro', $idLivro, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../FRONT-END/html/ListarLivros.php?status=sucesso&msg=Livro_atualizado");
        exit();
    } else {
        echo "Erro ao atualizar o livro.";
    }
}
?>