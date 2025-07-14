<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Auth;
Auth::requireLogin();
?>

<h1>Espace utilisateur</h1>
<p>Bienvenue <?= htmlspecialchars($_SESSION['user']['username']) ?> !</p>
<a href="/router.php?action=logout">Se déconnecter</a>

