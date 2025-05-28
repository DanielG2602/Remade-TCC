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
        <li><a href="#">Receitas</a></li>
        <li><a href="#">Funcionários</a></li>
        <li class="menu-right"><a href="#">Restaurantes</a></li>
        <li><button class="usuario-btn">USUÁRIO</button></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Listar Funcionários</h1>
    <table>
      <thead>
        <tr>
          <th>Nome Funcionário</th> 
          <th>Data Emissão</th>
          <th>Salário</th> 
          <th>Cargo</th> 
          <th>Incluir Cargo</th> 
          <th>Pesquisar</th> 
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>João Paulo</td>
          <td>1 Mar 2022</td>
          <td>R$2.700</td>
          <td>Cozinheiro</td>
          <td><button class="ativo-btn">SIM</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
        <tr>
          <td>Luy</td>
          <td>10 Mar 2022</td>
          <td>R$7.000</td>
          <td>Analista de Sistemas</td>
          <td><button class="ativo-btn">NÃO</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</body>
</html>