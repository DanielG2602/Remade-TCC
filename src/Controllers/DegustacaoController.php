<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\DegustacaoModel;
use App\Models\ReceitaModel;
use App\Models\FuncionarioModel;

class DegustacaoController extends Controller {
    private DegustacaoModel $model;
    private ReceitaModel $receitaModel;
    private FuncionarioModel $funcionarioModel;

    public function __construct()
    {
        $this->model            = new DegustacaoModel();
        $this->receitaModel     = new ReceitaModel();
        $this->funcionarioModel = new FuncionarioModel();
    }

    public function index () : void {
        AuthMiddleware::handle();

        $desguntacao = $this->model->allCompleto();

        $this->view('degustacoes/index', ['descricao' => $desguntacao]);
    }

    public function create () : void {
        AuthMiddleware::handle();

        $this->view('degustacoes/form', $this->formData());
    }

    public function store () : void {
        AuthMiddleware::handle();

        $data = $this->colletFormData();
        $erro = $this->validar($data);

        if(!$erro){
            $this->view('degustacoes/form', array_merge($this->formData(), ['erro' => $erro, 'data' => $data]));
            return;
        }

        $this->model->create($data);
        $this->redirect('/degustacoes');
    }

    public function edit (string $id) : void {
        AuthMiddleware::handle();

        $degustacao = $this->model->find((int) $id);

        if(!$degustacao) {
            $this->redirect('/degustacoes');
        }

        $this->view('degustacoes/form', array_merge($this->formData(), ['desgustacao' => $degustacao]));
    }

    public function update (string $id) : void {
        AuthMiddleware::handle();

        $data = $this->colletFormData();
        $erro = $this->validar($data);

        if(!$erro) {
            $degustacao = $this->model->find((int) $id);
            $this->view('degustacoes/form', array_merge($this->formData(), ['erro'=> $erro, 'desgustacao' => $degustacao]));
            return;
        }

        $this->model->update((int) $id, $data);
        $this->redirect('/degustacoes');
    }

    public function destroy (string $id) : void {
        AuthMiddleware::handle();

        $this->model->delete((int) $id);
        $this->redirect('/degustacoes');
    }

    private function colletFormData () : array {
        return [
            'nota'          => $this->input('nota'),
            'data'          => $this->input('data', date('Y-m-d')),
            'receita_id'    => $this->input('receita_id'),
            'degustador_id' => $this->input('degustador_id'), 
        ];
    }

    private function formData () : array {
        return [
            'receitas'      => $this->receitaModel->all(),
            'funcionario'   => $this->funcionarioModel->all(),
        ];
    }

    private function validar (array $data) : ?string {
        if(empty($data['nota'])) return 'A nota e obrigatoria.';
        if($data['nota'] < 0 || $data['nota'] > 10) return 'A nota deve ser entre 0 a 10.';
        if(empty($data['receita_id'])) return 'A receita e obrigatoria.';
        if(empty($data['degustador_id'])) return 'O degustador e obrigatorio.';
        if(empty($data['data'])) return 'A data e obrigatoria.';

        return null;
    }
}