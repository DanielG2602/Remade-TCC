<?php
// Certifique-se que session_start() é chamado UMA ÚNICA VEZ por requisição
// Se ValidaUsuario.php já cuida disso, pode remover daqui, ou usar a verificação.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclua ValidaUsuario.php para ter acesso às funções de validação
// É crucial que este arquivo contenha a lógica de segurança e as funções como 'verificarAcessoADM()'
require_once '../../BACK-END/ADM/ValidaUsuario.php';




// Se o código chegou aqui, significa que o usuário é um ADM logado.
// Agora, use as variáveis de sessão que seu processa_login.php realmente define.
// As variáveis definidas no login eram: $_SESSION['usuario_id'], $_SESSION['usuario_email'], $_SESSION['usuario_role']

// Você estava usando $_SESSION['username'] no HTML, mas o login define $_SESSION['usuario_email']
// Vamos usar $_SESSION['usuario_email'] para consistência.
$nome_exibicao = isset($_SESSION['usuario_email']) ? $_SESSION['usuario_email'] : 'Usuário';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="../../css/painel_adm.css"> </head>
<body>
    <h1>Bem-vindo, Administrador <?php echo htmlspecialchars($nome_exibicao); ?>!</h1>

    <h2>Gerenciamento de Funcionários</h2>
    <ul>
        <li><a href="cadastroFuncionario.php">Cadastrar Novo Funcionário</a></li>
        <li><a href="ConsultaFuncionario.php">Consultar/Editar/Excluir Funcionários</a></li>
        <li><a href="ListarFuncionarios.php">Listar Todos os Funcionários</a></li>
    </ul>

    <h2>Gerenciamento de Cargos</h2>
    <ul>
        <li><a href="FormCargos.php">Adicionar Novo Cargo</a></li>
        <li><a href="GerenciarCargos.php">Gerenciar Cargos (Editar/Excluir)</a></li>
        <li><a href="ListarCargos.php">Listar Cargos Existentes</a></li>
    </ul>

    <h2>Outras Funções</h2>
    <ul>
        <li><a href="../../BACK-END/ADM/logout.php">Sair do Painel</a></li> </ul>

</body>
</html>