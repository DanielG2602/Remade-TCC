<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cargos</title>
    <link rel="stylesheet" href="../css/GerenciarCargos.css">
    <style></style>
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
        include_once '../../BACK-END/conexao.php'; 

        $search_term = '';
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $search_term = htmlspecialchars($_GET['search']);
        }

        try {
            $pdo = conn();

            $sql = "SELECT idCargo, nomeCargo, DescCargo, data_inicio, ind_ativo FROM cargo";
            
            if (!empty($search_term)) {
                $sql .= " WHERE nomeCargo LIKE :search_term OR DescCargo LIKE :search_term";
            }
            $sql .= " ORDER BY nomeCargo ASC";

            $stmt = $pdo->prepare($sql); 

            if (!empty($search_term)) {
                $stmt->bindValue(':search_term', '%' . $search_term . '%', PDO::PARAM_STR);
            }
            
            $stmt->execute();
            $cargos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo '<p style="color: red; font-weight: bold;">Erro ao carregar os cargos: ' . $e->getMessage() . '</p>';
            $cargos = []; 
        }
        ?>

        <?php if (isset($_GET['status']) && isset($_GET['msg'])): ?>
            <p class="status-message <?php echo htmlspecialchars($_GET['status']); ?>">
                <?php echo htmlspecialchars(urldecode($_GET['msg'])); ?>
            </p>
        <?php endif; ?>

        <a href="FormCargos.php" class="add-new-cargo">Adicionar Novo Cargo</a>

        <div class="search-container">
            <form action="gerenciarCargos.php" method="GET">
                <input type="text" name="search" placeholder="Pesquisar cargo ou descrição..." value="<?php echo $search_term; ?>">
                <button type="submit">Pesquisar</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome Cargo</th>
                    <th>Descrição</th>
                    <th>Data Início</th> 
                    <th>Ativo?</th> 
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($cargos)) {
                    foreach ($cargos as $cargo) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($cargo['nomeCargo']) . '</td>';
                        echo '<td>' . htmlspecialchars($cargo['DescCargo']) . '</td>';
                        echo '<td>' . htmlspecialchars(date('d M Y', strtotime($cargo['data_inicio']))) . '</td>';
                        
                        $status_texto = ($cargo['ind_ativo'] == 1) ? 'SIM' : 'NÃO';
                        $status_class = ($cargo['ind_ativo'] == 1) ? 'ativo-btn' : 'desativado-btn'; 

                        echo '<td><button class="' . $status_class . '">' . $status_texto . '</button></td>';
                        echo '<td>';
                        
                        echo '<a href="FormCargos.php?id=' . htmlspecialchars($cargo['idCargo']) . '" class="action-button edit-btn">Editar</a>';
                        
                  
                        echo '<a href="../../BACK-END/excluir_cargo.php?id=' . htmlspecialchars($cargo['idCargo']) . '" class="action-button delete-btn" onclick="return confirm(\'Tem certeza que deseja excluir o cargo: ' . htmlspecialchars($cargo['nomeCargo']) . '?\');">Excluir</a>';

                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">Nenhum cargo cadastrado ainda.</td></tr>'; 
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
</body>
</html>