<?php
include_once 'C:/xampp/htdocs/RCBR/BACK-END/conexao.php';
$conn = conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeReceita = $_POST["nomeReceita"];
    $categoria = $_POST["categoria"];
    $dataCriacao = $_POST["dataCriacao"];
    $ingredientesArray = $_POST["ingredientes"] ?? [];
    $ingredientes = implode(",", $ingredientesArray); // transforma em "1,2,3"
    $preparo = $_POST["preparo"];
    $idReceita = $_POST["idReceita"];

    $temFotoNova = isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK;

    if ($temFotoNova) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $sql = "UPDATE receitanovo SET nomeReceita = :nomeReceita,
                                   categoria = :categoria,
                                   dataCriacao = :dataCriacao,
                                   ingredientes = :ingredientes,
                                   preparo = :preparo,
                                   foto = :foto
                               WHERE idReceita = :idReceita";
    } else {
        $sql = "UPDATE receitanovo SET nomeReceita = :nomeReceita,
                                   categoria = :categoria,
                                   dataCriacao = :dataCriacao,
                                   ingredientes = :ingredientes,
                                   preparo = :preparo
                               WHERE idReceita = :idReceita";
    }

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nomeReceita', $nomeReceita, PDO::PARAM_STR);
    $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
    $stmt->bindParam(':dataCriacao', $dataCriacao, PDO::PARAM_STR);
    $stmt->bindParam(':ingredientes', $ingredientes, PDO::PARAM_STR);
    $stmt->bindParam(':preparo', $preparo, PDO::PARAM_STR);
    $stmt->bindParam(':idReceita', $idReceita, PDO::PARAM_INT);

    if ($temFotoNova) {
        $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB);
    }
    if ($stmt->execute()) {
        header("Location: ../FRONT-END/html/ListarReceitas.php?status=sucesso&msg=Receita_atualizada");
    } else {
        echo "Erro ao atualizar a receita.";
    }

}
?>