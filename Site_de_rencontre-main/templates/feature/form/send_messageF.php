<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];
    $content = $_POST['content'];

    // Chemin vers la base de données SQLite
    $dbPath = '../../DB/my_database.db';

    try {
        // Connexion à la base de données SQLite
        $pdo = new PDO('sqlite:' . $dbPath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête INSERT pour ajouter un nouveau message
        $sql = "INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$sender_id, $receiver_id, $content]);

        echo "Message envoyé avec succès.";
        
       // Construire l'URL de redirection avec les paramètres nécessaires
        $redirect_url = "../send_message.php?message_to_user_id=".htmlspecialchars($receiver_id);

        // Rediriger vers l'URL construite
        header("Location: $redirect_url");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi du message : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>
