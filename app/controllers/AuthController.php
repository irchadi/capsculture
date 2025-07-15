<?php

namespace App\Controllers;

use PDO;

class AuthController {
    private PDO $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    public function login() {
        $id = $_POST['identifier'] ?? '';
        $pass = $_POST['password'] ?? '';

        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$id, $id]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password_hash'])) {
            $_SESSION['user'] = [
                'id'       => $user['id'],
                'username' => $user['username'],
                'role'     => $user['role']
            ];

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: /index.php?action=dashboard");
            } else {
                header("Location: /index.php?action=dashboard");
            }
            exit;
        } else {
            $_SESSION['error'] = "Identifiants incorrects.";
            header("Location: /index.php?action=loginForm");
            exit;
        }
    }

    public function register() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $pass = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($pass !== $confirm) {
            $_SESSION['error'] = "Les mots de passe ne correspondent pas.";
            header("Location: /index.php?action=registerForm");
            exit;
        }

        // Vérifier si username ou email existe déjà
        $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $_SESSION['error'] = "Nom d'utilisateur ou email déjà utilisé.";
            header("Location: /index.php?action=registerForm");
            exit;
        }

        // Insérer dans la BDD
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hash]);

        $_SESSION['message'] = "Inscription réussie. Connectez-vous.";
        header("Location: /index.php?action=loginForm");
        exit;
    }

    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            header("Location: /index.php?action=loginForm");
            exit;
        }

        $role = $_SESSION['user']['role'];

        if ($role === 'admin') {
            include __DIR__ . '/../views/admin_dashboard.php';
        } else {
            include __DIR__ . '/../views/user_dashboard.php';
        }
    }

    public function logout() {
        session_destroy();
        header("Location: /index.php?action=home");
        exit;
    }
}

