<?php
function conn()
{
    $host = "localhost"; // Seu host
    $port = "3306"; // Porta do banco de dados (padrão é 3306)
    $dbname = "acervorct"; // Nome do seu banco de dados
    $usuario = "root"; // Seu usuário do banco de dados
    $senha = "Matheusa.s08."; // Sua senha do banco de dados

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