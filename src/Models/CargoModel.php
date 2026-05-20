<?php

declare(strict_types = 1);

namespace App\Models;

class CargoModel extends Model{

    protected string $table = 'cargo';

    public function allAtivos () : array {

         $stmt = $this->db->query("SELECT * FROM {$this->table} WHERE ativo = 1 ORDER BY nome");
        return $stmt->fetchAll();

    }

    public function create (array $data) : bool {

        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (nome, descricao) VALUES (:nome, :descricao)
        ");

        return  $stmt->execute([
            ':nome' => $data['nome'],
            ':descricao' => $data['descricao'] ?? null,
        ]);

    }

    public function update (int $id, array $data) : bool {

        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET nome = :nome, descricao = :descricao, ativo = :ativo WHERE id = :id
        ");

        return $stmt->execute([
            ':nome' => $data['nome'],
            ':descricao' => $data['descricao'] ?? null,
            ':ativo' => $data['ativo'] ?? 1,
            ':id' => $id,
        ]);
    }

}