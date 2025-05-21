<?php 

include_once'./conexão.php';

$nomeChefe = $_POST['nomeChefe'];
$nomeRestaurante = $_POST['nomeRestaurante'];
$nomeLivro = $_POST['nomeLivro'];
$dataCriacao = $_POST['dataCriacao'];
$Integredientes = $_POST['Integredientes'];
$metodoPreparo = $_POST['metodoPreparo'];
$obsReceita = $_POST['obsReceita'];

try{
    $pdo = conn();
    // TODO ajustar o insert na tabela de receitas
    $sql = "INSERT INTO Receita (nome_rct, idReceita, dt_criacao, cozinheiro, preparo, quantidade_porcao, ind_rec_inedita) 
            VALUES (:nome_rct, :email, :idade)";
            
    $stmt = $pdo->prepare($sql);

    // Definir os valores e executar
    $stmt->execute([
        // TODO
        ':nome_rct' => $nomeChefe,
    ]);

}catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>