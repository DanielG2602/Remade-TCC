<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($livro['nome']) ?> — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        header { background: #4f46e5; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; font-size: 0.875rem; opacity: 0.85; }
        header a:hover { opacity: 1; }
        main { padding: 2rem; max-width: 700px; margin: 0 auto; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        h2 { font-size: 1.5rem; color: #1a1a2e; margin-bottom: 0.5rem; }
        .meta { color: #6b7280; font-size: 0.9rem; margin-bottom: 1.5rem; }
        .meta span { margin-right: 1.5rem; }
        h3 { font-size: 1rem; color: #374151; margin-bottom: 1rem; }
        .empty { color: #9ca3af; font-size: 0.9rem; }
        .btn { display: inline-block; padding: 0.5rem 1.25rem; background: #4f46e5; color: #fff; border-radius: 6px; text-decoration: none; font-size: 0.875rem; font-weight: 600; }
        .btn:hover { background: #4338ca; }
    </style>
</head>
<body>
    <header>
        <a href="/livros">← Livros</a>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <div class="card">
            <h2><?= htmlspecialchars($livro['nome']) ?></h2>
            <div class="meta">
                <span>📝 <?= htmlspecialchars($livro['autor'] ?? 'Autor desconhecido') ?></span>
                <span>🏢 <?= htmlspecialchars($livro['editora'] ?? 'Editora desconhecida') ?></span>
            </div>

            <h3>Receitas neste livro</h3>
            <p class="empty">Nenhuma receita vinculada ainda.</p>
        </div>

        <a class="btn" href="/livros/<?= $livro['id'] ?>/edit">Editar livro</a>
    </main>
</body>
</html>