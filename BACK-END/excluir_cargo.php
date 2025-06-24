<?php

include_once './conexao.php';

$pdo = conn();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idCargo"])) {
    $id_cargo = $_POST["idCargo"];

    try {
        $stmt = $pdo->prepare("DELETE FROM cargo WHERE idCargo = :id");
        $stmt->bindParam(':id', $id_cargo, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header('Location: ../FRONT-END/html/GerenciarCargos.php?status=sucesso&msg=Cargo+excluído+com+sucesso');
            exit();
        } else {
            header('Location: ../FRONT-END/html/GerenciarCargos.php?status=erro&msg=Erro+ao+excluir+cargo');
            exit();
        }
    } catch (PDOException $e) {
        header('Location: ../FRONT-END/html/GerenciarCargos.php?status=erro&msg=' . urlencode("Erro no banco: " . $e->getMessage()));
        exit();
    }
} else {
    header('Location: ../FRONT-END/html/GerenciarCargos.php?status=erro&msg=ID+do+cargo+não+recebido');
    exit();
}
?>