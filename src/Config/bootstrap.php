<?php

declare(strict_types=1);
 
require BASE_PATH . '/vendor/autoload.php';
 
$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();
 
date_default_timezone_set('America/Sao_Paulo');

session_start();