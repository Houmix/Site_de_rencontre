<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $limited_like = $_POST['limited_like'];
    $number_like = $_POST['number_like'];
    

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête UPDATE pour mettre à jour les détails de l'utilisateur
        $sql = "UPDATE subscription SET name = ?, description = ?, duration = ?, price = ?, limited_like = ?, number_like = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $duration, $price, $limited_like, $number_like, $id]);

        // Rediriger vers la page de la liste des utilisateurs après mise à jour
        header("Location: admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la mise à jour dl'abonnement : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>
