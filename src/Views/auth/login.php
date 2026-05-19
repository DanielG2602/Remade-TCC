<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — AcervoRCT</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .card {
            background: #fff;
            padding: 2.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 380px;
        }

        h1 {
            font-size: 1.5rem;
            color: #1a1a2e;
            margin-bottom: 0.25rem;
        }

        p.subtitle {
            font-size: 0.875rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }

        .erro {
            background: #fee2e2;
            color: #b91c1c;
            padding: 0.75rem 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.375rem;
        }

        input {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #111827;
            margin-bottom: 1.25rem;
            transition: border-color 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #4f46e5;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        button:hover {
            background: #4338ca;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>AcervoRCT</h1>
        <p class="subtitle">Faça login para continuar</p>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST" action="/login">
            <label for="email">E-mail</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="seu@email.com"
                required
                autofocus
            >

            <label for="senha">Senha</label>
            <input
                type="password"
                id="senha"
                name="senha"
                placeholder="••••••••"
                required
            >

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>