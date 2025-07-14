<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

use Core\Auth;
Auth::requireAdmin();
?>

<h1>Dashboard Admin</h1>
<p>Bienvenue <?= htmlspecialchars($_SESSION['user']['username']) ?> (admin)</p>
<a href="/router.php?action=logout">Se déconnecter</a>

