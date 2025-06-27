<?php
// Inclui o arquivo de conexão com o banco de dados.
// Ajuste o caminho conforme a estrutura do seu projeto.
// Se este arquivo 'formLivros.php' estiver em 'FRONT-END/', e 'conexao.php' em 'BACK-END/',
// o caminho ideal seria '../BACK-END/conexao.php'. Estou usando './conexao.php'
// como você tinha na sua primeira linha. Certifique-se de que está correto para seu projeto.
include_once './conexao.php';

// Inicialização das variáveis do formulário
$idLivro = null;
$titulo = '';
$fkEditor = ''; // Supondo que você terá um campo para FKeditor
$isbn = '';
$form_action_text = 'Criar'; // Texto do botão de submissão
$form_title = 'Cadastro de Livro'; // Título do formulário

// Verifica se um ID foi passado via GET para modo de edição
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idLivro = htmlspecialchars($_GET['id']); // Sanitiza o ID recebido
    $form_action_text = 'Atualizar';
    $form_title = 'Editar Livro';

    try {
        // Tenta conectar ao banco de dados usando a função 'conn()' do 'conexao.php'
        // É importante que conn() retorne a instância PDO
        $pdo = conn();

        // Prepara a consulta SQL para buscar os dados do livro específico
        $stmt = $pdo->prepare("SELECT idLivro, FKeditor, titulo, isbn FROM Livro WHERE idLivro = :id");
        $stmt->bindParam(':id', $idLivro, PDO::PARAM_INT); // Vincula o parâmetro ID de forma segura
        $stmt->execute();
        $livro_data = $stmt->fetch(PDO::FETCH_ASSOC); // Busca os dados do livro

        if ($livro_data) {
            // Se o livro for encontrado, preenche as variáveis com os dados do banco
            $titulo = $livro_data['titulo'];
            $fkEditor = $livro_data['FKeditor'];
            $isbn = $livro_data['isbn'];
            // Se você tivesse uma coluna 'descricao', buscaria ela aqui também
        } else {
            // Se o livro não for encontrado, redireciona com uma mensagem de erro
            header('Location:../FRONT-END/telaLivros.php?status=erro&msg=Livro+não+encontrado');
            exit();
        }
    } catch (PDOException $e) {
        // Em caso de erro na conexão ou consulta, loga o erro e redireciona com mensagem
        error_log("Erro ao buscar dados do livro para edição: " . $e->getMessage());
        header('Location: ../FRONT-END/telaLivros.php?status=erro&msg=Erro+ao+carregar+dados+do+livro');
        exit();
    }
}
?>