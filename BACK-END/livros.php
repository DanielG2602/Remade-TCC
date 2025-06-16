<?php
            include_once '../../BACK-END/conexao.php'; // Adjust path if needed

            $idLivro = null;
            $titulo = '';
            $fkEditor = '';
            $isbn = '';
            $form_action_text = 'Criar';
            $form_title = 'Cadastro de Livro';

            // Check if an ID is passed for editing
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $idLivro = htmlspecialchars($_GET['id']);
                $form_action_text = 'Atualizar';
                $form_title = 'Editar Livro';

                try {
                    $stmt = $pdo->prepare("SELECT idLivro, FKeditor, titulo, isbn FROM Livro WHERE idLivro = :id");
                    $stmt->bindParam(':id', $idLivro, PDO::PARAM_INT);
                    $stmt->execute();
                    $livro_data = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($livro_data) {
                        $titulo = $livro_data['titulo'];
                        $fkEditor = $livro_data['FKeditor'];
                        $isbn = $livro_data['isbn'];
                        // If you had a 'descricao' column, you'd fetch it here too.
                    } else {
                        // Book not found, redirect or show error
                        header('Location: telaLivros.php?status=erro&msg=Livro+não+encontrado');
                        exit();
                    }
                } catch (PDOException $e) {
                    error_log("Erro ao buscar dados do livro para edição: " . $e->getMessage());
                    header('Location: telaLivros.php?status=erro&msg=Erro+ao+carregar+dados+do+livro');
                    exit();
                }
            }
            ?>