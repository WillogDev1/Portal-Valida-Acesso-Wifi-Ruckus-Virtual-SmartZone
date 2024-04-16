<?php
require __DIR__ . '/vendor/autoload.php';


use App\Controllers\Controllers;

// Configuração do ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Obter o caminho da URI e ignorar os parâmetros de query
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Verifica a rota
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/') {
    $controller = new Controllers();
    $controller->home();
}
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/home') {
    $controller = new Controllers();
    $controller->home();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/visitante') {
    $controller = new Controllers();
    $controller->visiatnte();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/alunos') {
    $controller = new Controllers();
    $controller->alunos();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/colaborador') {
    $controller = new Controllers();
    $controller->colaborador();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/sendsms') {
    $controller = new Controllers();
    $controller->sendSms();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/validara') {
    $controller = new Controllers();
    $controller->validaRA();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/validatoken') {
    $controller = new Controllers();
    $controller->validaToken();
} 
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/validaCracha') {
    $controller = new Controllers();
    $controller->validaCracha();
} 
 

else {
    // Página não encontrada
    http_response_code(404);
    echo 'Página não encontrada';
}
