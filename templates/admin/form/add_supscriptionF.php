<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $limited_like = $_POST['limited_like'];
    $number_like = isset($_POST['number_like']) ? $_POST['number_like'] : NULL;

    // Chemin vers la base de données SQLite
    $dbPath = '../../DB/my_database.db';

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:' . $dbPath);
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête INSERT pour ajouter un nouvel abonnement
        $sql = "INSERT INTO subscription (name, description, price, duration, limited_like, number_like) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $price, $duration, $limited_like, $number_like]);

        // Rediriger vers une page de confirmation ou la liste des abonnements après création
        header("Location: admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la création de l'abonnement : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>
