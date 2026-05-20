<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($funcionario) ? 'Editar' : 'Novo' ?> Funcionário — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        header { background: #4f46e5; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; font-size: 0.875rem; opacity: 0.85; }
        header a:hover { opacity: 1; }
        main { padding: 2rem; max-width: 640px; margin: 0 auto; }
        h2 { font-size: 1.25rem; color: #1a1a2e; margin-bottom: 1.5rem; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        .erro { background: #fee2e2; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1.25rem; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 1rem; }
        label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem; }
        input, select { width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; color: #111827; margin-bottom: 1.25rem; }
        input:focus, select:focus { outline: none; border-color: #4f46e5; }
        .actions { display: flex; gap: 0.75rem; margin-top: 0.5rem; }
        .btn { padding: 0.625rem 1.5rem; border-radius: 6px; font-size: 0.9rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; }
        .btn-primary { background: #4f46e5; color: #fff; }
        .btn-primary:hover { background: #4338ca; }
        .btn-secondary { background: #f3f4f6; color: #374151; }
        .btn-secondary:hover { background: #e5e7eb; }
    </style>
</head>
<body>
    <header>
        <a href="/funcionarios">← Funcionários</a>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <h2><?= isset($funcionario) ? 'Editar Funcionário' : 'Novo Funcionário' ?></h2>

        <div class="card">
            <?php if (!empty($erro)): ?>
                <div class="erro"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <?php
                $action = isset($funcionario) ? '/funcionarios/' . $funcionario['id'] : '/funcionarios';
                $val    = fn(string $key) => htmlspecialchars($funcionario[$key] ?? $data[$key] ?? '');
            ?>

            <form method="POST" action="<?= $action ?>">
                <div class="grid">
                    <div>
                        <label for="nome">Nome *</label>
                        <input type="text" id="nome" name="nome" value="<?= $val('nome') ?>" required autofocus>
                    </div>
                    <div>
                        <label for="nome_fantasia">Nome fantasia</label>
                        <input type="text" id="nome_fantasia" name="nome_fantasia" value="<?= $val('nome_fantasia') ?>">
                    </div>
                    <div>
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" value="<?= $val('email') ?>" required>
                    </div>
                    <div>
                        <label for="rg">RG</label>
                        <input type="text" id="rg" name="rg" value="<?= $val('rg') ?>">
                    </div>
                    <div>
                        <label for="salario">Salário</label>
                        <input type="number" id="salario" name="salario" step="0.01" value="<?= $val('salario') ?>">
                    </div>
                    <div>
                        <label for="dt_admissao">Admissão</label>
                        <input type="date" id="dt_admissao" name="dt_admissao" value="<?= $val('dt_admissao') ?>">
                    </div>
                    <div>
                        <label for="cargo_id">Cargo</label>
                        <select id="cargo_id" name="cargo_id">
                            <option value="">— Selecione —</option>
                            <?php foreach ($cargos as $cargo): ?>
                                <option value="<?= $cargo['id'] ?>"
                                    <?= ($funcionario['cargo_id'] ?? $data['cargo_id'] ?? '') == $cargo['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cargo['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="role">Perfil</label>
                        <select id="role" name="role">
                            <option value="funcionario" <?= ($funcionario['role'] ?? 'funcionario') === 'funcionario' ? 'selected' : '' ?>>Funcionário</option>
                            <option value="admin" <?= ($funcionario['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                        </select>
                    </div>
                </div>

                <?php if (!isset($funcionario)): ?>
                    <label for="senha">Senha *</label>
                    <input type="password" id="senha" name="senha" required>
                <?php endif; ?>

                <?php if (isset($funcionario)): ?>
                    <label for="ativo">Status</label>
                    <select id="ativo" name="ativo">
                        <option value="1" <?= $funcionario['ativo'] ? 'selected' : '' ?>>Ativo</option>
                        <option value="0" <?= !$funcionario['ativo'] ? 'selected' : '' ?>>Inativo</option>
                    </select>
                <?php endif; ?>

                <div class="actions">
                    <button class="btn btn-primary" type="submit">Salvar</button>
                    <a class="btn btn-secondary" href="/funcionarios">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
<script src="/js/mascaras.js"></script>
</body>
</html>