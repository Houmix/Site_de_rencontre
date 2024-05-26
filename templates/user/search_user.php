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
            $dateOfBirth = $user['birthday'];
            
            if (!is_null($dateOfBirth)) {
                $birthdate = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
                if ($birthdate) {
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthdate)->y;
                } else {
                    echo "Format de date de naissance invalide pour l'utilisateur ID: " . $user['id'] . "<br>";
                }
            } else {
                echo "Date de naissance manquante pour l'utilisateur ID: " . $user['id'] . "<br>";
            }
    
            echo "<div class='card'>
                <img src='../pic/".$user['photo']."' alt='".$user['firstname']."' class='user-image'>
                <div class='user-info'>
                    <h5>".$user['firstname']." ".$user['lastname']."</h5>
                    <h6>".$age." ans</h6>
                    <div class='actions'>
                        <a href='../feature/like.php?id=".$user['id']."' class='like-btn'>Liker</a>
                        <a href='../feature/see_profile.php?id=".$user['id']."' class='profile-btn'>Voir +</a>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo "<p>Aucun utilisateur trouvé.</p>";
    }
    echo "<a href='home.php'>retour</a>
        </div>";
    include '../template/footer.php';
}
?>
