<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($receita['nome']) ?> — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        header { background: #4f46e5; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; font-size: 0.875rem; opacity: 0.85; }
        header a:hover { opacity: 1; }
        main { padding: 2rem; max-width: 780px; margin: 0 auto; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        h2 { font-size: 1.5rem; color: #1a1a2e; margin-bottom: 0.5rem; }
        .meta { display: flex; flex-wrap: wrap; gap: 1rem; color: #6b7280; font-size: 0.875rem; margin-bottom: 1.5rem; }
        .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; background: #ede9fe; color: #7c3aed; }
        .badge-yellow { background: #fef9c3; color: #a16207; }
        .foto { width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px; margin-bottom: 1.5rem; }
        h3 { font-size: 1rem; color: #374151; margin-bottom: 1rem; }
        .preparo { color: #374151; line-height: 1.7; white-space: pre-wrap; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 0.5rem 0.75rem; font-size: 0.8rem; text-transform: uppercase; color: #6b7280; border-bottom: 1px solid #e5e7eb; }
        td { padding: 0.625rem 0.75rem; font-size: 0.9rem; color: #374151; border-bottom: 1px solid #f3f4f6; }
        tr:last-child td { border-bottom: none; }
        .actions { display: flex; gap: 0.75rem; }
        .btn { display: inline-block; padding: 0.5rem 1.25rem; border-radius: 6px; font-size: 0.875rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; }
        .btn-primary { background: #4f46e5; color: #fff; }
        .btn-primary:hover { background: #4338ca; }
        .btn-danger { background: #ef4444; color: #fff; }
        .btn-danger:hover { background: #dc2626; }
        .empty { color: #9ca3af; font-size: 0.9rem; }
    </style>
</head>
<body>
    <header>
        <a href="/receitas">← Receitas</a>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <div class="card">
            <?php if ($receita['foto']): ?>
                <img class="foto" src="<?= htmlspecialchars($receita['foto']) ?>" alt="<?= htmlspecialchars($receita['nome']) ?>">
            <?php endif; ?>

            <h2>
                <?= htmlspecialchars($receita['nome']) ?>
                <?php if ($receita['inedita']): ?>
                    <span class="badge badge-yellow">Inédita</span>
                <?php endif; ?>
                <?php if ($receita['nome_categoria']): ?>
                    <span class="badge"><?= htmlspecialchars($receita['nome_categoria']) ?></span>
                <?php endif; ?>
            </h2>

            <div class="meta">
                <span>👨‍🍳 <?= htmlspecialchars($receita['nome_cozinheiro'] ?? '—') ?></span>
                <span>📅 <?= date('d/m/Y', strtotime($receita['dt_criacao'])) ?></span>
                <?php if ($receita['quantidade_porcao']): ?>
                    <span>🍽️ <?= $receita['quantidade_porcao'] ?> porção(ões)</span>
                <?php endif; ?>
            </div>

            <h3>Modo de preparo</h3>
            <p class="preparo"><?= htmlspecialchars($receita['preparo']) ?></p>
        </div>

        <div class="card">
            <h3>Ingredientes</h3>
            <?php if (empty($ingredientes)): ?>
                <p class="empty">Nenhum ingrediente cadastrado.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Ingrediente</th>
                            <th>Quantidade</th>
                            <th>Medida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ingredientes as $ing): ?>
                            <tr>
                                <td><?= htmlspecialchars($ing['nome_ingrediente']) ?></td>
                                <td><?= $ing['quantidade'] ?></td>
                                <td><?= htmlspecialchars($ing['nome_medida'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

        <div class="actions">
            <a class="btn btn-primary" href="/receitas/<?= $receita['id'] ?>/edit">Editar</a>
            <form method="POST" action="/receitas/<?= $receita['id'] ?>/delete"
                  onsubmit="return confirm('Excluir esta receita?')">
                <button class="btn btn-danger" type="submit">Excluir</button>
            </form>
        </div>
    </main>
</body>
</html>