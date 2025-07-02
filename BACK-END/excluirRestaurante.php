<?php
$id_restaurante_excluir = $_GET['id'] ?? null;

if ($id_restaurante_excluir) {
    // Em um ambiente real, você faria uma conexão com o banco de dados e executaria um DELETE:
    // $stmt = $pdo->prepare("DELETE FROM restaurantes WHERE id = :id");
    // $stmt->execute([':id' => $id_restaurante_excluir]);

    // Simulação: Apenas mostra uma mensagem e redireciona.
    // É crucial que exclusões reais sejam feitas via método POST em um formulário
    // para maior segurança e para evitar que o navegador pré-carregue links e apague dados.
    echo "<script>alert('Restaurante ID " . htmlspecialchars($id_restaurante_excluir) . " excluído (simulação)!');</script>";
} else {
    echo "<script>alert('ID de restaurante inválido para exclusão.');</script>";
}

// Redireciona de volta para a lista de restaurantes
echo "<script>window.location.href = '../../FRONT-END/html/listarRestaurante.php';</script>";
exit(); // Garante que o script pare de ser executado após o redirecionamento
?>