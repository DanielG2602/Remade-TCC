<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\CargoModel;

class CargoController extends Controller
{
    private CargoModel $model;

    public function __construct()
    {
        $this->model = new CargoModel();
    }

    public function index(): void
    {
        AuthMiddleware::handle();

        $cargos = $this->model->all();

        $this->view('cargos/index', ['cargos' => $cargos]);
    }

    public function create(): void
    {
        AuthMiddleware::admin();

        $this->view('cargos/form');
    }

    public function store(): void
    {
        AuthMiddleware::admin();

        $data = [
            'nome'      => trim($this->input('nome', '')),
            'descricao' => trim($this->input('descricao', '')),
        ];

        if (empty($data['nome'])) {
            $this->view('cargos/form', ['erro' => 'O nome é obrigatório.', 'data' => $data]);
            return;
        }

        $this->model->create($data);
        $this->redirect('/cargos');
    }

    public function edit(string $id): void
    {
        AuthMiddleware::admin();

        $cargo = $this->model->find((int) $id);

        if (!$cargo) {
            $this->redirect('/cargos');
        }

        $this->view('cargos/form', ['cargo' => $cargo]);
    }

    public function update(string $id): void
    {
        AuthMiddleware::admin();

        $data = [
            'nome'      => trim($this->input('nome', '')),
            'descricao' => trim($this->input('descricao', '')),
            'ativo'     => $this->input('ativo', 1),
        ];

        if (empty($data['nome'])) {
            $cargo = $this->model->find((int) $id);
            $this->view('cargos/form', ['erro' => 'O nome é obrigatório.', 'cargo' => $cargo]);
            return;
        }

        $this->model->update((int) $id, $data);
        $this->redirect('/cargos');
    }

    public function destroy(string $id): void
    {
        AuthMiddleware::admin();

        $this->model->delete((int) $id);
        $this->redirect('/cargos');
    }
}