<?php
include '../template/header.php';
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
try {
    // Créer (ou ouvrir) une connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SELECT pour récupérer tous les utilisateurs
    $sql = "SELECT * FROM user";
    $stmt = $pdo->query($sql); 


    // Récupérer tous les enregistrements sous forme de tableau associatif
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Requête SELECT pour récupérer tous les utilisateurs
    $sql = "SELECT * FROM subscription";
    $stmt = $pdo->query($sql); 
    $subcriptions = 

    $subcription = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (Exception $e) {
    echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}
?>
    <link rel="stylesheet" href="../css/admin.css">      
    
    <p><a href="../user/user_space.php">Mon profile</a></p>
    <br>
    <form action="searchF.php" method="GET">
        <label for="search_term">Nom ou Prénom :</label>
        <input type="text" id="search_term" name="search_term" required>
        <button type="submit">Rechercher</button>
    </form>
    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Genre</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Ville</th>
                <th>Animal</th>
                <th>Abonnement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['gender']); ?></td>
                        <td><?php echo htmlspecialchars($user['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($user['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['phone']); ?></td>
                        <td><?php echo htmlspecialchars($user['city']); ?></td>
                        <td><?php echo htmlspecialchars($user['dog_breed']); ?></td>
                        <td><?php echo htmlspecialchars($user['subscription']); ?></td>
                        <td>
                            <a href="view_profile.php?id=<?php echo $user['id']; ?>">Voir</a> |
                            <a href="edit_profile.php?id=<?php echo $user['id']; ?>">Modifier</a> |
                            <a href="block_profile.php?id=<?php echo $user['id']; ?>">Bloquer</a> |
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h1>Liste des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Durée en jours</th>
                <th>Like limité</th>
                <th>Nombre de like</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($subcriptions)): ?>
                <?php foreach ($subcriptions as $subcription): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($subscription['id']); ?></td>
                        <td><?php echo htmlspecialchars($subscription['description']); ?></td>
                        <td><?php echo htmlspecialchars($subscription['name']); ?></td>
                        <td><?php echo htmlspecialchars($subscription['price']); ?></td>
                        <td><?php echo htmlspecialchars($subscription['duration']); ?></td>
                        <td><?php echo htmlspecialchars($subscription['limited_like']); ?></td>
                        <td><?php echo htmlspecialchars($subscription['number_like']); ?></td>
                        <td>
                            <a href="edit_subscription.php?id=<?php echo $subscription['id']; ?>">Modifier l'abonnement</a> |
                            <a href="delete_subscription.php?id=<?php echo $subscription['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">Aucun abonnement trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="add_subscription.php">Ajouter</a>

    
<?php include '../template/footer.php'; ?>