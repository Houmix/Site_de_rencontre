<?php
session_start();

// Chemin vers la base de données SQLite
$dbPath = '../../DB/my_database.db';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['subscription'])) {
        $newSubscription = $_POST['subscription'];
        $userId = $_SESSION['user_id']; 

        try {
            // Connexion à la base de données SQLite
            $pdo = new PDO('sqlite:' . $dbPath);
            // Configurer PDO pour lancer des exceptions en cas d'erreur
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Début de la transaction
            $pdo->beginTransaction();

            // Supprimer l'ancienne entrée dans user_subscription pour cet utilisateur
            $deleteQuery = 'DELETE FROM user_subscription WHERE user_id = ?';
            $deleteStmt = $pdo->prepare($deleteQuery);
            $deleteStmt->execute([$userId]);

            // Récupérer la durée de l'abonnement
            $durationQuery = 'SELECT duration FROM subscription WHERE name = ?';
            $durationStmt = $pdo->prepare($durationQuery);
            $durationStmt->execute([$newSubscription]);
            $durationResult = $durationStmt->fetch(PDO::FETCH_ASSOC);

            if ($durationResult) {
                $duration = $durationResult['duration'];

                // Définir la date de début (aujourd'hui)
                $startDate = date('Y-m-d');
                // Calculer la date de fin en ajoutant la durée
                $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $duration . ' days'));

                // Insérer la nouvelle entrée dans user_subscription
                $insertQuery = 'INSERT INTO user_subscription (user_id, subscription, change_date, start, end) VALUES (?, ?, datetime("now"), ?, ?)';
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->execute([$userId, $newSubscription, $startDate, $endDate]);

                // Mettre à jour la colonne subscription dans la table user
                $updateUserSubscriptionQuery = 'UPDATE user SET subscription = ? WHERE id = ?';
                $updateUserSubscriptionStmt = $pdo->prepare($updateUserSubscriptionQuery);
                $updateUserSubscriptionStmt->execute([$newSubscription, $userId]);

                // Mettre à jour la session pour refléter le nouveau choix
                $_SESSION['subscription_name'] = $newSubscription;

                // Valider la transaction
                $pdo->commit();

                // Rediriger l'utilisateur vers une page de confirmation
                header("Location: ../user_space.php");
                exit();
            } else {
                throw new Exception('Abonnement non trouvé.');
            }
        } catch (Exception $e) {
            // En cas d'erreur, annuler la transaction
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            echo "Erreur lors de la mise à jour de l'abonnement : " . $e->getMessage();
        }
    } else {
        echo "Aucun abonnement sélectionné.";
    }
} else {
    echo "Méthode de requête invalide.";
}
?>
