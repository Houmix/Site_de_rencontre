<?php
include '../template/header.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
} else {

        $pdo = new PDO('sqlite:../DB/my_database.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Requête pour récupérer les informations de l'utilisateur
        $request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
        $request->execute([$_SESSION["user_id"]]);
        $response = $request->fetch(PDO::FETCH_ASSOC);

        if ($response) {
            // Requête pour récupérer les informations d'abonnement de l'utilisateur
            if (!$response["is_admin"]) {
                header("Location: ../user_space.php");
                exit();
        } else {
            echo "Utilisateur non trouvé.";
            header("Location: ../user_space.php");
            exit();
        }
    }
}
if (isset($_GET['id'])) {
    $subscriptionId = $_GET['id'];

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SELECT pour récupérer les détails de l'utilisateur
        $sql = "SELECT * FROM subscription WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$subscriptionId]);
        $subscription = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($subscription) {
            // Afficher le formulaire d'édition
            ?>
            <h1>Éditer le profil de l'utilisateur</h1>
            <form action="update_subscription.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($subscription['id']); ?>">
                <label>Description:</label>
                <input type="text" name="description" value="<?php echo htmlspecialchars($subscription['description']); ?>"><br>
                <label>Nom:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($subscription['name']); ?>"><br>
                <label>Prix:</label>
                <input type="email" name="price" value="<?php echo htmlspecialchars($subscription['price']); ?>"><br>
                <label>Durée:</label>
                <input type="text" name="duration" value="<?php echo htmlspecialchars($subscription['duration']); ?>"><br>
                <label>Limite de like:</label>
                <input type="text" name="limited_like" value="<?php echo htmlspecialchars($subscription['limited_like']); ?>"><br>
                <label>Nombre de like:</label>
                <input type="number" name="number_like" value="<?php echo htmlspecialchars($subscription['number_like']); ?>"><br>
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
