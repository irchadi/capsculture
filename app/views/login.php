<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="/capsculture/public/css/style.css">
</head>
<body>
  <h1>Connexion</h1>

  <?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
  <?php endif; ?>

  <?php if (!empty($_SESSION['message'])): ?>
    <p style="color:green;"><?= $_SESSION['message']; unset($_SESSION['message']); ?></p>
  <?php endif; ?>

  <form method="POST" action="/index.php?action=login">
    <label>Nom ou email :</label><br>
    <input type="text" name="identifier" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Connexion</button>
  </form>

  <p><a href="/index.php?action=registerForm">Créer un compte</a></p>
</body>
</html>





