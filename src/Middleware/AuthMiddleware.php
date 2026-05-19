<?php

declare(strict_types = 1);

namespace App\Middleware;

class AuthMiddleware {
    public static function handle() : void{
        if (!isset($_SESSION['usuario'])){
            header('Location: /login');
            exit;
        }
    }

    public static function admin() : void{
        self::handle();

        if($_SESSION['usuario']['role'] !== 'admin'){
            http_response_code(403);
            echo'403 - Acesso Negado';
            exit;
        }

    }
}