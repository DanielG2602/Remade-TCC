<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }

        header {
            background: #4f46e5;
            color: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 { font-size: 1.25rem; }

        header a {
            color: #fff;
            font-size: 0.875rem;
            text-decoration: none;
            opacity: 0.85;
        }

        header a:hover { opacity: 1; }

        main {
            padding: 2rem;
            max-width: 960px;
            margin: 0 auto;
        }

        .welcome {
            font-size: 1.25rem;
            color: #1a1a2e;
            margin-bottom: 2rem;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1rem;
        }

        .card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            text-decoration: none;
            color: #374151;
            transition: box-shadow 0.2s;
        }

        .card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.12); }

        .card span {
            display: block;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .card strong { font-size: 0.95rem; }
    </style>
</head>
<body>
    <header>
        <h1>AcervoRCT</h1>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <p class="welcome">
            Olá, <strong><?= htmlspecialchars($_SESSION['usuario']['nome']) ?></strong>!
        </p>

        <div class="cards">
            <a class="card" href="/funcionarios">
                <span>👤</span>
                <strong>Funcionários</strong>
            </a>
            <a class="card" href="/cargos">
                <span>🏷️</span>
                <strong>Cargos</strong>
            </a>
            <a class="card" href="/receitas">
                <span>🍽️</span>
                <strong>Receitas</strong>
            </a>
            <a class="card" href="/ingredientes">
                <span>🥕</span>
                <strong>Ingredientes</strong>
            </a>
            <a class="card" href="/categorias">
                <span>📂</span>
                <strong>Categorias</strong>
            </a>
            <a class="card" href="/livros">
                <span>📚</span>
                <strong>Livros</strong>
            </a>
            <a class="card" href="/restaurantes">
                <span>🍴</span>
                <strong>Restaurantes</strong>
            </a>
            <a class="card" href="/degustacoes">
                <span>⭐</span>
                <strong>Degustações</strong>
            </a>
        </div>
    </main>
</body>
</html>