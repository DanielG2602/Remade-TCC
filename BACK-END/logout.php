<?php


session_start(); 


$_SESSION = array();


if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}


session_destroy();

// 4. Redireciona o usuário para a página de login após o logout.
// O caminho agora é relativo a partir de BACK-END/ para FRONT-END/html/
header('Location: ../FRONT-END/html/FormLogin.php');
exit();
?>