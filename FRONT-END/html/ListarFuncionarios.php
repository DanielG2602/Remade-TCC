<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$is_logged_in = isset($_SESSION['usuario_id']);
$is_admin = ($is_logged_in && isset($_SESSION['usuario_role']) && $_SESSION['usuario_role'] === 'admin');
$username_display = $is_logged_in ? htmlspecialchars($_SESSION['usuario_email']) : 'Visitante';

include_once __DIR__ . '/../../BACK-END/conexao.php';

$conn = conn();

$sql = "SELECT idFuncionario, nome, Cargo_idCargo FROM funcionario";
$stmt = $conn->prepare($sql);
$stmt->execute();

$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <li><a href="./FormReceitas.php">Receitas</a></li>
        <li><a href="#">Funcionários</a></li>
        <li class="menu-right"><a href="#">Restaurantes</a></li>
        <li><button class="usuario-btn">USUÁRIO</button></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Listar Funcionários</h1>
    <table>
      <tbody>
        <?php
        if ($funcionarios) {
          foreach ($funcionarios as $funcionario) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($funcionario["nome"]) . "</td>";
            echo "<td>" . htmlspecialchars($funcionario["Cargo_idCargo"]) . "</td>";
            echo "<td>
                    <a href='EditFuncionario.php?idFuncionario=" . htmlspecialchars($funcionario["idFuncionario"]) . "'>
                        <button type='button'>Atualizar</button>
                    </a>
                    <a href='ConsultaFuncionario.php?idFuncionario=" . htmlspecialchars($funcionario["idFuncionario"]) . "'>
                        <button type='button'>Consultar</button>
                    </a>
                </td>";
            echo "<td>
                    <form method='POST' action='../../BACK-END/excluir_funcionario.php'>
                        <input type='hidden' name='idFuncionario' value='" . htmlspecialchars($funcionario["idFuncionario"]) . "'>
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
    <button><a href="./FormFuncionario.php">Adicionar funcionario</a></button>
  </main>
</body>

</html>