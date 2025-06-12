<?php


include_once './conexao.php';

// 2. Verificar se o ID do cargo foi passado via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_cargo = $_GET['id'];

    try {
        // $pdo is already available from the include_once './conexao.php';
        // No need to call a function.

        // 3. Preparar a query DELETE para evitar injeção de SQL (MUITO IMPORTANTE!)
        $stmt = $pdo->prepare("DELETE FROM cargo WHERE idCargo = :id");
        $stmt->bindParam(':id', $id_cargo, PDO::PARAM_INT); // Bind o ID como inteiro

        // 4. Executar a query
        if ($stmt->execute()) {
            // Sucesso: Redirecionar de volta para a página de cargos com uma mensagem de sucesso
            header('Location: ../FRONT-END/html/gerenciarCargos.php?status=sucesso&msg=Cargo+excluído+com+sucesso');
            exit(); // Terminar o script após o redirecionamento
        } else {
            // Falha na execução da query
            header('Location: ../FRONT-END/html/gerenciarCargos.php?status=erro&msg=Erro+ao+excluir+cargo');
            exit();
        }

    } catch (PDOException $e) {
        // Erro de conexão ou PDO
        header('Location: ../FRONT-END/html/gerenciarCargos.php?status=erro&msg=Erro+de+banco+de+dados:+' . urlencode($e->getMessage()));
        exit();
    }
} else {
    // ID não foi fornecido
    header('Location: ../FRONT-END/html/gerenciarCargos.php?status=erro&msg=ID+do+cargo+não+especificado');
    exit();
}

?>