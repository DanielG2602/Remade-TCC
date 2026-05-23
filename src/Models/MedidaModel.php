<?php

declare(strict_types = 1);

namespace App\Models;

class MedidaModel extends Model {
    protected string $table = 'medida';

    public function create (array $data) : bool {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (descricao) VALUES (:descricao)
        ");

        return $stmt->execute([':execute'=> $data['execute']]);
    }

    public function update(int $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET descricao = :descricao WHERE id = :id
        ");

        return $stmt->execute([
            ':descricao' => $data['descricao'], 'id' => $id,
        ]);
    }
}