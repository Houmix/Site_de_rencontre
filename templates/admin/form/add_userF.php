<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hachage du mot de passe pour la sécurité
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $birthday = $_POST['birthday'];
    $orientation = $_POST['orientation'];
    $bio = $_POST['bio'];

    // Chemin vers la base de données SQLite
    $dbPath = '../../DB/my_database.db';

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:' . $dbPath);
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête INSERT pour ajouter un nouvel utilisateur
        $sql = "INSERT INTO user (gender, firstname, lastname, email, password, phone, city, birthday, orientation, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$gender, $firstname, $lastname, $email, $password, $phone, $city, $birthday, $orientation, $bio]);

        // Rediriger vers une page de confirmation ou la liste des utilisateurs après création
        header("Location: ../admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>
