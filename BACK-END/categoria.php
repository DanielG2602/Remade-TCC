<?php 
include_once './conexao.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    try{
        $conn = conn();
    
        $nomeCategoria = $_POST['nomeCategoria'];
    
        $sql = "INSERT INTO categoria (nomeCategoria) VALUES (:nome)";
    
        $stmt = $conn->prepare($sql);
    
        $stmt->execute([':nome' => $nomeCategoria]);
    
        header("Location: Location: ../FRONT-END/html/cadastroReceita.php?status=sucesso&msg=categoria_cadastrado");
        exit();
    }catch(PDOException $e){
        error_log("Erro PDO ao inserir Ingrediente: " . $e->getMessage());
        header("Location: ../FRONT-END/html/cadastroReceita.php?status=erro&msg=erro_db&details=" . urlencode($e->getMessage()));
        exit();
    }
}else{
    echo"error";
}

?>