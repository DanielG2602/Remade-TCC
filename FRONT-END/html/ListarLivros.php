<?php 
    include_once __DIR__ . '/../../BACK-END/conexao.php';

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Variáveis para controlar o que será exibido
$is_logged_in = isset($_SESSION['usuario_id']);
$is_admin = ($is_logged_in && isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin');
$username_display = $is_logged_in ? htmlspecialchars($_SESSION['usuario_email']) : 'Visitante';

$conn = conn();

$sql = "SELECT idLivro, nomeLivro, editora, autor, receitas FROM livros";
$stmt = $conn->prepare($sql);
$stmt->execute();

$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlReceitas = "SELECT * FROM receitanovo ";
$stmtReceitas = $conn->prepare($sqlReceitas);
$stmtReceitas->execute();
$resultadosReceita = $stmtReceitas->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

  <header>
    <nav>
      <ul class="menu">
        <li><a href="#">Livros</a></li>
        <li><a href="#">Funcionários</a></li>
        <li class="menu-right"><a href="#">Restaurantes</a></li>
        <li><button class="usuario-btn">USUÁRIO</button></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Listar livros</h1>
    <table>
      <tbody>
        <?php
        if ($livros) {
          $livrosPorId = [];
          foreach ($resultadosReceita as $cat) {
            $livrosPorId[$cat['idReceita']] = $cat['nomeReceita'];
          }

          foreach ($livros as $livro) {
            $receitas = $livrosPorId[$livro["receitas"]] ?? 'Desconhecida';
            echo "<tr>";
            echo "<td>" . htmlspecialchars($livro["nomeLivro"]) . "</td>";
            echo "<td>" . htmlspecialchars($livro["editora"]) . "</td>";
            echo "<td>" . htmlspecialchars($livro["autor"]) . "</td>";
            echo "<td><a href='ConsultaReceita.php?idReceita=" . htmlspecialchars($cat["idReceita"]) . "'>
                      ". htmlspecialchars($cat["nomeReceita"]) ."
                  </a></td>";

            echo "<td>
                  <a href='EditLivro.php?idLivro=" . htmlspecialchars($livro["idLivro"]) . "'>
                      <button type='button'>Atualizar</button>
                  </a>
                  <a href='ConsultarLivro.php?idLivro=" . htmlspecialchars($livro["idLivro"]) . "'>
                      <button type='button'>Consultar</button>
                  </a>
                </td>";
            echo "<td>
                    <form method='POST' action='../../BACK-END/excluir_livro.php'>
                        <input type='hidden' name='idLivro' value='" . htmlspecialchars($livro["idLivro"]) . "'>
                        <button type='submit'>Excluir</button>
                    </form>
                </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>Nenhuma livro encontrada</td></tr>";
        }
        ?>
      </tbody>
    </table>
    <button><a href="./FormLivro.php">Adicionar Livro</a></button>
  </main>
</body>
</html>