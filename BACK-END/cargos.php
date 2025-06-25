<?php
include_once './conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo=conn();
        
        $nomeCargo = htmlspecialchars(trim($_POST["NomeCargo"]));
        $descCargo = htmlspecialchars(trim($_POST['DescCargo']));
        $data_inicio = htmlspecialchars(trim($_POST['data_inicio']));
        $status = htmlspecialchars(trim($_POST['Status']));

        $ind_ativo_value = ($status === 'Ativo') ? 1 : 0;

        if (empty($nomeCargo) || empty($descCargo) || empty($data_inicio) || empty($status)) {
            header("Location: ../FRONT-END/html/FormCargos.php?status=erro&msg=campos_obrigatorios");
            exit();
        }

        $sql = "INSERT INTO cargo (nomeCargo, DescCargo, data_inicio, ind_ativo)
                VALUES (:nomeCargo, :descricao, :data_inicio, :ind_ativo)";

        $stmt = $pdo->prepare($sql);

        if ($stmt === false) {
            $errorInfo = $pdo->errorInfo();
            error_log("Erro na preparação da query SQL: " . $errorInfo[2]);
            header("Location: ../FRONT-END/html/FormCargos.php?status=erro&msg=erro_query_preparacao&details=" . urlencode($errorInfo[2]));
            exit();
        }

        $stmt->execute([
            ':nomeCargo' => $nomeCargo,
            ':descricao' => $descCargo,
            ':data_inicio'=> $data_inicio,
            ':ind_ativo' => $ind_ativo_value
        ]);

        header("Location: ../FRONT-END/html/GerenciarCargos.php?status=sucesso&msg=cargo_cadastrado");
        exit();

    } catch(PDOException $e){
        error_log("Erro PDO ao inserir cargo: " . $e->getMessage());
        header("Location: ../FRONT-END/html/FormCargos.php?status=erro&msg=erro_db&details=" . urlencode($e->getMessage()));
        exit();
    }

} else {
    header("Location: ../FRONT-END/html/FormCargos.php");
    exit();
}
?>