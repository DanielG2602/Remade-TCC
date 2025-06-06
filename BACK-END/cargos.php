<?php
// BACK-END/cargos.php

// 1. Inclui o arquivo de conexão com o banco de dados.
// O caminho './conexao.php' está correto se conexao.php está no mesmo diretório de cargos.php.
include_once './conexao.php'; 

// 2. Verifica se a requisição é do tipo POST.
// É crucial que este bloco englobe todo o processamento do formulário.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        // 3. Obtém a conexão PDO.
        $pdo = conn(); // Assume que a função conn() está definida em conexao.php

        // 4. Coleta e Sanitiza os dados do formulário.
        $nomeCargo = htmlspecialchars(trim($_POST["NomeCargo"]));
        $descCargo = htmlspecialchars(trim($_POST['DescCargo'])); 
        $data_inicio = htmlspecialchars(trim($_POST['data_inicio']));
        $status = htmlspecialchars(trim($_POST['Status'])); 
        
        // 5. Converte o status para o valor numérico para o banco de dados.
        $ind_ativo_value = ($status === 'Ativo') ? 1 : 0; 

        // 6. Validação básica (adicione mais validações conforme necessário).
        if (empty($nomeCargo) || empty($descCargo) || empty($data_inicio) || empty($status)) {
            // Redireciona com mensagem de erro se campos estiverem vazios.
            header("Location: ../FRONT-END/html/FormCargos.php?status=erro&msg=campos_obrigatorios");
            exit(); 
        }

        // 7. Prepara a query SQL para inserção.
        // Verifique o nome da tabela (`cargo` ou `cargos`) e os nomes das colunas.
        $sql = "INSERT INTO cargo (nomeCargo, DescCargo, data_inicio, ind_ativo)
                VALUES (:nomeCargo, :descricao, :data_inicio, :ind_ativo)";

        $stmt = $pdo->prepare($sql);

        // Verifica se a preparação da query foi bem-sucedida.
        if ($stmt === false) {
            $errorInfo = $pdo->errorInfo();
            error_log("Erro na preparação da query SQL: " . $errorInfo[2]);
            header("Location: ../FRONT-END/html/FormCargos.php?status=erro&msg=erro_query_preparacao&details=" . urlencode($errorInfo[2]));
            exit();
        }
        
        // 8. Executa a query com os parâmetros.
        $stmt->execute([
            ':nomeCargo' => $nomeCargo,
            ':descricao' => $descCargo, // Certifique-se de que ':descricao' corresponde ao placeholder na query.
            ':data_inicio'=> $data_inicio,
            ':ind_ativo' => $ind_ativo_value
        ]);

        // 9. Se a inserção foi bem-sucedida, redireciona para a página de gerenciamento.
        // O caminho deve ser relativo ao script que está sendo executado (cargos.php).
        // Se GerenciarCargos.php está em FRONT-END/html/, e cargos.php está em BACK-END/,
        // então ../FRONT-END/html/GerenciarCargos.php é o caminho correto.
        header("Location: ../FRONT-END/html/GerenciarCargos.php?status=sucesso&msg=cargo_cadastrado");
        exit();

    } catch(PDOException $e){
        // 10. Em caso de erro PDO, registra o erro e redireciona com mensagem de erro.
        error_log("Erro PDO ao inserir cargo: " . $e->getMessage()); 
        header("Location: ../FRONT-END/html/FormCargos.php?status=erro&msg=erro_db&details=" . urlencode($e->getMessage()));
        exit();
    }

} else {
    // 11. Se o script for acessado diretamente sem POST, redireciona para o formulário.
    header("Location: ../FRONT-END/html/FormCargos.php");
    exit();
}
?>