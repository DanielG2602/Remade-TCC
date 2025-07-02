<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variáveis para controlar o que será exibido
$is_logged_in = isset($_SESSION['usuario_id']);
$is_admin = ($is_logged_in && isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin');
$username_display = $is_logged_in ? htmlspecialchars($_SESSION['usuario_email']) : 'Visitante';

include_once '../../BACK-END/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gerenciar Livros</title>
  <link rel="stylesheet" href="../css/telaLivros.css" />
  <style>
    /* (estilos combinados, mantive o mais completo) */
    .action-button {
        display: inline-block;
        padding: 8px 12px;
        margin: 5px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
        font-size: 0.9em;
        text-align: center;
    }
    .add-button { background-color: #28a745; }
    .edit-button { background-color: #007bff; }
    .delete-button { background-color: #dc3545; }
    .add-new-button {
        margin-bottom: 20px;
        padding: 10px 20px;
        font-size: 1em;
    }
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 300px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .image-placeholder {
        background-color: #f0f0f0;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 1.2em;
        border-bottom: 1px solid #eee;
        margin-bottom: 10px;
        font-weight: bold;
    }
    .card-content {
        padding: 15px;
        flex-grow: 1;
    }
    .card-content h2 {
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 1.3em;
        color: #333;
    }
    .card-content p {
        font-size: 0.9em;
        color: #666;
        margin-bottom: 15px;
    }
    .card-actions {
        display: flex;
        justify-content: space-around;
        padding: 10px 15px;
        border-top: 1px solid #eee;
    }
    .navbar ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #333;
        color: white;
        padding: 10px 0;
    }
    .navbar li {
        padding: 0 15px;
    }
    .navbar a, .navbar button {
        color: white;
        text-decoration: none;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1em;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }
    .navbar a:hover, .navbar button:hover {
        background-color: #555;
    }
    .navbar .divider {
        color: #777;
    }
    .main-content {
        padding: 20px;
        max-width: 1200px;
        margin: 20px auto;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .main-content h1 {
        text-align: center;
        color: #333;
        margin-bottom: 10px;
    }
    .main-content p {
        text-align: center;
        color: #666;
        margin-bottom: 30px;
    }
    .dots {
        text-align: center;
        margin-top: 20px;
    }
    .dot {
        height: 10px;
        width: 10px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        margin: 0 5px;
        cursor: pointer;
    }
    .dot.active {
        background-color: #717171;
    }
  </style>
</head>
<body>

<header class="navbar">
  <nav>
    <ul>
      <li><a href="telaLivros.php">Livros</a></li>
      <li><a href="FormReceitas.php">Receitas</a></li>
      <li><a href="FormFuncionario.php">Funcionários</a></li>
      <li><a href="GerenciarCargos.php">Cargos</a></li>
      <li class="divider">|</li>
      <li><a href="ListarRestaurante.php">Restaurantes</a></li>
      <li><button class="btn-user">USUÁRIO</button></li>
    </ul>
  </nav>
</header>

<main class="main-content">
  <h1>LIVROS:</h1>
  <p>Gerenciamento de Livros Registrados no sistema</p>

  <a href="formLivros.php" class="action-button add-button add-new-button">
    Incluir Novo Livro
  </a>

  <div class="card-container">
    <?php
    try {
      $sql = "SELECT idLivro, titulo, isbn FROM Livro ORDER BY titulo ASC";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if ($livros) {
        foreach ($livros as $livro) {
          ?>
          <div class="card">
            <div class="image-placeholder">Imagem do Livro</div>
            <div class="card-content">
              <h2><?= htmlspecialchars($idlivro['titulo']) ?></h2>
              <p>ISBN: <?= htmlspecialchars($livro['isbn'] ?? 'N/A') ?></p>
              <div class="card-actions">
                <a href="formLivros.php?id=<?= $livro['idLivro'] ?>" class="action-button edit-button">Editar</a>
                <a href="../../BACK-END/excluir_livro.php?id=<?= $livro['idLivro'] ?>" class="action-button delete-button"
                   onclick="return confirm('Excluir <?= htmlspecialchars($livro['titulo']) ?>?');">
                  Excluir
                </a>
                <a href="avaliarLivro.php?id=<?= $livro['idLivro'] ?>" class="action-button">Avaliar →</a>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        echo '<p>Nenhum livro registrado. Clique em "Incluir Novo Livro".</p>';
      }
    } catch (PDOException $e) {
      echo '<p style="color:red;">Erro: ' . htmlspecialchars($e->getMessage()) . '</p>';
    }
    ?>
  </div>

  <div class="dots">
    <span class="dot active"></span>
    <span class="dot"></span>
  </div>
</main>

<script src="script.js"></script>
</body>
</html>
