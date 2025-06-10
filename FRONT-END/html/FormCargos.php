<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/FormCargos.css" />
  <title>Cadastro de Cargos</title>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="telaLivros.php">Livros</a></li>
        <li><a href="FormReceitas.php">Receitas</a></li>
        <li><a href="FormFuncionario.php">Funcionários</a></li>
        <li class="divider">|</li>
        <li><a href="ListarRestaurante.php">Restaurantes</a></li>
        <li><button class="btn-user">USUÁRIO</button></li>
      </ul>
    </nav>
  </header>

  <main>
    <form action="../../BACK-END/cargos.php" method="POST">
      <h2>Cadastro de Cargos</h2>

      <label for="NomeCargo">Nome do Cargo:</label>
      <input type="text" name="NomeCargo" id="NomeCargo" placeholder="Digite o nome do cargo" required />

      <label for="DescCargo">Descrição do Cargo:</label>
      <input type="text" name="DescCargo" id="DescCargo" placeholder="Descreva o cargo" required />

      <label for="data_inicio">Data:</label>
      <input type="date" id="data_inicio" name="data_inicio" 
             value="" min="01-01-1980" max="01-01-2050" required>

      <label for="StatusCargo">Status do Cargo:</label>
      <select name="Status" id="StatusCargo" required>
        <option value="">Selecione o status</option>
        <option value="Ativo">Ativo</option>
        <option value="Desativado">Desativado</option>
      </select>

      <div class="botoes">
        <button type="button" class="cancelar"><a href="FormCargos.php">cancelar</a></button>
        <button type="submit" class="confirmar">Criar</a></button>
      </div>
    </form>
  </main>
</body>
</html>
