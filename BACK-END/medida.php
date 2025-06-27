<?php
include_once './conexao.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $conn = conn();
    $nomeMedida = $_POST['nomeMedida'];

    $sql = "INSERT INTO Medida (nomeMedida) VALUES (:nome)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nome', $nomeMedida, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: ../FRONT-END/html/cadastroReceita.php?success=1");
        exit();
    } else {
        header("Location: atualizarMedida.php?error=1");
        exit();
    }
}
;

?>