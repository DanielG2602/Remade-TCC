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

$sql = "SELECT idReceita, nomeReceita, categoria FROM receitanovo";
$stmt = $conn->prepare($sql);
$stmt->execute();

$receitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlCategoria = "SELECT * FROM categoria ";
$stmtCategoria = $conn->prepare($sqlCategoria);
$stmtCategoria->execute();
$resultadosCategoria = $stmtCategoria->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar Funcionários</title>
  <link rel="stylesheet" href=../css/ListarFuncionarios.css>
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
    <h1>Listar Receitas</h1>
    <table>
      <tbody>
        <?php
        if ($receitas) {
          $categoriasPorId = [];
          foreach ($resultadosCategoria as $cat) {
            $categoriasPorId[$cat['idCategoria']] = $cat['nomeCategoria'];
          }

          foreach ($receitas as $receita) {
            $nomeCategoria = $categoriasPorId[$receita["categoria"]] ?? 'Desconhecida';
            echo "<tr>";
            echo "<td>" . htmlspecialchars($receita["nomeReceita"]) . "</td>";
            echo "<td>" . htmlspecialchars($nomeCategoria) . "</td>";

            echo "<td>
                  <a href='EditReceita.php?idReceita=" . htmlspecialchars($receita["idReceita"]) . "'>
                      <button type='button'>Atualizar</button>
                  </a>
                  <a href='ConsultaReceita.php?idReceita=" . htmlspecialchars($receita["idReceita"]) . "'>
                      <button type='button'>Consultar</button>
                  </a>
                </td>";
            echo "<td>
                    <form method='POST' action='../../BACK-END/excluir_receita.php'>
                        <input type='hidden' name='idReceita' value='" . htmlspecialchars($receita["idReceita"]) . "'>
                        <button type='submit'>Excluir</button>
                    </form>
                </td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='6'>Nenhum cargo encontrado</td></tr>";
        }
        ?>
      </tbody>
    </table>
    <button><a href="./FormReceita.php">Adicionar receita</a></button>
  </main>
</body>

</html>