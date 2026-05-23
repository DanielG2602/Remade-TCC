<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\CategoriaModel;
use App\Models\FuncionarioModel;
use App\Models\IngredienteModel;
use App\Models\MedidaModel;
use App\Models\ReceitaModel;

class ReceitaController extends Controller{
    private ReceitaModel $model;
    private CategoriaModel $categoriaModel;
    private IngredienteModel $ingredienteModel;
    private FuncionarioModel $funcionarioModel;
    private MedidaModel $medidaModel;

    public function __construct()
    {
        $this->model            = new ReceitaModel();
        $this->categoriaModel   = new CategoriaModel();
        $this->ingredienteModel = new IngredienteModel();
        $this->funcionarioModel = new FuncionarioModel();
        $this->medidaModel      = new MedidaModel();
    }

    public function index () : void {
        AuthMiddleware::handle();

        $receitas = $this->model->allCompleto();

        $this->view('receitas/index', ['receitas' => $receitas]);
    }

    public function show(string $id) : void {
        AuthMiddleware::handle();

        $receita        = $this->model->findCompleto((int) $id);
        $ingredientes   = $this->model->findIngredientes((int) $id);

        if(!$receita) {
            $this->redirect('receitas');
        }

        $this->view('receitas/show', [
            'receita'       => $receita,
            'ingredientes'  => $ingredientes
        ]);
    }

    public function create () : void {
        AuthMiddleware::handle();

        $this->view('receitas/form', $this->formData());
    }

    public function store() : void {
        AuthMiddleware::handle();

        $data = $this->collectFormData();
        $erro = $this->validar($data);

        if($erro){
            $this->view('receitas/form', array_merge($this->formData(), ['erro' => $erro, 'data' => $data]));
            return;
        }

        $this->db()->beginTransaction();

        try{
            $receitaId = $this->model->create($data);

            if(empty($_FILES['foto']['tmp_name'])){
                $foto = $this->salvarFoto($_FILES['foto'], $receitaId);
                $this->model->updateFoto($receitaId, $foto);
            }

            $this->model->syncIngredientes($receitaId, $this->collectIngredientes());

            $this->db()->commit();
        }catch(\Throwable $e){
            $this->db()->rollBack();
            $this->view('receitas/form', array_merge($this->formData(), [
                'erro' => 'Erro ao salvar receita. Tente novamente',
                'data' => $data,
            ]));

            return;
        }
    }

    public function edit (string $id) : void {
        AuthMiddleware::handle();

        $receita        = $this->model->find((int) $id);
        $ingredientes   = $this->model->findIngredientes((int) $id);

        if(!$receita) {
            $this->redirect('/receitas');
        }

        $this->view('receitas/form', array_merge($this->formData(), [
            'receita'       => $receita,
            'ingredientes'  => $ingredientes,
        ]));
    }

    public function update (string $id) : void {
        AuthMiddleware::handle();

        $data = $this->collectFormData();
        $erro = $this->validar($data);

        if($erro){
            $receita        = $this->model->find((int) $id);
            $ingredientes   = $this->model->findIngredientes((int) $id);
            $this->view('receita/form', array_merge($this->formData(),[ 
                'erro' => $erro,
                'receita' => $receita,
                'ingredientes' => $ingredientes, 
            ]));

            return;
        }

        $this->db()->beginTransaction();

        try{
            $this->model->update((int) $id, $data);

            if(empty($_FILES['foto']['tmp_name'])){
                $foto = $this->salvarFoto($_FILES['foto'], (int) $id);
                $this->model->updateFoto((int) $id, $foto);
            }

            $this->model->syncIngredientes((int) $id, $this->collectIngredientes());

            $this->db()->commit();
        }catch(\Throwable $e){
            $this->db()->rollBack();
            $receita        = $this->model->find((int) $id);
            $ingredientes   = $this->model->findIngredientes((int) $id);
            $this->view('receitas/form', array_merge($this->formData(), [
                'erro'          => 'Erro ao salvar receita. Tente novamente.',
                'receita'       => $receita,
                'ingredientes'  => $ingredientes,
            ]));

            return;
        }
    }

    public function destroy (string $id) : void{
        AuthMiddleware::handle();

        $this->model->delete((int) $id);
        $this->redirect('/receitas');
    }

    private function formData() : array {
        return [
            'categoria'             => $this->categoriaModel->all(),
            'ingredientes_lista'    => $this->ingredienteModel->all(),
            'funcionarios'          => $this->funcionarioModel->allComCargo(),
            'medida'                => $this->medidaModel->all(),
        ];
    }

    private function collectFormData () : array {
        return [
            'nome'              => trim($this->input('nome', '')),
            'preparo'           => trim($this->input('preparo', '')),
            'quantidade_porcao' => $this->input('quantidade_porcao'),
            'inedita'           => $this->input('inedita', 0),
            'dt_criacao'        => $this->input('dt_criacao', date('Y-m-d')),
            'categoria_id'      => $this->input('categoria_id'),
            'cozinheiro_id'     => $this->input('cozinheiro_id'),
        ];
    }

    private function collectIngredientes () : array {
        $ids = $_POST['ingredientes_id'] ?? [];
        $quantidade = $_POST['quantidade'];
        $medidas = $_POST['medida_id'];

        $result = [];

        foreach($ids as $i => $ingId) {
            if(empty($ingId)) continue;
            $result[] = [
                'ingredientes_id' => $ingId,
                'quantidade' => $quantidade[$i] ?? 0,
                'medida_id' => $medidas[$i] ?? null,
            ];
        }

        return $result;
    }

    private function validar (array $data) : ?string {
        if(empty($data['nome'])) return 'O nome e obrigatorio.';
        if(empty($data['preparo'])) return 'o modo de preparo e obrigatorio.';
        if(empty($data['cozinheiro_id'])) return 'O cozinehiro e obrigatorio.';
        if(empty($data['dt_criacao'])) return 'A data de criacao e obrigatorio';
        return null;
    }

    private function salvarFoto(array $file, int $receitaId) : ?string {
        $ext = pathinfo($file['nome'], PATHINFO_EXTENSION);
        $nome = "receita_{$receitaId}_" . time() . ".{$ext}";
        $dest = '/var/www/storage/uploads/' . $nome;

        move_uploaded_file($file['tmp_name'], $dest);

        return '/storage/uploads/' . $nome;
    }

    private function db () : \PDO {
        return \App\Config\DataBase::connection();
    }


}