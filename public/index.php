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
<body>
    <h1>Dernières capsules culturelles</h1>

    <?php foreach ($facts as $fact): ?>
        <div style="margin-bottom: 20px;">
            <p><?= htmlspecialchars($fact['content']) ?></p>
            <p><strong>👍 <?= $fact['likes'] ?> like(s)</strong></p>
        </div>
    <?php endforeach; ?>
</body>
</html>