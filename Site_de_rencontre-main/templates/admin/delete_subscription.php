<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête DELETE pour supprimer l'utilisateur
        $sql = "DELETE FROM subscription WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);

        // Rediriger vers la page de la liste des utilisateurs après suppression
        header("Location: admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la suppression de l'abonnement : " . $e->getMessage();
    }
} else {
    echo 'ID de l\'abonnement non fourni.';
}
?>
