<?php 

include_once'./conexao.php';

$nomeFuncionario = $_POST['nomeFuncionario'];
$rg = $_POST['rgFuncionario'];
$dt_admissao = $_POST['dt_admissao'];
$salarioFunc = $_POST['salarioFunc'];
$nome_fantasia = $_POST['nome_fantasia'];
$cargo_idCargo = $_POST['cargo_idCargo'];

try{
    $pdo = conn();
    $sql = "INSERT INTO Funcionario (nome, rg, dt_admissao, salario, nome_fantasia, Cargo_idCargo) 
            VALUES (:nome_fnc, :rg, :dt_admissao, :salario, :nome_fantasia, :Cargo_idCargo)";
            
    $stmt = $pdo->prepare($sql);

    $stmt->execute(params: [
        ':nome_fnc' => $nomeFuncionario,
        ':rg' => $rg,
        ':dt_admissao' => $dt_admissao,
        ':salario' => $salarioFunc,
        ':nome_fantasia' => $nome_fantasia,
        ':Cargo_idCargo' => $cargo_idCargo,
    ]);

    header('Location: ../FRONT-END/html/ListarFuncionarios.php');
    exit(); // garante o redirecionamento

}catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>