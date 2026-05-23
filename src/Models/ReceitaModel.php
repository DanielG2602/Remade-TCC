<?php 

declare(strict_types=1);

namespace App\Models;

class ReceitaModel extends Model {

    protected string $table = 'receita';

    public function allCompleto() : array {
        $stmt = $this->db->query("
            SELECT r.*,
                    c.nome        AS nome_categoria,
                    f.nome        AS nome_cozinheiro
            FROM receita r
            LEFT JOIN categoria c ON c.id = r.categoria_id
            LEFT JOIN funcionario f ON f.id = r.cozinheiro_id
            ORDER BY r.criado_em DESC
        ");

        return $stmt->fetchAll();
    }

    public function findCompleto(int $id) : array|false {
        $stmt = $this->db->prepare("
            SELECT r.*,
                   c.nome AS nome_categoria,
                   f.nome AS nome_cozinheiro
            FROM receita r
            LEFT JOIN categoria c ON c.id = r.categoria_id
            LEFT JOIN funcionario f ON f.id = r.cozinheiro_id
            WHERE r.id = ?
        ");

        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function findIngredientes (int $receitaId) : array {
        $stmt = $this->db->prepare("
            SELECT ri.*,
                   i.nome AS nome_ingrediente,
                   m.descricao AS nome_medida
            FROM receita_ingrediente ri
            JOIN ingrediente i ON i.id = ri.ingrediente_id
            LEFT JOIN medida m ON m.id = ri.medida_id
            WHERE ri.receita_id = ?
        ");

        $stmt->execute([$receitaId]);
        return $stmt->fetchAll();
    }

    public function create (array $data) : int {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table}
                (nome, preparo, quantidade_porcao, inedita, foto, dt_criacao, categoria_id, cozinheiro_id)
            VALUES
                (:nome, :preparo, :quantidade_porcao, :inedita, :foto, :dt_criacao, :categoria_id, :cozinheiro_id)
        ");

        $stmt->execute([
            ':nome'              => $data['nome'],
            ':preparo'           => $data['preparo'],
            ':quantidade_porcao' => $data['quantidade_porcao'] ?? null,
            ':inedita'           => $data['inedita'] ?? 0,
            ':foto'              => $data['foto'] ?? null,
            ':dt_criacao'        => $data['dt_criacao'],
            ':categoria_id'      => $data['categoria_id'] ?: null,
            ':cozinheiro_id'     => $data['cozinheiro_id'],
        ]);

        return (int) $this->db->lastInsertId();
    }

    public function update (int $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET
                nome              = :nome,
                preparo           = :preparo,
                quantidade_porcao = :quantidade_porcao,
                inedita           = :inedita,
                dt_criacao        = :dt_criacao,
                categoria_id      = :categoria_id,
                cozinheiro_id     = :cozinheiro_id,
                atualizado_em     = NOW()
            WHERE id = :id
        ");

        return $stmt->execute([
            ':nome'              => $data['nome'],
            ':preparo'           => $data['preparo'],
            ':quantidade_porcao' => $data['quantidade_porcao'] ?? null,
            ':inedita'           => $data['inedita'] ?? 0,
            ':dt_criacao'        => $data['dt_criacao'],
            ':categoria_id'      => $data['categoria_id'] ?: null,
            ':cozinheiro_id'     => $data['cozinheiro_id'],
            ':id'                => $id,
        ]);
    }

    public function syncIngredientes(int $receitaId, array $ingredientes) : void {
        $stmt = $this->db->prepare("
            DELETE FROM receita_ingrediente WHERE receita_id = ?
        ");

        $stmt->execute([$receitaId]);

        if (empty($ingredientes)) {
            return;
        }
 
        $stmt = $this->db->prepare("
            INSERT INTO receita_ingrediente (receita_id, ingrediente_id, quantidade, medida_id)
            VALUES (:receita_id, :ingrediente_id, :quantidade, :medida_id)
        ");

        foreach ($ingredientes as $ing) {
            if (empty($ing['ingrediente_id'])) {
                continue;
            }
 
            $stmt->execute([
                ':receita_id'     => $receitaId,
                ':ingrediente_id' => $ing['ingrediente_id'],
                ':quantidade'     => $ing['quantidade'] ?? 0,
                ':medida_id'      => $ing['medida_id'] ?: null,
            ]);
        }
    }

    public function updateFoto (int $id, string $foto) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET foto = ? WHERE id = ?
        ");

        return $stmt->execute([$foto, $id]);
    }

}