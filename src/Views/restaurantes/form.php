<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($restaurante) ? 'Editar' : 'Novo' ?> Restaurante — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        header { background: #4f46e5; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; font-size: 0.875rem; opacity: 0.85; }
        header a:hover { opacity: 1; }
        main { padding: 2rem; max-width: 520px; margin: 0 auto; }
        h2 { font-size: 1.25rem; color: #1a1a2e; margin-bottom: 1.5rem; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        .erro { background: #fee2e2; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1.25rem; }
        label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem; }
        input, select { width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; color: #111827; margin-bottom: 1.25rem; }
        input:focus, select:focus { outline: none; border-color: #4f46e5; }
        .actions { display: flex; gap: 0.75rem; }
        .btn { padding: 0.625rem 1.5rem; border-radius: 6px; font-size: 0.9rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; }
        .btn-primary { background: #4f46e5; color: #fff; }
        .btn-primary:hover { background: #4338ca; }
        .btn-secondary { background: #f3f4f6; color: #374151; }
        .btn-secondary:hover { background: #e5e7eb; }
    </style>
</head>
<body>
    <header>
        <a href="/restaurantes">← Restaurantes</a>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <h2><?= isset($restaurante) ? 'Editar Restaurante' : 'Novo Restaurante' ?></h2>

        <div class="card">
            <?php if (!empty($erro)): ?>
                <div class="erro"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <form method="POST" action="<?= isset($restaurante) ? '/restaurantes/' . $restaurante['id'] : '/restaurantes' ?>">
                <label for="nome">Nome *</label>
                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($restaurante['nome'] ?? $data['nome'] ?? '') ?>"
                    required
                    autofocus
                >

                <label for="contato">Contato</label>
                <input
                    type="text"
                    id="contato"
                    name="contato"
                    value="<?= htmlspecialchars($restaurante['contato'] ?? $data['contato'] ?? '') ?>"
                >

                <label for="telefone">Telefone</label>
                <input
                    type="text"
                    id="telefone"
                    name="telefone"
                    value="<?= htmlspecialchars($restaurante['telefone'] ?? $data['telefone'] ?? '') ?>"
                >

                <?php if (isset($restaurante)): ?>
                    <label for="ativo">Status</label>
                    <select id="ativo" name="ativo">
                        <option value="1" <?= $restaurante['ativo'] ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= !$restaurante['ativo'] ? 'selected' : '' ?>>Inativo</option>
                    </select>
                <?php endif; ?>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                    <a class="btn btn-secondary" href="/restaurantes">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>