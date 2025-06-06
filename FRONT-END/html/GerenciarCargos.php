<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cargos</title>
    <link rel="stylesheet" href="../css/GerenciarCargos.css">
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
        <h1>Cargos Cadastrados</h1>

        <?php
        // Inclui o arquivo de conexão com o banco de dados
        // Verifique o caminho. Se conexao.php estiver em ../BACK-END, ajuste para './BACK-END/conexao.php' ou o caminho correto
        include_once '../../BACK-END/conexao.php'; // Ajuste este caminho conforme a localização real do seu conexao.php

        // Inicia a conexão PDO
        try {
            $pdo = conn(); // Assume que a função conn() está definida em conexao.php e retorna um objeto PDO

            // Prepara a query SQL para selecionar todos os cargos
            // Certifique-se de que os nomes das colunas ('nomeCargo', 'DescCargo', 'data_inicio', 'ind_ativo')
            // correspondem exatamente aos nomes no seu banco de dados
            $sql = "SELECT nomeCargo, DescCargo, data_inicio, ind_ativo FROM cargo ORDER BY nomeCargo ASC";
            $stmt = $pdo->query($sql); // Ou $stmt = $pdo->prepare($sql); $stmt->execute(); para queries mais complexas

            // Pega todos os resultados
            $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo '<p style="color: red; font-weight: bold;">Erro ao carregar os cargos: ' . $e->getMessage() . '</p>';
            $cargos = []; // Garante que $cargos seja um array vazio em caso de erro para evitar erros de loop
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th> <th>Nome Cargo</th> 
                    <th>Descrição</th>
                    <th>Data Início</th> 
                    <th>Ativo?</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($cargos)) {
                    // Itera sobre cada cargo retornado do banco de dados
                    foreach ($cargos as $cargo) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($cargo['nomeCargo']) . '</td>';
                        echo '<td>' . htmlspecialchars($cargo['DescCargo']) . '</td>';
                        echo '<td>' . htmlspecialchars(date('d M Y', strtotime($cargo['data_inicio']))) . '</td>';
                        
                        // Assumindo que 'data_fim' não existe no seu banco ou sempre é 1 Jan 1990 por padrão
                        // Se você tiver uma coluna data_fim, use $cargo['data_fim']
                        echo '<td>1 Jan 1990</td>'; // Placeholder. Adapte conforme seu banco de dados

                        // Converte o valor de 0 ou 1 para "SIM" ou "NÃO" para o botão
                        $status_texto = ($cargo['ind_ativo'] == 1) ? 'SIM' : 'NÃO';
                        $status_class = ($cargo['ind_ativo'] == 1) ? 'ativo-btn' : 'desativado-btn'; // Opcional: Adicione outra classe para estilizar NÃO

                        echo '<td><button class="' . $status_class . '">' . $status_texto . '</button></td>';
                        echo '<td>';
                        // Os links para edição e exclusão precisariam do ID do cargo
                       
                        echo '<a href="FormCargos.php"><img src="maismaismais.png" alt="Adicionar"></a>'; // Link para adicionar novo
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7">Nenhum cargo cadastrado ainda.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>