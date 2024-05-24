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
            echo '<p>Race de l\'animal : ' . htmlspecialchars($user['dog_breed']) . '</p>';
            echo '<p>Orientation : ' . htmlspecialchars($user['orienttion']) . '</p>';
            echo '<p>Abonnement : ' . htmlspecialchars($user['subscription']) . '</p>';
            echo "<div>
            <h3>Ses bloqués</h3>
            <hr style='border-top: 10px solid #333; width:70%'>
            <br>";
            
                // Requête SELECT pour récupérer les utilisateurs bloqués
                $sql = "SELECT * FROM blocked WHERE user1_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$userId]);
                $users_blocked = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($users_blocked as $blocked) {
                    // Récupérer l'ID de l'utilisateur bloqué
                    $blocked_user_id = $blocked['user2_id'];

                    // Requête pour récupérer les informations de l'utilisateur bloqué
                    $blocked_user_request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
                    $blocked_user_request->execute([$blocked_user_id]);
                    $blocked_user = $blocked_user_request->fetch(PDO::FETCH_ASSOC);

                    if ($blocked_user) {
                        $birthdate = DateTime::createFromFormat('Y-m-d', $blocked_user['birthday']);
                        $age = $birthdate ? (new DateTime())->diff($birthdate)->y : 'Inconnu';

                        echo "<div class='card center'>
                            <h5>".$blocked_user['firstname']." ".$blocked_user['lastname']."</h5>
                            <h6>Age: ".$age." ans</h6>
                            <br>
                            <a href='unblocked.php?id=".$blocked_user['id']."?user_id=".$userId."' class='right-text'>Débloquer</a>
                        </div>";
                    }
                }
            echo "</div>";

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
