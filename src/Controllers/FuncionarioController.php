<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\CargoModel;
use App\Models\FuncionarioModel;

class FuncionarioController extends Controller {
    private FuncionarioModel $model;
    private CargoModel $cargoModel;

    public function __construct()
    {
        $this->model = new FuncionarioModel();
        $this->cargoModel = new CargoModel();
    }

    public function index() : void {
        AuthMiddleware::handle();

        $funcionarios = $this->model->allComCargo();

        $this->view('funcionarios/index', ['funcionarios' => $funcionarios]);
    }

    public function create() : void {

        AuthMiddleware::handle();

        $cargos = $this->cargoModel->allAtivos();

        $this->view('funcionarios/form', ['cargos' => $cargos]);

    }

    public function store () : void {
        AuthMiddleware::handle();

        $cargos = $this->cargoModel->allAtivos();

        $data= [
            'nome'          => trim($this->input('nome', '')),
            'nome_fantasia' => trim($this->input('nome_fantasia', '')),
            'rg'            => trim($this->input('rg', '')),
            'email'         => trim($this->input('email', '')),
            'senha'         => $this->input('senha',''),
            'salario'       => $this->input('salario',''),
            'dt_admissao'   => $this->input('dt_admissao',''),
            'role'          => $this->input('role',''),
            'cargo_id'      => $this->input('cargo_id',''),
        ];

        $erro = $this->validar($data);

        if($erro){
            $this->view('funcionarios/form', ['erro' => $erro, 'data' => $data, 'cargos' => $cargos]);
            return;
        }

        $this->model->create($data);
        $this->redirect('/funcionarios');

    }

    public function edit (string $id) : void {
        AuthMiddleware::handle();

        $funcionario = $this->model->find((int)$id);

        if(!$funcionario){
            $this->redirect('/funcionarios');
        }

        $cargos = $this->cargoModel->allAtivos();

        $this->view('funcionarios/form', ['funcionario' => $funcionario, 'cargos' => $cargos]);
    }

    public function update (string $id) : void {
        AuthMiddleware::handle();

        $funcionarios = $this->model->find((int) $id);
        $cargos = $this->cargoModel->allAtivos();

        $data= [
            'nome'          => trim($this->input('nome', '')),
            'nome_fantasia' => trim($this->input('nome_fantasia', '')),
            'rg'            => trim($this->input('rg', '')),
            'email'         => trim($this->input('email', '')),
            'senha'         => $this->input('senha',''),
            'salario'       => $this->input('salario',''),
            'dt_admissao'   => $this->input('dt_admissao',''),
            'role'          => $this->input('role',''),
            'cargo_id'      => $this->input('cargo_id',''),
            'ativo'         =>$this->input('ativo', 1),
        ];

        if(empty($data)){
            $this->view('funcionarios/form', ['erro' => 'O nome e obrigatorio', 'funcionario' => array_merge($funcionarios, $data), 'cargos' => $cargos]);
            return;
        }

        $this->model->update((int) $id, $data);
        $this->redirect('/funcionarios');

    }

    public function destroy (string $id) : void {
        AuthMiddleware::handle();

        $this->model->delete((int) $id);
        $this->redirect('/funcionarios');

    }

    private function validar (array $data): ?string {
        if(empty($data['nome'])) return 'o nome e obrigatorio';
        if(empty($data['email'])) return 'o email e obrigatorio';
        if(empty($data['senha'])) return 'a senha e obrigatorio';

        return null;
    }
}