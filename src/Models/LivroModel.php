<?php

declare(strict_types=1);

namespace App\Models;

class LivroModel extends Model {
    protected string $table = 'livro';
    
    public function create(array $data) : bool {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (nome, editora, autor) VALUES (:nome, :editora, :autor)
        ");

        return $stmt->execute([
            ':nome' => $data['nome'],
            ':editora' => $data['editora'] ?? null,
            ':autor' => $data['autor'] ?? null,
        ]);
    }

    public function update (int $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET nome = :nome, editora = :editora, autor = :autor WHERE id = :id
        ");

        return $stmt->execute([
            ':nome' => $data['nome'],
            ':editora' => $data['editora'] ?? null,
            ':autor' => $data['autor'] ?? null,
            ':id' => $id,
        ]);
    }

    public function allComReceitas() : array {
        $stmt = $this->db->query("
            SELECT l.*, COUNT(lr.receita_id) AS total_receitas
            FROM livro l
            LEFT JOIN livro_receita lr ON lr.livro_id = l.id
            GROUP BY l.id
            ORDER BY l.nome
        ");

        return $stmt->fetchAll();
    }
}