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
            $user_orientation = htmlspecialchars($user['orientation']);
            $dog_breed = htmlspecialchars($user['dog_breed']);

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
                <select id="orientation" name="orientation" required>
                    <option value="heterosexuel" <?php if ($user_orientation == 'heterosexuel') echo 'selected'; ?>>Hétérosexuel(le)</option>
                    <option value="homosexuel" <?php if ($user_orientation == 'homosexuel') echo 'selected'; ?>>Homosexuel(le)</option>
                    <option value="bisexuel" <?php if ($user_orientation == 'bisexuel') echo 'selected'; ?>>Bisexuel(le)</option>
                    <option value="pansexuel" <?php if ($user_orientation == 'pansexuel') echo 'selected'; ?>>Pansexuel(le)</option>
                    <option value="asexuel" <?php if ($user_orientation == 'asexuel') echo 'selected'; ?>>Asexuel(le)</option>
                    <option value="autre" <?php if ($user_orientation == 'autre') echo 'selected'; ?>>Autre</option>
                </select>
                <label for="dog_breed">Race de l'animal :</label><br>
                <select id="dog_breed" name="dog_breed" required>
                    <option value="Akita" <?php if ($dog_breed == 'Akita') echo 'selected'; ?>>Akita</option>
                    <option value="Afghan Hound" <?php if ($dog_breed == 'Afghan Hound') echo 'selected'; ?>>Afghan Hound</option>
                    <option value="Alaskan Klee Kai" <?php if ($dog_breed == 'Alaskan Klee Kai') echo 'selected'; ?>>Alaskan Klee Kai</option>
                    <option value="American Hairless Terrier" <?php if ($dog_breed == 'American Hairless Terrier') echo 'selected'; ?>>American Hairless Terrier</option>
                    <option value="American Foxhounds" <?php if ($dog_breed == 'American Foxhounds') echo 'selected'; ?>>American Foxhounds</option>
                </select>
                <label>Bio:</label>
                <textarea name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea><br>
                <label>Abonnement:</label>
                <select id="subscription" name="subscription">
                    <?php 
                        if ($subcriptions) {
                            foreach ($subcriptions as $subcription) {
                                echo "<option value='" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                                
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
