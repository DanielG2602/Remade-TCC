<?php
// Inclui o arquivo de conexão com o banco de dados.
// Se este arquivo (excluirRestaurante.php) está dentro da pasta BACK-END,
// e conexao.php também está, então o caminho é simplesmente 'conexao.php'.
require_once 'conexao.php';

$id_restaurante_excluir = $_GET['id'] ?? null;

if ($id_restaurante_excluir) {
    $pdo = conn(); 
    try {
        $stmt = $pdo->prepare("DELETE FROM restaurante WHERE idRestaurante = :id");
        $stmt->execute([':id' => $id_restaurante_excluir]);
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Restaurante ID " . htmlspecialchars($id_restaurante_excluir) . " excluído com sucesso!');</script>";
        } else {
            echo "<script>alert('Restaurante com ID " . htmlspecialchars($id_restaurante_excluir) . " não encontrado ou já excluído.');</script>";
        }

    } catch (PDOException $e) {

        echo "<script>alert('Erro ao excluir restaurante: " . htmlspecialchars($e->getMessage()) . "');</script>";
        // error_log("Erro ao excluir restaurante: " . $e->getMessage());
    }
} else {
    echo "<script>alert('ID de restaurante inválido para exclusão.');</script>";
}
echo "<script>window.location.href = '../FRONT-END/html/listarRestaurante.php';</script>";
exit();
?>