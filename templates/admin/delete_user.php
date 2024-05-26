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
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        // Créer (ou ouvrir) une connexion à la base de données SQLite
        $pdo = new PDO('sqlite:../DB/my_database.db');
        // Configurer PDO pour lancer des exceptions en cas d'erreur
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête DELETE pour supprimer l'utilisateur
        $sql = "DELETE FROM user WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$userId]);

        // Rediriger vers la page de la liste des utilisateurs après suppression
        header("Location: admin_dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Erreur lors de la suppression de l'utilisateur : " . $e->getMessage();
    }
} else {
    echo 'ID d\'utilisateur non fourni.';
}
?>
