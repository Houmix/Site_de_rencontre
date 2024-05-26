<?php include '../template/header.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
}
try {
    $subId = $_GET['sub_id'];

    // Connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête DELETE pour supprimer l'abonnement de l'utilisateur
    $sql = "DELETE FROM user_subscription WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$subId]);
    $response = $stmt->fetch(PDO::FETCH_ASSOC);

    // Requête SELECT pour MAJ l'abonnement de l'utilisateur
    $sql = "UPDATE user SET subscription = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$subId, $_SESSION["user_id"]]);
    $response = $stmt->fetch(PDO::FETCH_ASSOC);
    

    header("Location: user_space.php");


} catch (Exception $e) {
    echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}

?>