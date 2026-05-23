<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Models\FuncionarioModel;

class AuthController extends Controller {

    public function index() : void {

        if(isset($_SESSION['usuario'])){
            $this->redirect('/');
        }

        $this->view('auth/login');

    }

    public function login() : void {

        $email = $this->input('email', '');
        $senha = $this->input('senha', '');

        $model = new FuncionarioModel();
        $usuario = $model->findByEmail($email);

        if(!$usuario || !password_verify($senha, $usuario['senha'])){
            $this->view('auth/login', ['erro' => 'Email ou senha invalidos']);
            return;
        }

        if(!$usuario['ativo']){
            $this->view('auth/login', ['erro' => 'Usuario inativo']);
            return;
        }

        session_regenerate_id(true);

        $_SESSION['usuario'] = [
            'id'    => $usuario['id'],
            'nome'  => $usuario['nome'],
            'role'  => $usuario['role'],
        ];

        $this->redirect('/');

    }

    public function logout() : void {

        session_destroy();
        $this->redirect('/login');

    }

    public function dashboard() : void {

        AuthMiddleware::handle();

        $this->view('dashboard');

    }

}