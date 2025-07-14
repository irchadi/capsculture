<?php
require_once 'app/controllers/AuthController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$auth = new AuthController();

switch ($uri) {
    case '/login':
        $_SERVER['REQUEST_METHOD'] === 'POST' ? $auth->login() : $auth->showLogin();
        break;
    case '/register':
        $_SERVER['REQUEST_METHOD'] === 'POST' ? $auth->register() : $auth->showRegister();
        break;
    case '/logout':
        $auth->logout();
        break;
    default:
        echo "<h1>Accueil Capsculture</h1>";
        echo "<p><a href='/login'>Connexion</a> | <a href='/register'>Inscription</a></p>";
}
