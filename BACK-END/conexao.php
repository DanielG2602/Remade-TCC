<?php

function conn()
{
    $host = "localhost"; 
    $port = "3307"; 
    $dbname = "acervorct"; 
    $usuario = "root"; 
    $senha = ""; 

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
// C:\xampp\htdocs\RCBR\BACK-END\conexao.php

// $host = "localhost"; 
// $port = "3306"; // Porta do banco de dados (padrão é 3306 OU 3307)
// $dbname = "Acervorct"; 
// $usuario = "root"; 
// $senha = "Matheusa.s08."; // CASO SEJA O PC DA FACUL SERA SENAC

// try {
//     $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
//     $pdo = new PDO($dsn, $usuario, $senha); // $pdo é definido aqui no escopo global
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     // REMOVA OU COMENTE A LINHA ABAIXO:
//     // echo "Conexão bem-sucedida!"; 
// } catch (PDOException $e) {
//     // É crucial registrar o erro detalhado para depuração, mas não exibi-lo ao usuário.
//     error_log("Erro de conexão com o banco de dados em conexao.php: " . $e->getMessage(), 0);
//     // Mensagem genérica para o usuário e encerra o script.
//     die("Ocorreu um erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde. (Verifique os logs do servidor para detalhes).");
// >>>>>>> a81d1cb0c2ae54172afd97efd0e6c56a76cc475a
// }
// ?>