<?php

declare(strict_types=1);

namespace App\Models;

class FuncionarioModel extends Model{
    protected string $table = 'funcionario';

    public function allComCargo () : array {
        $stmt = $this->db->query("
            SELECT f.*, c.nome AS nome_cargo FROM funcionario f LEFT JOIN cargo c ON c.id = f.cargo_id ORDER BY f.nome
        ");

        return $stmt->fetchAll();
    }

    public function findByEmail(string $email) : array|false{
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function create (array $data) : bool {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (nome, nome_fantasia, rg, email, senha, salario, dt_admissao, role, cargo_id) VALUES (:nome, :nome_fantasia, :rg, :email, :senha, :salario, :dt_admissao, :role, :cargo_id)");

        return $stmt->execute([
            ':nome'          => $data['nome'],
            ':nome_fantasia' => $data['nome_fantasia'] ?? null,
            ':rg'            => $data['rg'] ?? null,
            ':email'         => $data['email'],
            ':senha'         => password_hash($data['senha'], PASSWORD_BCRYPT),
            ':salario'       => $data['salario'] ?? null,
            ':dt_admissao'   => $data['dt_admissao'] ?? null,
            ':role'          => $data['role'] ?? 'funcionario',
            ':cargo_id'      => $data['cargo_id'] ?? null,
        ]);
    }

    public function update (int $id, array $data) : bool {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} SET
                nome          = :nome,
                nome_fantasia = :nome_fantasia,
                rg            = :rg,
                email         = :email,
                salario       = :salario,
                dt_admissao   = :dt_admissao,
                cargo_id      = :cargo_id,
                ativo         = :ativo,
                atualizado_em = NOW()
            WHERE id = :id
        ");

        return $stmt->execute([
            ':nome'          => $data['nome'],
            ':nome_fantasia' => $data['nome_fantasia'] ?? null,
            ':rg'            => $data['rg'] ?? null,
            ':email'         => $data['email'],
            ':salario'       => $data['salario'] ?? null,
            ':dt_admissao'   => $data['dt_admissao'] ?? null,
            ':cargo_id'      => $data['cargo_id'] ?? null,
            ':ativo'         => $data['ativo'] ?? 1,
            ':id'            => $id,
        ]);
    }
}