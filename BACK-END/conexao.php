<?php
function conn()
{
    $host = "localhost"; 
    $port = "3307"; // Porta do banco de dados (padrão é 3306 OU 3307)
    $dbname = "Acervorct"; 
    $usuario = "root"; 
    $senha = ""; // CASO SEJA O PC DA FACUL SERA SENAC

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão bem-sucedida!";
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>