<?php
$host = "localhost"; // Seu host
$dbname = "seu_banco_de_dados"; // Nome do seu banco de dados
$usuario = "seu_usuario"; // Seu usuário do banco de dados
$senha = "sua_senha"; // Sua senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}
?>