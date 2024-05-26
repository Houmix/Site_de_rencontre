<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_userId = $_POST['id'];
    

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête UPDATE pour mettre à jour les détails de l'utilisateur
        $sql = "INSERT INTO blocked SET (user1_id, user2_id) VALUE ?,?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION["user_id"], $target_userId]);

        // Rediriger vers la page de la liste des utilisateurs après mise à jour
        header("Location: ../user/home.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors du bloquage de l'utilisateur : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>
