<?php
include_once 'C:/xampp/htdocs/RCBR/BACK-END/conexao.php';
$conn = conn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeFuncionario = $_POST['nomeFuncionario'];
    $rgFuncionario = $_POST['rgFuncionario'];
    $dt_admissao = $_POST['dt_admissao'];
    $salarioFunc = $_POST['salarioFunc'];
    $nome_fantasia = $_POST['nome_fantasia'];
    $cargo_idCargo = $_POST['cargo_idCargo'];
    $idFuncionario = $_POST['idFuncionario'];

    $sql = "UPDATE funcionario SET nome = :nomeFuncionario,
                                   rg = :rgFuncionario,
                                   dt_admissao = :dt_admissao, 
                                   salario = :salarioFunc, 
                                   nome_fantasia = :nome_fantasia,
                                   cargo_idCargo = :cargo_idCargo
                                WHERE idFuncionario = :idFuncionario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nomeFuncionario', $nomeFuncionario, PDO::PARAM_STR);
    $stmt->bindParam(':rgFuncionario', $rgFuncionario, PDO::PARAM_STR);
    $stmt->bindParam(':dt_admissao', $dt_admissao, PDO::PARAM_INT);
    $stmt->bindParam(':salarioFunc', $salarioFunc, PDO::PARAM_INT);
    $stmt->bindParam(':nome_fantasia', $nome_fantasia, PDO::PARAM_INT);
    $stmt->bindParam(':cargo_idCargo', $cargo_idCargo, PDO::PARAM_INT);
    $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: ../FRONT-END/html/ListarFuncionarios.php?success=1"); 
        exit();
    } else {
        header("Location: atualizarFuncionario.php?error=1"); 
        exit();
    }
}
?>