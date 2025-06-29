<?php 
include_once './conexao.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $conn = conn();

        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
            header("Location: ../FRONT-END/html/FormReceita.php?status=erro&msg=upload_invalido");
            exit();
        }

        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $nomeReceita = $_POST["nomeReceita"];
        $categoria = $_POST["categoria"];
        $dataCriacao = $_POST["dataCriacao"];
        $ingredientes = $_POST["ingredientes"];
        $preparo = $_POST["preparo"];

        $string = implode(',', $ingredientes);

        $sql = "INSERT INTO receitanovo (nomeReceita, dataCriacao, ingredientes, preparo, categoria, foto) VALUES (:nomeReceita, :dataCriacao, :ingredientes, :preparo, :categoria, :foto)";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':nomeReceita', $nomeReceita);
        $stmt->bindValue(':dataCriacao', $dataCriacao);
        $stmt->bindValue(':ingredientes', $string);
        $stmt->bindValue(':preparo', $preparo);
        $stmt->bindValue(':categoria', $categoria);
        $stmt->bindValue(':foto', $foto, PDO::PARAM_LOB);

        $stmt->execute();

        header("Location: ../FRONT-END/html/ListarReceitas.php?status=sucesso&msg=Receita_cadastrada");
        exit();

    } catch (PDOException $e) {
        error_log("Erro PDO ao inserir receita: " . $e->getMessage());
        header("Location: ../FRONT-END/html/FormReceita.php?status=erro&msg=erro_db&details=" . urlencode($e->getMessage()));
        exit();
    }

} else {
    header("Location: ../FRONT-END/html/FormReceita.php");
    exit();
}
?>