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
        // Requête SELECT pour récupérer tous les abonnements
        $sql = "SELECT * FROM subscription";
        $stmt = $pdo->query($sql);

        // Récupérer tous les enregistrements sous forme de tableau associatif
        $subcriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($user) {
            // Afficher le formulaire d'édition
            ?>
            <h1>Éditer le profil de l'utilisateur</h1>
            <form action="update_profile.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                <label>Genre:</label>
                <input type="text" name="gender" value="<?php echo htmlspecialchars($user['gender']); ?>"><br>
                <label>Prénom:</label>
                <input type="text" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>"><br>
                <label>Nom:</label>
                <input type="text" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>"><br>
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br>
                <label>Téléphone:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"><br>
                <label>Ville:</label>
                <input type="text" name="city" value="<?php echo htmlspecialchars($user['city']); ?>"><br>
                <label>Date de naissance:</label>
                <input type="date" name="birthday" value="<?php echo htmlspecialchars($user['birthday']); ?>"><br>
                <label>Orientation:</label>
                <input type="text" name="orientation" value="<?php echo htmlspecialchars($user['orientation']); ?>"><br>
                <label>Bio:</label>
                <textarea name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea><br>
                <label>Abonnement:</label>
                <select id="subscription" name="subscription">
                    <?php 
                        if ($subcriptions) {
                            foreach ($subcriptions as $subcription) {
                                if ($subcription['name'] != $_SESSION["subscription_name"]) {
                                    echo "<option value='" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                                } else {
                                    echo "<option value='" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "' disabled>" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                                }
                            }
                        } else {
                            echo "<p>aucun abonnement actif</p>";
                        }
                    ?>
                </select>
                
                <input type="submit" value="Mettre à jour">
            </form>
            <?php
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
