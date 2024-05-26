<?php
session_start();
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
    $dog_breed = $_POST['dog_breed'];

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête UPDATE pour mettre à jour les détails de l'utilisateur
        $sql = "UPDATE user SET gender = ?, firstname = ?, lastname = ?, email = ?, phone = ?, city = ?, birthday = ?, orientation = ?, bio = ?, subscription = ?, dog_breed = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$gender, $firstname, $lastname, $email, $phone, $city, $birthday, $orientation, $bio, $subscription, $dog_breed, $userId]);

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
