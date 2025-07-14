<?php

require_once __DIR__ . '/../config/config.php'; // Connexion PDO via $pdo

$stmt = $pdo->query("SELECT * FROM facts ORDER BY created_at DESC LIMIT 5");
$facts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Capsculture - Accueil</title>
</head>

<header class="header">
  <div class="logo">LOGO</div>
  <nav class="nav">
    <a href="#">Accueil</a>
    <a href="#">Top 5</a>
    <a href="#">Ajouter</a>
    <a href="#">Catégories</a>
    <a href="#">API</a>
    <?php if (isset($_SESSION['user'])): ?>
      <a href="/router.php?action=dashboard">Espace</a>
    <?php else: ?>
      <a href="/app/views/login.php" class="login">Login</a>
      <a href="/app/views/register.php" class="join">Join</a>
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
</html>