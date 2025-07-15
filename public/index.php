<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use App\Controllers\AuthController;

$auth = new AuthController($pdo);
$action = $_GET['action'] ?? 'home';

// Router
switch ($action) {
    case 'home':
        include __DIR__ . '/../app/views/home.php';
        break;

    case 'loginForm':
        include __DIR__ . '/../app/views/login.php';
        break;

    case 'registerForm':
        include __DIR__ . '/../app/views/register.php';
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

    case 'dashboard':
        $auth->dashboard();
        break;

    default:
        http_response_code(404);
        echo "<h2>404 - Page non trouvée</h2>";
        break;
}
