<?php
// Connexion à la base de données
$pdo = new PDO('sqlite:../DB/my_database.db');

// Vérifier si une recherche a été soumise
if (isset($_GET['search_term'])) {
    $search_term = $_GET['search_term'];

    // Préparer la requête SQL pour rechercher un utilisateur par nom ou prénom
    $sql = "SELECT * FROM user WHERE firstname LIKE :search_term OR lastname LIKE :search_term";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search_term' => "%$search_term%"]);

    // Récupérer les résultats de la recherche
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    include '../template/header.php';
    // Afficher les résultats
    echo'<div class="center">';
    if ($results) {
        echo "<h2>Résultats de la Recherche :</h2>";
        foreach ($results as $user) {
            echo "<p>{$user['firstname']} {$user['lastname']}</p>";
        }
    } else {
        echo "<p>Aucun utilisateur trouvé.</p>";
    }
    echo "<a href='admin_dashboard.php'>retour</a>
        </div>";
    include '../template/footer.php';
}
?>
