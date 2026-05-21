<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\IngredienteModel;

class IngredienteController extends Controller {
    private IngredienteModel $model;

    public function __construct()
    {
        $this->model = new IngredienteModel();
    }

    public function index () : void {
        AuthMiddleware::handle();

        $ingredientes = $this->model->all();

        $this->view('ingredientes/index', ['ingredientes' => $ingredientes]);
    }

    public function create () : void {
        AuthMiddleware::handle();

        $this->view('ingredientes/form');

    }

    public function store () : void {
        AuthMiddleware::handle();
        
        $data = [
            'nome'      => trim($this->input('nome', '')),
            'descricao' => trim($this->input('descricao', '')),
        ];

        if(empty($data['nome'])){
            $this->view('ingredientes/form', ['erro' => 'O nome e obrigatorio', 'data' => $data]);
            return;
        }

        try{
            $this->model->create($data);
        }catch(\RuntimeException $e){

            $erro = str_contains($e->getMessage(), '1062') ? 'ja existe uma ingrediente com esse nome' : 'Erro ao salvar, tente novamente';

            $this->view('ingredientes/form', ['erro' => $erro, 'data' => $data]);
            return;

        }

        $this->redirect('/ingredientes');
    }

    public function edit(string $id) : void {
        AuthMiddleware::handle();

        $ingrediente = $this->model->find((int)$id);

        if(!$ingrediente){
            $this->redirect('/ingredientes');
        }

        $this->view('ingredientes/form', ['ingrediente' => $ingrediente]);
    }

    public function update (string $id) : void {
        AuthMiddleware::handle();

        $data = [
            'nome'      => trim($this->input('nome', '')),
            'descricao' => trim($this->input('descricao', '')),
        ];

        if(empty($data['nome'])){
            $ingrediente = $this->model->find((int)$id);
            $this->view('ingredientes/form', ['erro' => 'o nome e obrigatorio', 'ingrediente' => $ingrediente]);
            return;
        }

        try{
            $this->model->update((int) $id, $data);
        }catch(\RuntimeException $e){
            $erro = str_contains($e->getMessage(), '1062') ? 'ja existe uma ingrediente com esse nome' : 'Erro ao salvar, tente novamente';

            $ingrediente = $this->model->find((int) $id);
            $this->view('categorias/form', ['erro' => $erro, 'ingrediente' => $ingrediente]);
            return;
        }

        $this->redirect('/ingredientes');
    }

    public function destroy (string $id) : void {
        AuthMiddleware::handle();
        $this->model->delete((int) $id);
        $this->redirect('/ingredientes');
    }
}