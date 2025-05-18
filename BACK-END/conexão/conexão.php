<?php
function conn()
{
    $host = "localhost"; // Seu host
    $dbname = "acervorct"; // Nome do seu banco de dados
    $usuario = "root"; // Seu usuário do banco de dados
    $senha = "Matheusa"; // Sua senha do banco de dados

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão bem-sucedida!";
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>