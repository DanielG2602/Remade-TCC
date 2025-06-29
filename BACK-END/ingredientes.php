<?php 
include_once './conexao.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    try{
        $conn = conn();
    
        $nomeIngrediente = $_POST["nomeIngrediente"];
        $descIngrediente = $_POST["descIngrediente"];
    
        $sql = "INSERT INTO ingrediente (nome, descricao) VALUES (:nome, :descricao)";
    
        $stmt = $conn->prepare($sql);
    
        $stmt->execute([
            ":nome"=>$nomeIngrediente,
            ":descricao"=>$descIngrediente
        ]);
    
        header("Location: ../FRONT-END/html/FormReceita.php?status=sucesso&msg=Ingrediente_cadastrado");
        exit();

    }catch(PDOException $e){
        error_log("Erro PDO ao inserir Ingrediente: " . $e->getMessage());
        header("Location: ../FRONT-END/html/FormReceita.php?status=erro&msg=erro_db&details=" . urlencode($e->getMessage()));
        exit();
    }

}else{
    header("Location: ../FRONT-END/html/FormReceita.php");
    exit();
}


?>