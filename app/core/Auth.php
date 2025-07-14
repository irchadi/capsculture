<?php
namespace Core;

class Auth {
    public static function check(): bool {
        return isset($_SESSION['user']);
    }

    public static function isAdmin(): bool {
        return self::check() && $_SESSION['user']['role'] === 'admin';
    }

    public static function requireLogin() {
        if (!self::check()) {
            header("Location: /app/views/login.php");
            exit;
        }
    }

    public static function requireAdmin() {
        if (!self::isAdmin()) {
            http_response_code(403);
            echo "Accès interdit.";
            exit;
        }
    }
}

