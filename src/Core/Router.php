<?php 
declare(strict_types=1);

namespace App\Core;

Class Router{

    private array $routes = []; 

    public function get(string $url, array $action) : void{
        $this->register('GET', $url, $action);
    }

    public function post(string $url, array $action) : void{
        $this->register('POST', $url, $action);
    }

    public function put(string $url, array $action) : void{
        $this->register('PUT', $url, $action);
    }

    public function delete(string $url, array $action) : void{
        $this->register('DELETE', $url, $action);
    }

    public function register(string $method, string $url, array $action) : void{
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'action' => $action
        ];
    }

    public function dispatch (string $method, string $url) : void { 

        $url = $this->sanitizeUri($url);
 
        foreach ($this->routes as $route) {
            if ($route['method'] !== strtoupper($method)) {
                continue;
            }
 
            $pattern = $this->uriToPattern($route['url']);
 
            if (preg_match($pattern, $url, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->call($route['action'], array_values($params));
                return;
            }
        }
 
        $this->abort(404);

    }

    public function call(array $action, array $params) : void {
        [$class, $method] = $action;

        if(!class_exists($class)) {
            throw new \RuntimeException("Controller {$class} nao encontrada");
        }

        $controller = new $class();
        
        if (!method_exists($controller, $method)){
            throw new \RuntimeException("Methodo {$method} nao foi encontrado em {$class}");
        }

        $controller->$method(...$params);

    }

    public function uriToPattern (string $url) : string {
        $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $url);
        return '#^' . $pattern . '$#';
    }

    public function sanitizeUri(string $url) : string{
        $url = parse_url($url, PHP_URL_PATH) ?? '/';
        return '/' . trim($url, '/') ?: '/';
    }

    private function abort (int $code) : void{
        http_response_code($code);

        match($code){
            404 => print '404 - Página não encontrada',
            405 => print '405 - Método não permitido',
            500 => print '500 - Erro interno',
            default => print "Erro {$code}",
        };

        exit;
    }
}