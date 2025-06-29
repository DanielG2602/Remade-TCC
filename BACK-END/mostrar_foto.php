<?php
include_once './conexao.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    http_response_code(400);
    exit("ID inválido");
}

$conn = conn();

$sql = "SELECT foto FROM receitanovo WHERE idReceita = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$foto = $stmt->fetchColumn();

if (!$foto) {
    http_response_code(404);
    exit("Imagem não encontrada");
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->buffer($foto) ?: 'image/jpeg'; // fallback
header("Content-Type: $mime");
echo $foto;
exit;