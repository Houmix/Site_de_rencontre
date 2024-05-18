<?php
include '../template/header.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SELECT pour récupérer les détails de l'utilisateur
        $sql = "SELECT * FROM user WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Afficher les détails de l'utilisateur
            echo '<h1>Profil de l\'utilisateur</h1>';
            echo '<p>ID : ' . htmlspecialchars($user['id']) . '</p>';
            echo '<p>Genre : ' . htmlspecialchars($user['gender']) . '</p>';
            echo '<p>Prénom : ' . htmlspecialchars($user['firstname']) . '</p>';
            echo '<p>Nom : ' . htmlspecialchars($user['lastname']) . '</p>';
            echo '<p>Email : ' . htmlspecialchars($user['email']) . '</p>';
            echo '<p>Téléphone : ' . htmlspecialchars($user['phone']) . '</p>';
            echo '<p>Ville : ' . htmlspecialchars($user['city']) . '</p>';
            echo '<p>Abonnement : ' . htmlspecialchars($user['subscription']) . '</p>';
        } else {
            echo 'Utilisateur non trouvé.';
        }
    } catch (Exception $e) {
        echo "Erreur lors de la récupération du profil de l'utilisateur : " . $e->getMessage();
    }
} else {
    echo 'ID d\'utilisateur non fourni.';
}
?>
