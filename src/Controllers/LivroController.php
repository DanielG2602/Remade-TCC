<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\LivroModel;

class LivroController extends Controller {
    protected LivroModel $model;

    public function __construct()
    {
        $this->model = new LivroModel();
    }

    public function index() : void{
        AuthMiddleware::handle();

        $livros = $this->model->allComReceitas();

        $this->view('livros/index', ['livros' => $livros]);
    }

    public function show (string $id) : void {
        AuthMiddleware::handle();

        $livro = $this->model->find((int) $id);

        if(!$livro) {
            $this->redirect('/livros');
        }

        $this->view('livros/show', ['livro' => $livro]);
    }

    public function create () : void {
        AuthMiddleware::handle();

        $this->view('livros/form');
    }

    public function store () : void {
        AuthMiddleware::handle();

        $data = [
            'nome' => trim($this->input('nome', '')),
            'editora' => trim($this->input('editora', '')),
            'autor' => trim($this->input('autor', '')),
        ];

        if(empty($data)){
            $this->view('livros/form', ['erro' => 'o nome e obrigatorio', 'data' => $data]);
        }

        $this->model->create($data);
        $this->redirect('/livros');

    }

    public function edit(string $id) : void {
        AuthMiddleware::handle();

        $livro = $this->model->find((int) $id);

        if(!$livro){
            $this->redirect('/livros');
        }

        $this->view('livros/form', ['livro' => $livro]);
    }

    public function update (string $id) : void {

        AuthMiddleware::handle();

        $data = [
            'nome' => trim($this->input('nome', '')),
            'editora' => trim($this->input('editora', '')),
            'autor' => trim($this->input('autor', '')),
        ];

        if(empty($data['nome'])){
            $livro = $this->model->find((int) $id);
            $this->view('livros/form', ['erro' => 'o nome e obrigatorio', 'livro' => $livro]);
        }

        $this->model->update((int)$id, $data);
        $this->redirect('/livros');

    }

    public function destroy (string $id) : void {
        AuthMiddleware::handle();

        $this->model->delete((int)$id);
        $this->redirect('/livros');
    }

}