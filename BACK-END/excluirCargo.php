<?php
include_once 'conexao.php';  // ajuste o caminho se precisar
$conn = conn();             // cria a conexão

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["idCargo"])) {
    $id = $_POST["idCargo"];

    // Se quiser fazer exclusão lógica (marcar inativo)
    // $sql = "UPDATE cargo SET ind_ativo = 0 WHERE idCargo = :idCargo";

    // Se quiser exclusão física (DELETE), use:
    $sql = "DELETE FROM Cargo WHERE idCargo = :idCargo";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idCargo', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redireciona para ListarCargos.php
        header("Location: ../FRONT-END/html/ListarCargos.php");
        exit();
    } else {
        echo "Erro ao excluir/inativar o cargo.";
    }
} else {
    // Caso alguém acesse o script sem enviar idCargo
    header("Location: ../FRONT-END/html/ListarCargos.php");
    exit();
}
