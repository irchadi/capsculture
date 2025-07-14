<?php

use App\Controllers\AuthController;
use Core\Database;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';

$pdo = $pdo ?? null; // récupération via config.php
$auth = new AuthController($pdo);

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $auth->login();
        break;
    case 'dashboard':
        $auth->dashboard();
        break;
    case 'logout':
        $auth->logout();
        break;
    default:
        include 'app/views/login.php';
        break;
}
