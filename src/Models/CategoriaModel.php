<?php

declare(strict_types = 1);

namespace App\Models;

class CategoriaModel extends Model {
    protected string $table = 'categoria';

    public function create (array $data):bool{

        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (nome) VALUES (:nome)
        ");

        return $stmt->execute([':nome'=> $data['nome']]);

    }

    public function update (string $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET nome = :nome WHERE id = :id
        ");

        return $stmt->execute([':nome' =>  $data['nome'], ':id' => $id]);
    }

}