<?php include '../template/header.php'; ?>
<?php

try {
    // Créer (ou ouvrir) une connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SELECT pour récupérer tous les utilisateurs
    $sql = "SELECT * FROM user WHERE orientation = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['orientation']]);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Requête SELECT pour savoir si l'utilisateur est un match ou non
    $sql = "SELECT * FROM match WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $_SESSION['orientation']]);
    $users_match = $stmt->fetchAll(PDO::FETCH_ASSOC);


    

    // Requête SELECT pour récupérer tous les bloqué ou qui ont bloqué l'utlisateur
    $sql = "SELECT * FROM blocked WHERE (user1_id = ? AND user2_id = ?) OR (user1_id = ? AND user2_id = ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $_SESSION['orientation']]);
    $users_blocked = $stmt->fetchAll(PDO::FETCH_ASSOC);





} catch (Exception $e) {
    echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}
?>
<style>a#like {
    background-color: #35452B; 
    border-color: #35452B; 
    border-radius: 50px;
    color: white;   
    padding: 5px;
    border:none;
    cursor: pointer;
}</style>

<div>
    <?php
    if (isset($_SESSION['erreur_sql_like'])) {
        echo "<p style='color: red;'>{$_SESSION['erreur_sql_like']}</p>";
        unset($_SESSION['erreur_sql_like']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
    if (isset($_SESSION['not_enough_like'])) {
        echo "<p style='color: red;'>{$_SESSION['not_enough_like']}</p>";
        unset($_SESSION['not_enough_like']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
    if (isset($_SESSION['erreur_like'])) {
        echo "<p style='color: red;'>{$_SESSION['erreur_like']}</p>";
        unset($_SESSION['erreur_like']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
    if (isset($_SESSION['like_valide'])) {
        echo "<p style='color: red;'>{$_SESSION['like_valide']}</p>";
        unset($_SESSION['like_valide']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
    if (isset($_SESSION['no_subscription'])) {
        echo "<p style='color: red;'>{$_SESSION['no_subscription']}</p>";
        unset($_SESSION['no_subscription']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
    if (isset($_SESSION['erreur_like_update'])) {
        echo "<p style='color: red;'>{$_SESSION['erreur_like_update']}</p>";
        unset($_SESSION['erreur_like_update']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
    ?>
</div>
<div class="container">
    <div>
        <h3>Mes matchs</h3>
    </div>
    <div>
        <h3>Trouve ton ame soeur</h3>
        <div class="block">
            <?php 

                if ($users){
                    foreach ($users as $user) {
                        // Drapeau pour savoir si l'utilisateur doit être ignoré
                        $ignoreUser = false;
                        
                        foreach ($users_match as $user_match) {
                            if ($user_match["id"] == $user["id"]) {
                                $ignoreUser = true;
                                break; // Sortir de la boucle interne
                            }
                        }
                        
                        if ($ignoreUser) {
                            continue; // Passer à l'utilisateur suivant
                        }
                        
                        foreach ($users_blocked as $user_blocked) {
                            if ($user_blocked["id"] == $user["id"]) {
                                $ignoreUser = true;
                                break; // Sortir de la boucle interne
                            }
                        }
                        
                        if ($ignoreUser) {
                            continue; // Passer à l'utilisateur suivant
                        }

                        

                        $dateOfBirth = $user['birthday'];
            
                        // Vérifier que la date de naissance n'est pas null et créer un objet DateTime
                        if (!is_null($dateOfBirth)) {
                            $birthdate = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
                            if ($birthdate) {
                                // Obtenir la date actuelle
                                $currentDate = new DateTime();
                                // Calculer la différence entre la date actuelle et la date de naissance
                                $age = $currentDate->diff($birthdate)->y;
                                
                            } else {
                                echo "Format de date de naissance invalide pour l'utilisateur ID: " . $user['id'] . "<br>";
                            }
                        } else {
                            echo "Date de naissance manquante pour l'utilisateur ID: " . $user['id'] . "<br>";
                        }
               
                        echo "<div class='card'>
                            <h5>".$user['firstname']." ".$user['lastname']."</h5>
                            <h6>.".$age."</h6>
                            </div>
                            <div class='container'>
                                <a href='../feature/like.php?id=".$user['id']."' class='add-to-cart left-text' id='like'>Liker</a>
                                <a href='../feature/see_profile.php?id=".$user['id']."' class='right-text'>Voir +</a>
                            </div>";

                    }
                } else {
                    echo "<h5>Pas de match possible</h5>";
                }

            ?>

        </div>
    </div>
</div>


<?php include '../template/footer.php'; ?>