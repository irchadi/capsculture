<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

use App\Controllers\AuthController;

$auth = new AuthController($pdo);
$action = $_GET['action'] ?? 'loginForm'; // ← Changer la valeur par défaut ici

switch ($action) {
    case 'loginForm':
        include 'app/views/login.php';
        break;

    case 'login':
        $auth->login();
        break;

    case 'register':
        $auth->register();
        break;

    case 'logout':
        $auth->logout();
        break;

    default:
        include 'app/views/login.php';
        break;
}


