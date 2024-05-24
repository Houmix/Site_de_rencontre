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
}
/* Container styling */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Center align */
.center {
    text-align: center;
}

/* Block for user cards */
.block {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* User card styling */
.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 250px;
    text-align: center;
}

/* User image styling */
.user-image {
    width: 100%;
    height: auto;
    border-radius: 50%;
    margin-bottom: 15px;
}

/* User info styling */
.user-info {
    margin-bottom: 10px;
}

/* User name and age styling */
.user-info h5 {
    margin: 0;
    font-size: 1.2em;
    color: #333;
}

.user-info h6 {
    margin: 5px 0;
    font-size: 1em;
    color: #666;
}

/* Actions (buttons) styling */
.actions {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
}

.actions a {
    text-decoration: none;
    color: wheat;
    background-color: #2a2b29;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.actions a:hover {
    background-color: #2a2b29;
}

/* Additional link styling */
a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>

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
    <div class="center">
        <h3>Retrouve tes match <a href="user_space.php">ici</a></h3>
    </div>

    <br>
    <div>
        <h3>Trouve ton âme sœur</h3>
        <div class="block">
            <?php 
                if ($users){
                    foreach ($users as $user) {
                        $ignoreUser = false;
                        
                        foreach ($users_match as $user_match) {
                            if ($user_match["id"] == $user["id"]) {
                                $ignoreUser = true;
                                break;
                            }
                        }
                        
                        if ($ignoreUser) {
                            continue;
                        }
                        
                        foreach ($users_blocked as $user_blocked) {
                            if ($user_blocked["id"] == $user["id"]) {
                                $ignoreUser = true;
                                break;
                            }
                        }
                        
                        if ($ignoreUser) {
                            continue;
                        }

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
                    echo "<h5>Pas de match possible</h5>";
                }
            ?>
        </div>
    </div>
</div>



<?php include '../template/footer.php'; ?>