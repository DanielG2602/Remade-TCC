<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Senha</title>
  <link rel="stylesheet" href="../css/EsqueceuSenha.css">
</head>
<body>
  <div class="background">
    <div class="form-container">
      <h2>Recupere a sua Senha</h2>
      <p>Abaixo informe sua nova senha</p>
      <form action="../../BACK-END/ADM/recuperarSenha.php" method="POST">
        <label for="Email">Informe seu email</label>
        <input type="email" id="email" placeholder="email" required>

        <label for="confirma-senha">Informe sua Nova Senha</label>
        <input type="password" id="senha" placeholder="senha" required>

        <div class="buttons">
          <button type="button" class="cancel">Cancelar</button>
          <button type="submit" class="submit">Recuperar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>