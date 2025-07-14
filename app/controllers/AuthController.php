<?php

namespace App\Controllers;

use PDO;

class AuthController {
    private PDO $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
        session_start(); // Démarrer la session
    }

    public function login() {
        $id = $_POST['identifier'] ?? '';
        $pass = $_POST['password'] ?? '';

        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$id, $id]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password_hash'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            header("Location: /router.php?action=dashboard");
        } else {
            echo "Identifiants incorrects.";
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            header("Location: /app/views/login.php");
            exit;
        }

        $role = $_SESSION['user']['role'];
        echo "<h1>Bienvenue, " . htmlspecialchars($_SESSION['user']['username']) . "</h1>";

        if ($role === 'admin') {
            echo "<p>Vous êtes connecté en tant qu'administrateur.</p>";
            // Lien vers admin.php
        } else {
            echo "<p>Vous êtes connecté comme utilisateur standard.</p>";
            // Lien vers user.php
        }

        echo '<br><a href="/router.php?action=logout">Se déconnecter</a>';
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /app/views/login.php");
    }
}

