<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciar Funcionários</title>
  <link rel="stylesheet" href=../css/GerenciarCargos.css>
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
    <h1>Cargos Cadastrado</h1>
    <table>
      <thead>
        <tr>
          <th>Nome Cargo</th> 
          <th>Descrição</th>
          <th>Data início</th> 
          <th>Data fim</th> 
          <th>Indicar cargo ativo</th> 
          <th>Pesquisar</th> 
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Cozinheiro</td>
          <td>Responsável por elaborar receitas</td>
          <td>1 Mar 2025</td>
          <td>1 Jan 1990</td>
          <td><button class="ativo-btn">SIM</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
        <tr>
          <td>Degustador</td>
          <td>Responsável por degustar as receitas e atribuir notas</td>
          <td>2 Mar 2025</td>
          <td>1 Jan 1990</td>
          <td><button class="ativo-btn">NÃO</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
        <tr>
          <td>Editor</td>
          <td>Responsável por editar livros de receitas e atribuir nota</td>
          <td>1 Mar 2025</td>
          <td>1 Jan 1990</td>
          <td><button class="ativo-btn">SIM</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
        <tr>
          <td>Administrador</td>
          <td>Responsável pela administração da empresa</td>
          <td>2 Mar 2025</td>
          <td>1 Jan 1990</td>
          <td><button class="ativo-btn">NÃO</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
        <tr>
          <td>Teste de Incl e Alt</td>
          <td>Alterado</td>
          <td>3 Mar 2025</td>
          <td>1 Jan 1990</td>
          <td><button class="ativo-btn">SIM</button></td>
          <td>
            <img src="lapis.jpg" alt="Editar">
            <img src="lixeira3.png" alt="Excluir">
            <img src="maismaismais.png" alt="Adicionar">
          </td>
        </tr>
        <tr>
          <td>Analista de sistemas</td>
          <td>Responsável pelo desenvolvimento de sistemas</td>
          <td>1 Mar 2025</td>
          <td>1 Jan 1990</td>
          <td><button class="ativo-btn">SIM</button></td>
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