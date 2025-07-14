<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Capsculture</title>
</head>
<body>
    <h2>Connexion</h2>
    <form action="/router.php?action=login" method="POST">
        <label>Nom d'utilisateur ou email :</label><br>
        <input type="text" name="identifier" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

