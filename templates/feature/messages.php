<?php include '../template/header.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Créer (ou ouvrir) une connexion à la base de données SQLite
$pdo = new PDO('sqlite:../DB/my_database.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Requête pour obtenir les derniers messages dans chaque fil de discussion
$sql = "SELECT m.*, u.firstname, u.lastname 
        FROM messages m
        JOIN user u ON m.sender_id = u.id
        WHERE m.id IN (
            SELECT MAX(id)
            FROM messages
            WHERE sender_id = :user_id OR receiver_id = :user_id
            GROUP BY CASE
                WHEN sender_id = :user_id THEN receiver_id
                ELSE sender_id
            END
        )
        ORDER BY m.sent_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .message {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
    }
    .sender {
        font-weight: bold;
    }
    .content {
        margin-top: 5px;
    }
    .timestamp {
        color: #999;
        font-size: 0.9em;
    }
</style>

<h1>Vos messages</h1>
<?php if (empty($messages)): ?>
    <p>Vous n'avez aucun message.</p>
<?php else: ?>
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <div class="sender">
                <?= htmlspecialchars($message['firstname'] . ' ' . $message['lastname']) ?>
            </div>
            <div class="timestamp">
                <?= htmlspecialchars($message['sent_at']) ?>
            </div>
            <div class="content">
                <?= nl2br(htmlspecialchars($message['content'])) ?>
            </div>
            <div>
                <a href="send_message.php?message_to_user_id=<?= $message['sender_id'] == $user_id ? $message['receiver_id'] : $message['sender_id'] ?>">Voir la discussion</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php include '../template/footer.php'; ?>
