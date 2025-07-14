<?php
require_once __DIR__ . '/../models/User.php';
session_start();

class AuthController {
    public function showLogin() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function showRegister() {
        require_once __DIR__ . '/../views/auth/register.php';
    }

    public function login() {
        $user = User::findByUsername($_POST['username']);
        if ($user && password_verify($_POST['password'], $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /'); exit;
        } else {
            echo "Mauvais identifiants.";
        }
    }

    public function register() {
        if (User::create($_POST['username'], $_POST['email'], $_POST['password'])) {
            header('Location: /login'); exit;
        } else {
            echo "Erreur d'inscription.";
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /'); exit;
    }
}