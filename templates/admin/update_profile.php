<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $birthday = $_POST['birthday'];
    $orientation = $_POST['orientation'];
    $bio = $_POST['bio'];
    $subscription = $_POST['subscription'];

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête UPDATE pour mettre à jour les détails de l'utilisateur
        $sql = "UPDATE user SET gender = ?, firstname = ?, lastname = ?, email = ?, phone = ?, city = ?, birthday = ?, orientation = ?, bio = ?, subscription = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$gender, $firstname, $lastname, $email, $phone, $city, $birthday, $orientation, $bio, $subscription, $userId]);

        // Rediriger vers la page de la liste des utilisateurs après mise à jour
        header("Location: admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la mise à jour du profil de l'utilisateur : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>