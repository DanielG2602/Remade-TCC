<?php
 session_start();
 require_once '../conexao.php';

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $senha = trim($_POST['senha'] ?? '');

  if (empty($email) || empty($senha)) {
   $_SESSION['erro_login'] = "Por favor, preencha todos os campos.";
   header('Location: ../FRONT-END/html/FormLogin.php');
   exit();
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $_SESSION['erro_login'] = "E-mail inválido.";
   header('Location: ../../FRONT-END/html/FormLogin.php');
   exit();
  }

  try {
   $pdo = conn();
   $stmt = $pdo->prepare("SELECT id, email, senha FROM `usuarios` WHERE email = :email");
   $stmt->bindParam(':email', $email, PDO::PARAM_STR);
   $stmt->execute();

   $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


   if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_email'] = $usuario['email'];


    header('Location: ../../FRONT-END/html/index.php');
    exit();
   } else {

    $_SESSION['erro_login'] = "E-mail ou senha incorretos.";
    header('Location: ../../FRONT-END/html/FormLogin.php');
    exit();
   }
  } catch (PDOException $e) {
   error_log("Erro no login: " . $e->getMessage()); // Registra o erro no log do servidor
   $_SESSION['erro_login'] = "Ocorreu um erro ao tentar fazer login. Por favor, tente novamente mais tarde.";
   header('Location: ../../FRONT-END/html/FormLogin.php');
   exit();
  }
 } else {

  header('Location: ../../FRONT-END/html/FormLogin.php');
  exit();
 }
 ?>