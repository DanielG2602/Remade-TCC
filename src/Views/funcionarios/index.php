<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        header { background: #4f46e5; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; font-size: 0.875rem; opacity: 0.85; }
        header a:hover { opacity: 1; }
        main { padding: 2rem; max-width: 960px; margin: 0 auto; }
        .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .top h2 { font-size: 1.25rem; color: #1a1a2e; }
        .btn { padding: 0.5rem 1.25rem; background: #4f46e5; color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.875rem; font-weight: 600; }
        .btn:hover { background: #4338ca; }
        .btn-danger { background: #ef4444; padding: 0.35rem 0.75rem; font-size: 0.8rem; border: none; cursor: pointer; border-radius: 6px; color: #fff; font-weight: 600; }
        .btn-danger:hover { background: #dc2626; }
        .btn-secondary { background: #6b7280; padding: 0.35rem 0.75rem; font-size: 0.8rem; color: #fff; border-radius: 6px; text-decoration: none; font-weight: 600; }
        .btn-secondary:hover { background: #4b5563; }
        table { width: 100%; background: #fff; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); border-collapse: collapse; }
        th { text-align: left; padding: 0.875rem 1rem; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280; border-bottom: 1px solid #e5e7eb; }
        td { padding: 0.875rem 1rem; font-size: 0.9rem; color: #374151; border-bottom: 1px solid #f3f4f6; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .badge-green { background: #dcfce7; color: #16a34a; }
        .badge-red { background: #fee2e2; color: #dc2626; }
        .badge-blue { background: #dbeafe; color: #1d4ed8; }
        .actions { display: flex; gap: 0.5rem; }
        .empty { text-align: center; padding: 2rem; color: #9ca3af; }
    </style>
</head>
<body>
    <header>
        <a href="/">← Dashboard</a>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <div class="top">
            <h2>Funcionários</h2>
            <a class="btn" href="/funcionarios/novo">+ Novo funcionário</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Cargo</th>
                    <th>Perfil</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($funcionarios)): ?>
                    <tr>
                        <td colspan="7" class="empty">Nenhum funcionário cadastrado.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($funcionarios as $f): ?>
                        <tr>
                            <td><?= $f['id'] ?></td>
                            <td><?= htmlspecialchars($f['nome']) ?></td>
                            <td><?= htmlspecialchars($f['email']) ?></td>
                            <td><?= htmlspecialchars($f['nome_cargo'] ?? '—') ?></td>
                            <td>
                                <span class="badge badge-blue"><?= htmlspecialchars($f['role']) ?></span>
                            </td>
                            <td>
                                <?php if ($f['ativo']): ?>
                                    <span class="badge badge-green">Ativo</span>
                                <?php else: ?>
                                    <span class="badge badge-red">Inativo</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="actions">
                                    <a class="btn btn-secondary" href="/funcionarios/<?= $f['id'] ?>/edit">Editar</a>
                                    <form method="POST" action="/funcionarios/<?= $f['id'] ?>/delete"
                                          onsubmit="return confirm('Excluir este funcionário?')">
                                        <button class="btn btn-danger" type="submit">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>