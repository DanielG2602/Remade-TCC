<?php
 
declare(strict_types=1);
 
namespace App\Controllers;
 
abstract class Controller {
    protected function view (string $view, array $data = []) : void {
        
        $viewPath = BASE_PATH . '/src/Views/' . $view . '.php';

        if(!file_exists($viewPath)){
            throw new \RuntimeException("view {$view} nao encontrada");
        }

        extract($data);

        require $viewPath;
    }

    protected function redirect(string $url) : void{
        header("Location: {$url} ");
        exit;
    }

    protected function json(mixed $data, int $status = 200) : void{
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_decode($data);
        exit;
    }

    protected function input (string $key, mixed $default = null) : mixed {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }

    protected function isPost() : bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}