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
      <form>
        <label for="nova-senha">Nova Senha</label>
        <input type="password" id="nova-senha" placeholder="Senha" required>

        <label for="confirma-senha">Confirme sua Nova Senha</label>
        <input type="password" id="confirma-senha" placeholder="Senha" required>

        <div class="buttons">
          <button type="button" class="cancel">Cancelar</button>
          <button type="submit" class="submit">Recuperar</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>