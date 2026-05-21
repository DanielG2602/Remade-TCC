<?php

declare(strict_types = 1);

namespace App\Models;

class RestauranteModel extends Model {
    protected string $table = 'restaurante';

    public function create (array $data) : bool {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (nome, contato, telefone) VALUES (:nome, :contato, :telefone)
        ");

        return $stmt->execute([
            ':nome'     =>  $data['nome'],
            ':contato'  =>  $data['contato'] ?? null,
            ':telefone' =>  $data['telefone'] ?? null,
        ]);
    }

    public function update (int $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET nome = :nome, contato = :contato, telefone = :telefone, ativo = :ativo WHERE id = :id
        ");

        return $stmt->execute([
            ':nome'     => $data['nome'],
            ':contato'  => $data['contato'] ?? null,
            ':telefone' => $data['telefone'] ?? null,
            ':ativo'    => $data['ativo'] ?? 1,
            ':id'       => $id,
        ]);
    }
}