<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_restaurante = $_POST['nome'] ?? '';
    $gerente_restaurante = $_POST['gerente'] ?? '';
    $menu_restaurante = $_POST['menu'] ?? '';


 if (!isset($_SESSION['restaurantes_mock'])) {
       $_SESSION['restaurantes_mock'] = [];
 }
   $_SESSION['restaurantes_mock'][] = [
      'id' => count($_SESSION['restaurantes_mock']) + 1, 
     'nome' => $nome_restaurante,
     'gerente' => $gerente_restaurante,
     'menu' => $menu_restaurante
    ];


    echo "<script>alert('Restaurante \\\"" . htmlspecialchars($nome_restaurante) . "\\\" adicionado com sucesso (simulação)!');</script>";


    echo "<script>window.location.href = '../../FRONT-END/html/listarRestaurantes.php';</script>";
    exit();
} else {
    
    header('Location: incluir_restaurante.php'); 
    exit();
}
?>