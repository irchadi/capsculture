<?php
require_once __DIR__ . '/../../config/config.php';
$stmt = $pdo->query("SELECT * FROM facts ORDER BY created_at DESC LIMIT 5");
$facts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Capsculture</title>
  <link rel="stylesheet" href="/capsculture/public/css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<header class="header">
  <div class="logo">CAPSCULTURE</div>
  <nav class="nav">
  <a href="/capsculture/public/index.php?action=home">Accueil</a>
  <a href="#">Top 5</a>
  <a href="#">Ajouter</a>
  <a href="#">Catégories</a>
  <a href="#">API</a>

  <?php if (isset($_SESSION['user'])): ?>
    <a href="/capsculture/public/index.php?action=dashboard">Espace</a>
    <a href="/capsculture/public/index.php?action=logout">Déconnexion</a>
  <?php else: ?>
    <a href="/capsculture/public/index.php?action=loginForm" class="login">Login</a>
    <a href="/capsculture/public/index.php?action=registerForm" class="join">Join</a>
  <?php endif; ?>
</nav>
</header>

<main class="main-content">
  <h1>Chaque jour une<br><span>anecdote culturelle<br>différente</span></h1>

  <section class="capsules">
    <?php foreach ($facts as $fact): ?>
      <div class="capsule">
        <p><?= htmlspecialchars($fact['content']) ?></p>
      </div>
    <?php endforeach; ?>
  </section>
</main>
</body>
</html>



