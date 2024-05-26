<?php include '../template/header.php';
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

?>

<link rel="stylesheet" type="text/css" href="../css/suscribtion.css">

    <h1>Créer un abonnement</h1>
    <form action="add_subscriptionF.php" method="POST">
        <label>Nom:</label>
        <input type="text" name="name" required>
        
        <label>Description:</label>
        <textarea name="description" required></textarea>
        
        <label>Prix:</label>
        <input type="number" step="0.01" name="price" required>
        
        <label>Durée (en jours):</label>
        <input type="number" name="duration" required>
        
        <label>Nombre de likes limité:</label>
        <select name="limited_like" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
        
        <label>Nombre de likes:</label>
        <input type="number" name="number_like">
        
        <input type="submit" value="Créer">
    </form>


<?php include '../template/footer.php'; ?>