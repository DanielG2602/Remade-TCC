<?php

function conn()
{
    $host = "localhost"; 
    $port = "3306"; 
    $dbname = "acervorct"; 
    $usuario = "root"; 
<<<<<<< HEAD
    $senha = "";
=======
    $senha = ""; // Senha do banco de dados
>>>>>>> 2b51486a66612227b379313695d2b6be876a412b

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>