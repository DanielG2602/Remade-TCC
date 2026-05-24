<?php

declare(strict_types=1);

namespace App\Models;

class DegustacaoModel extends Model {
    protected string $table = 'degustacao';

    public function allCompleto() : array {
        $stmt = $this->db->query("
            SELECT d.*,
                   r.nome AS nome_receita,
                   f.nome AS nome_degustador
            FROM degustacao d
            JOIN receita r ON r.id = d.receita_id
            JOIN funcionario f ON f.id = d.degustador_id
            ORDER BY d.data DESC
        ");

        return $stmt->fetchAll();
    }
    
    public function create (array $data) : bool {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (nota, data, receita_id, degustador_id) VALUES (:nota, :data, :receita_id, :degustador_id)
        ");

        return $stmt->execute([
            ':nota'             => $data['nota'],
            ':data'             => $data['data'],
            ':receita_id'       => $data['receita_id'],
            ':degustador_id'    => $data['degustador_id'],
        ]);
    }

    public function update (int $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
            SET nota = :nota, data = :data, receita_id = :receita_id, degustador_id = :degustador_id
            WHERE id = :id
        ");

        return $stmt->execute([
            ':nota'             => $data['nota'],
            ':data'             => $data['data'],
            ':receita_id'       => $data['receita_id'],
            ':degustador_id'    => $data['degustador_id'],
            ':id'                => $id,
        ]);
    }
}