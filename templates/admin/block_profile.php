<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
} else {
    $pdo = new PDO('sqlite:../DB/my_database.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    $request->execute([$_SESSION["user_id"]]);
    $response = $request->fetchAll(PDO::FETCH_ASSOC);
    
    if ($response) {
        // Accéder à la première ligne du tableau $response
        $firstRow = $response[0];
        // Vérifier si l'utilisateur est administrateur
        if (!$firstRow["is_admin"]) {
            header("Location: ../user/user_space.php");
            exit();
        }
    } else {
        echo "Utilisateur non trouvé.";
        
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête UPDATE pour mettre à jour les détails de l'utilisateur
        $sql = "UPDATE user SET blocked = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["1", $userId]);

        // Rediriger vers la page de la liste des utilisateurs après mise à jour
        header("Location: admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors du bloquage de l'utilisateur : " . $e->getMessage();
    }
} else {
    echo 'Méthode de requête invalide.';
}
?>
