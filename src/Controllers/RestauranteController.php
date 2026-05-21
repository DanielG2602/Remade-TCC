<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\RestauranteModel;

class RestauranteController extends Controller {
    private RestauranteModel $model;

    public function __construct()
    {
        $this->model = new RestauranteModel();
    }

    public function index () : void {
        AuthMiddleware::handle();

        $restaurantes = $this->model->all();

        $this->view('restaurantes/index', ['restaurantes' => $restaurantes]);
    }

    public function create() : void {
        AuthMiddleware::handle();

        $this->view('restaurantes/form');
    }

    public function store () : void {
        AuthMiddleware::handle();

        $data = [
            'nome'      => trim($this->input('nome', '')),
            'contato'   => trim($this->input('contato', '')),
            'telefone'  => trim($this->input('telefone', ''))
        ];

        if(empty($data)){
            $this->view('restaurantes/form', ['erro' => 'o nome e obrigatorio', 'data' => $data]);
        }

        $this->model->create($data);
        $this->redirect('/restaurantes');
    }

    public function edit (string $id) : void {
        AuthMiddleware::handle();

        $restaurante = $this->model->find((int) $id);

        if(!$restaurante){
            $this->redirect('/restaurante');
        }

        $this->view('restaurantes/form', ['restaurante' => $restaurante]);
    }

    public function update (string $id) {
        AuthMiddleware::handle();

        $data = [
            'nome'      => trim($this->input('nome', '')),
            'contato'   => trim($this->input('contato', '')),
            'telefone'  => trim($this->input('contato', '')),
        ];

        if(empty($data)){
            $restaurante = $this->model->find((int) $id);
            $this->view('restaurantes/form', ['erro' => 'o nome e obrigatorio', 'restaurantes' => $restaurante]);
            return;
        }

        $this->model->update((int)$id, $data);
        $this->redirect('/restaurantes');

    }

    public function destroy (string $id) : void {
        AuthMiddleware::handle();

        $this->model->delete((int) $id);
        $this->redirect('/restaurantes');
    }
}