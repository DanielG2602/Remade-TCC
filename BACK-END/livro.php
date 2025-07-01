<?php
include_once './conexao.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $conn = conn();

        $nomeLivro = $_POST['nomeLivro'];
        $editora = $_POST['editora'];
        $autor = $_POST['autor'];
        $receitas = isset($_POST['receitas']) ? $_POST['receitas'] : [];
        $string = implode(',', $receitas);

        $sql = "INSERT INTO livros (nomeLivro, editora, autor, receitas) VALUES (:nomeLivro, :editora, :autor, :receitas)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nomeLivro', $nomeLivro);
        $stmt->bindValue(':editora', $editora);
        $stmt->bindValue(':autor', $autor);
        $stmt->bindValue(':receitas', $string);

        $stmt->execute();

        header("Location: ../FRONT-END/html/ListarLivros.php?status=sucesso&msg=Livro_cadastrado");
        exit();

    } catch (PDOException $e) {
        error_log("Erro PDO ao inserir livro: " . $e->getMessage());
        header("Location: ../FRONT-END/html/FormLivro.php?status=erro&msg=erro_db&details=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../FRONT-END/html/FormLivro.php");
    exit();
}

?>