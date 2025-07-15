<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="/capsculture/public/css/style.css">
</head>
<body>
  <h1>Inscription</h1>

  <?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
  <?php endif; ?>

  <form method="POST" action="/index.php?action=register">
    <label>Nom d'utilisateur :</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email :</label><br>
    <input type="email" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="password" required><br><br>

    <label>Confirmer le mot de passe :</label><br>
    <input type="password" name="confirm_password" required><br><br>

    <button type="submit">S'inscrire</button>
  </form>

  <p><a href="/index.php?action=loginForm">J'ai déjà un compte</a></p>
</body>
</html>

