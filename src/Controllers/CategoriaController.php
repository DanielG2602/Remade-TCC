<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\CargoModel;
use PDOException;

class CategoriaController extends Controller{
    private CargoModel $model;

    public function __construct()
    {
        $this->model = new CargoModel();
    }

    public function index () : void {
        AuthMiddleware::handle();

        $categorias = $this->model->all();

        $this->view('categorias/index', ['categorias' => $categorias]);
    }

    public function create () : void {
        AuthMiddleware::handle();

        $this->view('categorias/form');
    }

    public function store () : void {
        AuthMiddleware::handle();

        $data = ['nome' => trim($this->input('nome', ''))];

        if(empty($data['nome'])){
            $this->view('categorias/form', ['erro' => 'o nome e obrigatorio', 'data' => $data]);
            return;
        }

        try{
            $this->model->create($data);
        }catch(\PDOException $e){

            $erro = str_contains($e->getMessage(), '1062') ? 'ja existe uma categoria com esse nome' : 'Erro ao salvar, tente novamente';

            $this->view('categorias/form', ['erro' => $erro, 'data' => $data]);
            return;

        }


        $this->redirect('/categorias');
    }

    public function edit (string $id) : void{

        AuthMiddleware::handle();

        $categoria = $this->model->find((int)$id);

        if(!$categoria){
            $this->redirect('/categorias');
        }

        $this->view('categorias/form', ['categoria' => $categoria]);

    }

    public function update(string $id) : void {
        AuthMiddleware::handle();

        $data = ['nome' => trim($this->input('nome', ''))];

        if(empty($data['nome'])){
            $categoria = $this->model->find((int) $id);
            $this->view('categorias/form', ['erro' => 'O nome e obrigatorio', 'categoria' => $categoria]);
            return;
        }

        try{
            $this->model->update((int) $id, $data);
        }catch(\RuntimeException $e){


            $erro = str_contains($e->getMessage(), '1062') ? 'ja existe uma categoria com esse nome' : 'Erro ao salvar, tente novamente';

            $categoria = $this->model->find((int) $id);
            $this->view('categorias/form', ['erro' => $erro, 'categoria' => $categoria]);
            return;
        }

        $this->redirect('/categorias');
    }

    public function destroy (string $id) : void {
        AuthMiddleware::handle();

        $this->model->delete((int) $id);
        $this->redirect('/categorias');
    }
}