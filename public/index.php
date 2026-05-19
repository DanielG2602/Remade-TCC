<?php

declare(strict_types=1);
 
define('BASE_PATH', dirname(__DIR__));
 
require BASE_PATH . '/src/Config/bootstrap.php';
 
use App\Core\Router;
 
$router = new Router();
 
require BASE_PATH . '/src/routes.php';
 
$method = $_SERVER['REQUEST_METHOD'];
$uri    = $_SERVER['REQUEST_URI'];
 
$router->dispatch($method, $uri);