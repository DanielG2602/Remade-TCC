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
      <p>Informe seu e-mail para receber um link de redefinição de senha.</p>
      <form action="../../BACK-END/ADM/solicitarRedefinicao.php" method="POST">
        <label for="email">Informe seu e-mail</label>
        <input type="email" id="email" name="email" placeholder="seuemail@exemplo.com" required>

        <div class="buttons">
          <button type="button" class="cancel" onclick="window.location.href='./FormLogin.php'">Cancelar</button>
          <button type="submit" class="submit">Enviar Link</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>