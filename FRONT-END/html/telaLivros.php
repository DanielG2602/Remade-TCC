<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Gerenciar Livros</title>
  <link rel="stylesheet" href="../css/telaLivros.css" />

  <style>
    /* === RESET E BASE === */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: "Roboto", sans-serif;
    }
    html, body {
      height: 100%; overflow-x: hidden;
      background-color: #f2f2f2; color: #333;
      padding-top: 70px; /* espaço abaixo da navbar fixa */
    }
    body {
      display: flex; flex-direction: column; text-align: center;
    }

    /* === NAVBAR PADRONIZADA === */
    header {
      position: fixed; top: 0; left: 0;
      width: 100%; height: 70px;
      background-color: #fff8f0;
      border-bottom: 1px solid #e0e0e0;
      z-index: 1000;
    }
    nav ul {
      display: flex; justify-content: space-around; align-items: center;
      list-style: none; padding: 1rem; margin: 0;
    }
    nav ul li {
      display: flex; align-items: center;
    }
    nav ul li a {
      text-decoration: none; color: #333; font-weight: 500;
      transition: color 0.3s;
    }
    nav ul li a:hover {
      color: #1f4e79;
    }
    .divider {
      color: #aaa; font-weight: bold; padding: 0 0.5rem;
    }
    .btn-user {
      background-color: #1f4e79; color: white;
      border: none; padding: 0.5rem 1rem;
      border-radius: 8px; cursor: pointer;
      font-weight: 500; transition: background-color 0.3s;
    }
    .btn-user:hover {
      background-color: #163b5d;
    }

    /* === CONTEÚDO PRINCIPAL === */
    main {
      display: flex; align-items: center;
      justify-content: center; flex-direction: column;
      min-height: calc(100vh - 70px);
    }

    /* === BOTÕES DE AÇÃO === */
    .action-button {
      display: inline-block; padding: 8px 12px; margin: 5px;
      border: none; border-radius: 4px; cursor: pointer;
      text-decoration: none; color: white; font-size: 0.9em;
    }
    .add-button { background-color: #28a745; }
    .edit-button { background-color: #007bff; }
    .delete-button { background-color: #dc3545; }
    .add-new-button {
      margin-bottom: 20px; padding: 10px 20px; font-size: 1em;
    }

    /* === CARTÕES DE LIVROS === */
    .card-container {
      display: flex; justify-content: center; flex-wrap: wrap;
      gap: 1rem; padding: 2rem;
    }
    .card {
      background-color: #0a3d62; border-radius: 12px; overflow: hidden;
      width: 220px; color: white; text-align: left;
    }
    .image-placeholder {
      background: linear-gradient(90deg, #333, #555); height: 140px;
    }
    .card-content { padding: 1rem; }
    .card-content h2 { margin: 0 0 0.5rem; }
    .card-content a {
      color: white; text-decoration: none; font-weight: bold;
    }

    /* === PAGINAÇÃO COM PONTINHOS === */
    .dots {
      display: flex; justify-content: center;
      margin-bottom: 2rem; gap: 8px;
    }
    .dot {
      height: 10px; width: 10px; background-color: #ccc;
      border-radius: 50%; display: inline-block;
    }
    .dot.active {
      background-color: #0a3d62;
    }
  </style>
</head>
<body>

  <!-- NAVBAR-->
  <header>
    <nav>
      <ul>

        <li><a href="cadastroReceita.php">Receitas</a></li>
        <li><a href="#">Funcionários</a></li>
        <li><a href="#">Chefes de Cozinha</a></li>
        <li class="divider">|</li>
        <li><a href="restaurantes.php">Restaurantes</a></li>
        <li><button class="btn-user">USUÁRIO</button></li>
      </ul>
    </nav>
  </header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main>
    <h1>LIVROS:</h1>
    <p>Gerenciamento de Livros Registrados no sistema</p>

    <a href="formLivros.php" class="action-button add-button add-new-button">
      Incluir Novo Livro
    </a>

    <div class="card-container">
      <?php
      include_once '../../BACK-END/conexao.php';
      try {
        $sql = "SELECT idLivro, titulo, isbn FROM Livro ORDER BY titulo ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($livros) {
          foreach ($livros as $livro) {
            ?>
            <div class="card">
              <div class="image-placeholder"></div>
              <div class="card-content">
                <h2><?= htmlspecialchars($livro['titulo']) ?></h2>
                <p>ISBN: <?= htmlspecialchars($livro['isbn'] ?? 'N/A') ?></p>
                <div class="card-actions">
                  <a href="formLivro.php?id=<?= $livro['idLivro'] ?>" class="action-button edit-button">Editar</a>
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

</body>
</html>
