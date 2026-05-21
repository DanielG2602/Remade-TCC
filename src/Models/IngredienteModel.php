<?php

declare(strict_types=1);

namespace App\Models;

class IngredienteModel extends Model {
    protected string $table = 'ingrediente';

    public function create (array $data) : bool {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (nome, descricao) VALUES (:nome, :descricao) 
        ");

        return $stmt->execute([':nome' => $data['nome'], 'descricao' => $data['descricao'] ?? null]);
    }

    public function update (int $id, array $data) : bool{
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET nome = :nome, descricao = :descricao WHERE id = :id
        ");

        return $stmt->execute([':nome' => $data['nome'], ':descricao' => $data['descricao'] ?? null, ':id' => $id]);
    }
}