<?php 

include_once'./conexao.php';

$nomeReceita = $_POST['nomeReceita'];
$dataCriacao = $_POST['dataCriacao'];
$nomeChefe = $_POST['nomeChefe'];
$metodoPreparo = $_POST['metodoPreparo'];
$qtd_porcao = $_POST['qtdPorcao'];
$ind_rec = $_POST['ind_rec_inedita'];

try{
    $pdo = conn();
    $sql = "INSERT INTO receita (nome_rct, dt_criacao, cozinheiro, preparo, quantidade_porcao, ind_rec_inedita) 
            VALUES (:nome_rct, :dt_criacao, :cozinheiro, :preparo, :quantidade_porcao, :ind_rec_inedita)";
            
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':nome_rct' => $nomeReceita,
        ':dt_criacao' => $dataCriacao,
        ':cozinheiro' => $nomeChefe,
        ':preparo' => $metodoPreparo,
        ':quantidade_porcao' => $qtd_porcao,
        ':ind_rec_inedita' => $ind_rec,
    ]);

}catch(PDOException $e){
    echo "Erro: " . $e->getMessage();
}

?>