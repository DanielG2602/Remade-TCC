<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($receita) ? 'Editar' : 'Nova' ?> Receita — AcervoRCT</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; }
        header { background: #4f46e5; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        header a { color: #fff; text-decoration: none; font-size: 0.875rem; opacity: 0.85; }
        header a:hover { opacity: 1; }
        main { padding: 2rem; max-width: 780px; margin: 0 auto; }
        h2 { font-size: 1.25rem; color: #1a1a2e; margin-bottom: 1.5rem; }
        .card { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); margin-bottom: 1.5rem; }
        .card h3 { font-size: 1rem; color: #374151; margin-bottom: 1.25rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb; }
        .erro { background: #fee2e2; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 6px; font-size: 0.875rem; margin-bottom: 1.25rem; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 1rem; }
        .col-full { grid-column: 1 / -1; }
        label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.375rem; }
        input, select, textarea { width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem; color: #111827; margin-bottom: 1.25rem; }
        textarea { resize: vertical; min-height: 120px; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #4f46e5; }
        .checkbox-group { display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem; }
        .checkbox-group input { width: auto; margin: 0; }

        /* ingredientes */
        #ingredientes-lista { margin-bottom: 1rem; }
        .ingrediente-row { display: grid; grid-template-columns: 2fr 1fr 1.5fr auto; gap: 0.5rem; align-items: center; margin-bottom: 0.75rem; }
        .ingrediente-row select,
        .ingrediente-row input { margin-bottom: 0; }
        .btn-remover { background: #fee2e2; color: #b91c1c; border: none; border-radius: 6px; padding: 0.5rem 0.75rem; cursor: pointer; font-size: 0.85rem; font-weight: 600; white-space: nowrap; }
        .btn-remover:hover { background: #fecaca; }
        .btn-add { background: #f0fdf4; color: #16a34a; border: 1px dashed #86efac; border-radius: 6px; padding: 0.5rem 1rem; cursor: pointer; font-size: 0.875rem; font-weight: 600; width: 100%; }
        .btn-add:hover { background: #dcfce7; }

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
        <a href="/receitas">← Receitas</a>
        <a href="/logout">Sair</a>
    </header>

    <main>
        <h2><?= isset($receita) ? 'Editar Receita' : 'Nova Receita' ?></h2>

        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="POST"
              action="<?= isset($receita) ? '/receitas/' . $receita['id'] : '/receitas' ?>"
              enctype="multipart/form-data">

            <div class="card">
                <h3>Informações gerais</h3>
                <div class="grid">
                    <div class="col-full">
                        <label for="nome">Nome *</label>
                        <input type="text" id="nome" name="nome"
                               value="<?= htmlspecialchars($receita['nome'] ?? $data['nome'] ?? '') ?>"
                               required autofocus>
                    </div>
                    <div>
                        <label for="cozinheiro_id">Cozinheiro *</label>
                        <select id="cozinheiro_id" name="cozinheiro_id" required>
                            <option value="">— Selecione —</option>
                            <?php foreach ($funcionarios as $f): ?>
                                <option value="<?= $f['id'] ?>"
                                    <?= ($receita['cozinheiro_id'] ?? $data['cozinheiro_id'] ?? '') == $f['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($f['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="categoria_id">Categoria</label>
                        <select id="categoria_id" name="categoria_id">
                            <option value="">— Selecione —</option>
                            <?php foreach ($categorias as $c): ?>
                                <option value="<?= $c['id'] ?>"
                                    <?= ($receita['categoria_id'] ?? $data['categoria_id'] ?? '') == $c['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="dt_criacao">Data de criação *</label>
                        <input type="date" id="dt_criacao" name="dt_criacao"
                               value="<?= htmlspecialchars($receita['dt_criacao'] ?? $data['dt_criacao'] ?? date('Y-m-d')) ?>"
                               required>
                    </div>
                    <div>
                        <label for="quantidade_porcao">Porções</label>
                        <input type="number" id="quantidade_porcao" name="quantidade_porcao" step="0.5" min="0"
                               value="<?= htmlspecialchars($receita['quantidade_porcao'] ?? $data['quantidade_porcao'] ?? '') ?>">
                    </div>
                    <div class="col-full">
                        <div class="checkbox-group">
                            <input type="checkbox" id="inedita" name="inedita" value="1"
                                   <?= ($receita['inedita'] ?? $data['inedita'] ?? 0) ? 'checked' : '' ?>>
                            <label for="inedita" style="margin:0">Receita inédita</label>
                        </div>
                    </div>
                    <div class="col-full">
                        <label for="foto">Foto</label>
                        <?php if (!empty($receita['foto'])): ?>
                            <img src="<?= htmlspecialchars($receita['foto']) ?>"
                                 style="display:block;max-height:120px;border-radius:6px;margin-bottom:0.75rem;">
                        <?php endif; ?>
                        <input type="file" id="foto" name="foto" accept="image/*">
                    </div>
                    <div class="col-full">
                        <label for="preparo">Modo de preparo *</label>
                        <textarea id="preparo" name="preparo" required><?= htmlspecialchars($receita['preparo'] ?? $data['preparo'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card">
                <h3>Ingredientes</h3>

                <div class="ingrediente-row" style="font-size:0.8rem;color:#6b7280;font-weight:600;margin-bottom:0.25rem;">
                    <span>Ingrediente</span>
                    <span>Quantidade</span>
                    <span>Medida</span>
                    <span></span>
                </div>

                <div id="ingredientes-lista">
                    <?php if (!empty($ingredientes)): ?>
                        <?php foreach ($ingredientes as $ing): ?>
                            <div class="ingrediente-row">
                                <select name="ingrediente_id[]">
                                    <option value="">— Selecione —</option>
                                    <?php foreach ($ingredientes_lista as $i): ?>
                                        <option value="<?= $i['id'] ?>"
                                            <?= $i['id'] == $ing['ingrediente_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($i['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="number" name="quantidade[]" step="0.01" min="0"
                                       value="<?= $ing['quantidade'] ?>">
                                <select name="medida_id[]">
                                    <option value="">— Selecione —</option>
                                    <?php foreach ($medidas as $m): ?>
                                        <option value="<?= $m['id'] ?>"
                                            <?= $m['id'] == $ing['medida_id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($m['descricao']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" class="btn-remover" onclick="removerIngrediente(this)">✕</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <button type="button" class="btn-add" onclick="adicionarIngrediente()">+ Adicionar ingrediente</button>
            </div>

            <div class="actions">
                <button class="btn btn-primary" type="submit">Salvar</button>
                <a class="btn btn-secondary" href="/receitas">Cancelar</a>
            </div>
        </form>
    </main>

    <script>
        const ingredientesOpcoes = `<?php foreach ($ingredientes_lista as $i): ?>
            <option value="<?= $i['id'] ?>"><?= htmlspecialchars($i['nome']) ?></option>
        <?php endforeach; ?>`;

        const medidasOpcoes = `<?php foreach ($medidas as $m): ?>
            <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['descricao']) ?></option>
        <?php endforeach; ?>`;

        function adicionarIngrediente() {
            const lista = document.getElementById('ingredientes-lista');
            const row = document.createElement('div');
            row.className = 'ingrediente-row';
            row.innerHTML = `
                <select name="ingrediente_id[]">
                    <option value="">— Selecione —</option>
                    ${ingredientesOpcoes}
                </select>
                <input type="number" name="quantidade[]" step="0.01" min="0" placeholder="0">
                <select name="medida_id[]">
                    <option value="">— Selecione —</option>
                    ${medidasOpcoes}
                </select>
                <button type="button" class="btn-remover" onclick="removerIngrediente(this)">✕</button>
            `;
            lista.appendChild(row);
        }

        function removerIngrediente(btn) {
            btn.closest('.ingrediente-row').remove();
        }
    </script>
</body>
</html>