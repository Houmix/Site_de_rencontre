<?php include '../template/header.php'; $custom_css = "../css/send_message.css"; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
}

$pdo = new PDO('sqlite:../DB/my_database.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_SESSION['user_id'];

if (isset($_GET['message_to_user_id'])) {
    $receiver_id = $_GET['message_to_user_id'];

    // Récupérer les informations de l'utilisateur destinataire
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->execute(['id' => $receiver_id]);
    $receiver = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$receiver) {
        echo "Utilisateur non trouvé.";
        exit();
    }

    // Requête pour obtenir tous les messages échangés entre l'utilisateur actuel et le destinataire
    $sql = "SELECT m.*, u.firstname, u.lastname 
            FROM messages m
            JOIN user u ON m.sender_id = u.id
            WHERE (m.sender_id = :user_id AND m.receiver_id = :receiver_id) 
               OR (m.sender_id = :receiver_id AND m.receiver_id = :user_id)
            ORDER BY m.sent_at ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'user_id' => $user_id,
        'receiver_id' => $receiver_id
    ]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Requête pour obtenir les utilisateurs appariés
    $sql = "SELECT * FROM user WHERE id IN (
                SELECT user1_id FROM match WHERE user2_id = :user_id
                UNION
                SELECT user2_id FROM match WHERE user1_id = :user_id
            )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $matched_users = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

    

<body>


    <?php if (isset($messages)): ?>
        <h2>Discussion avec <?= htmlspecialchars($receiver['firstname'] . ' ' . $receiver['lastname']) ?></h2>
        <hr style="border-top: 10px solid #333; width:30%">
        <br>
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
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <br>
    <h2>Envoyer un message</h2>
    <hr style="border-top: 10px solid #333; width:30%">
    <br>
    <form action="form/send_messageF.php" method="POST">
        <label>Envoyer à:</label>
        <select name="receiver_id" required>
            <?php 
            if (!isset($_GET['message_to_user_id'])) {
                foreach ($matched_users as $user) {
                    echo "<option value='" . htmlspecialchars($user['id']) . "'>" .
                        htmlspecialchars($user['firstname'] . " " . $user['lastname']) .
                        "</option>";
                }
            } else {
                echo "<option value='" . htmlspecialchars($receiver['id']) . "'>" .
                    htmlspecialchars($receiver['firstname'] . " " . $receiver['lastname']) .
                    "</option>";
            }
            ?>
        </select>
        
        <label>Message:</label>
        <textarea name="content" required></textarea>
        
        <input type="submit" value="Envoyer">
    </form>
<?php include '../template/footer.php'; ?>
