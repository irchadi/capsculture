<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>

    <!-- action vers le routeur avec action=login -->
    <form method="POST" action="/router.php?action=login">
        <label>Nom d'utilisateur ou email</label><br>
        <input type="text" name="identifier" required><br><br>

        <label>Mot de passe</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>



