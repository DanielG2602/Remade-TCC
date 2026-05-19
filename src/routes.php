<?php
 
declare(strict_types=1);
 
use App\Controllers\AuthController;
use App\Controllers\FuncionarioController;
use App\Controllers\CargoController;
use App\Controllers\ReceitaController;
use App\Controllers\IngredienteController;
use App\Controllers\CategoriaController;
use App\Controllers\LivroController;
use App\Controllers\RestauranteController;
use App\Controllers\DegustacaoController;
 
// Authenticacao
$router->get('/login',  [AuthController::class, 'index']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);
 
// Dashboard
$router->get('/', [AuthController::class, 'dashboard']);
 
// Funcionarios
$router->get('/funcionarios',           [FuncionarioController::class, 'index']);
$router->get('/funcionarios/novo',      [FuncionarioController::class, 'create']);
$router->post('/funcionarios',          [FuncionarioController::class, 'store']);
$router->get('/funcionarios/{id}',      [FuncionarioController::class, 'show']);
$router->get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit']);
$router->post('/funcionarios/{id}',     [FuncionarioController::class, 'update']);
$router->post('/funcionarios/{id}/delete', [FuncionarioController::class, 'destroy']);
 
// Cargos
$router->get('/cargos',               [CargoController::class, 'index']);
$router->get('/cargos/novo',          [CargoController::class, 'create']);
$router->post('/cargos',              [CargoController::class, 'store']);
$router->get('/cargos/{id}/edit',     [CargoController::class, 'edit']);
$router->post('/cargos/{id}',         [CargoController::class, 'update']);
$router->post('/cargos/{id}/delete',  [CargoController::class, 'destroy']);
 
// Receitas
$router->get('/receitas',                [ReceitaController::class, 'index']);
$router->get('/receitas/nova',           [ReceitaController::class, 'create']);
$router->post('/receitas',               [ReceitaController::class, 'store']);
$router->get('/receitas/{id}',           [ReceitaController::class, 'show']);
$router->get('/receitas/{id}/edit',      [ReceitaController::class, 'edit']);
$router->post('/receitas/{id}',          [ReceitaController::class, 'update']);
$router->post('/receitas/{id}/delete',   [ReceitaController::class, 'destroy']);
 
// Ingredientes
$router->get('/ingredientes',              [IngredienteController::class, 'index']);
$router->get('/ingredientes/novo',         [IngredienteController::class, 'create']);
$router->post('/ingredientes',             [IngredienteController::class, 'store']);
$router->get('/ingredientes/{id}/edit',    [IngredienteController::class, 'edit']);
$router->post('/ingredientes/{id}',        [IngredienteController::class, 'update']);
$router->post('/ingredientes/{id}/delete', [IngredienteController::class, 'destroy']);
 
// Categorias
$router->get('/categorias',               [CategoriaController::class, 'index']);
$router->get('/categorias/novo',          [CategoriaController::class, 'create']);
$router->post('/categorias',              [CategoriaController::class, 'store']);
$router->get('/categorias/{id}/edit',     [CategoriaController::class, 'edit']);
$router->post('/categorias/{id}',         [CategoriaController::class, 'update']);
$router->post('/categorias/{id}/delete',  [CategoriaController::class, 'destroy']);
 
// Livros
$router->get('/livros',               [LivroController::class, 'index']);
$router->get('/livros/novo',          [LivroController::class, 'create']);
$router->post('/livros',              [LivroController::class, 'store']);
$router->get('/livros/{id}',          [LivroController::class, 'show']);
$router->get('/livros/{id}/edit',     [LivroController::class, 'edit']);
$router->post('/livros/{id}',         [LivroController::class, 'update']);
$router->post('/livros/{id}/delete',  [LivroController::class, 'destroy']);
 
// Restaurantes
$router->get('/restaurantes',               [RestauranteController::class, 'index']);
$router->get('/restaurantes/novo',          [RestauranteController::class, 'create']);
$router->post('/restaurantes',              [RestauranteController::class, 'store']);
$router->get('/restaurantes/{id}/edit',     [RestauranteController::class, 'edit']);
$router->post('/restaurantes/{id}',         [RestauranteController::class, 'update']);
$router->post('/restaurantes/{id}/delete',  [RestauranteController::class, 'destroy']);
 
// Degustações
$router->get('/degustacoes',              [DegustacaoController::class, 'index']);
$router->get('/degustacoes/nova',         [DegustacaoController::class, 'create']);
$router->post('/degustacoes',             [DegustacaoController::class, 'store']);
$router->get('/degustacoes/{id}/edit',    [DegustacaoController::class, 'edit']);
$router->post('/degustacoes/{id}',        [DegustacaoController::class, 'update']);
$router->post('/degustacoes/{id}/delete', [DegustacaoController::class, 'destroy']);