<?php

namespace App\Controllers;

use PDO;

class AuthController {
    private PDO $db;

    public function __construct(PDO $pdo) {
        $this->db = $pdo;
    }

    /**
     * Connexion utilisateur
     */
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

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: /admin_dashboard.php");
            } else {
                header("Location: /user_dashboard.php");
            }
            exit;
        } else {
            echo "Identifiants incorrects.";
        }
    }

    /**
     * Enregistrement d’un utilisateur
     */
    public function register() {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username && $email && $password) {
            // Vérifie si l'utilisateur existe déjà
            $check = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $check->execute([$username, $email]);
            if ($check->fetch()) {
                echo "Ce nom d'utilisateur ou cet email est déjà utilisé.";
                return;
            }

            // Hash du mot de passe
            $hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertion
            $stmt = $this->db->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$username, $email, $hash]);

            echo "Compte créé avec succès. <a href='/app/views/login.php'>Se connecter</a>";
        } else {
            echo "Tous les champs sont requis.";
        }
    }

    /**
     * Déconnexion utilisateur
     */
    public function logout() {
        session_start();
        session_destroy();
        header("Location: /app/views/login.php");
        exit;
    }

    /**
     * Exemple de dashboard (non utilisé ici)
     */
    public function dashboard() {
        if (!isset($_SESSION['user'])) {
            header("Location: /app/views/login.php");
            exit;
        }

        echo "Bienvenue " . htmlspecialchars($_SESSION['user']['username']) . " (" . $_SESSION['user']['role'] . ")";
    }
}
