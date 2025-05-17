<?php
// Valida se o método da requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $email = $_POST["email"];
    $confirmar_email = $_POST["confirmar_email"];
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    // Validações dos dados
    if (empty($email) || empty($confirmar_email) || empty($senha) || empty($confirmar_senha)) {
        echo "<script>alert('Todos os campos são obrigatórios!'); window.location.href='cadastro.php';</script>";
        exit;
    }

    if ($email != $confirmar_email) {
        echo "<script>alert('Os emails não conferem!'); window.location.href='cadastro.php';</script>";
        exit;
    }

    if ($senha != $confirmar_senha) {
        echo "<script>alert('As senhas não conferem!'); window.location.href='cadastro.php';</script>";
        exit;
    }

    // Criptografa a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Inclui o arquivo de conexão com o banco de dados (certifique-se de que o caminho está correto)
    include_once("./BACK-END/conexao.php");

    try {
        // Prepara a query para inserir o usuário no banco de dados
        $stmt = $conn->prepare("INSERT INTO usuarios (email, senha) VALUES (:email, :senha)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha_criptografada);
        $stmt->execute();

        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='login.php';</script>"; // Redireciona para login
        exit;

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao cadastrar usuário: " . $e->getMessage() . "'); window.location.href='cadastro.php';</script>";
        exit;
    }

} else {
    // Se o acesso ao script for feito por outro método (ex: GET), redireciona para o formulário
    header("Location: cadastro.php");
    exit;
}
?>
