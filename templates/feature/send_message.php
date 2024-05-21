<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Créer (ou ouvrir) une connexion à la base de données SQLite
$pdo = new PDO('sqlite:../DB/my_database.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Requête pour obtenir les utilisateurs appariés
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id IN (
            SELECT user1_id FROM match WHERE user2_id = :user_id
            UNION
            SELECT user2_id FROM match WHERE user1_id = :user_id
        )";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$matched_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Envoyer un message</title>
    <style>
        form {
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Envoyer un message</h1>
    <form action="send_messageF.php" method="POST">
        <label>Envoyer à:</label>
        <select name="receiver_id" required>
            <?php foreach ($matched_users as $user): ?>
                <option value="<?= htmlspecialchars($user['id']) ?>">
                    <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label>Message:</label>
        <textarea name="content" required></textarea>
        
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
