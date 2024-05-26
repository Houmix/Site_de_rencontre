<?php include '../template/header.php'; ?>

<?php 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
}

try {
    $pdo = new PDO('sqlite:../DB/my_database.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Requête pour récupérer les informations de l'utilisateur
    $request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    $request->execute([$_SESSION["user_id"]]);
    $response = $request->fetch(PDO::FETCH_ASSOC);

    if ($response) {
        // Requête pour récupérer les informations d'abonnement de l'utilisateur
        $subscription = $pdo->prepare("SELECT * FROM subscription WHERE name = ?");
        $subscription->execute([$response['subscription']]);
        $response_subscription = $subscription->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Utilisateur non trouvé.";
    }

} catch (Exception $e) {
    echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
}

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>Mon espace</title>
<link rel="stylesheet" href="../css/user_space.css"></link>

<h3>Mon abonnement</h3>
<hr style="border-top: 10px solid #333; width:70%">

<!-- Presentation de l'abonnement obtenue grâce à une requête -->
<div class="center">
    <?php
        if (isset($_SESSION['resiliation_succed'])) {
            echo "<p style='color: red;'>{$_SESSION['resiliation_succed']}</p>";
            unset($_SESSION['resiliation_succed']);
        }
        if (isset($_SESSION['resiliation_error'])) {
            echo "<p style='color: red;'>{$_SESSION['resiliation_error']}</p>";
            unset($_SESSION['resiliation_error']);
        }
        if (isset($_SESSION['resiliation_error2'])) {
            echo "<p style='color: red;'>{$_SESSION['resiliation_error2']}</p>";
            unset($_SESSION['resiliation_error2']);
        }
        if (isset($_SESSION['user_not_found'])) {
            echo "<p style='color: red;'>{$_SESSION['user_not_found']}</p>";
            unset($_SESSION['user_not_found']);
        }
        if ($response_subscription) {
            $subscription_detail = $pdo->prepare("SELECT * FROM user_subscription WHERE user_id = ?");
            $subscription_detail->execute([$response["id"]]);
            $response_subscription_detail = $subscription_detail->fetch(PDO::FETCH_ASSOC);

            echo "<p>Vous avez l'abonnement " . $response_subscription["name"] . "</p>";
            echo "<p>Il se termine le " . $response_subscription_detail["end"] . "</p>";
            echo "<p><a href='unsubscribe.php?sub_id='".$response_subscription_detail["id"]." onclick='return confirm(\"Êtes-vous sûr de vouloir résilier ?\")';>Résilier</a> <a href='change_subscription.php'>Modifier</a></p>";
        } else {
            echo "<p>Vous n'avez aucun abonnement en cours</p>";
            echo "<p><a href='subscribe.php'>S'abonner</a></p>";
        }
    ?>
</div>

<h3>Mon Profil</h3>
<hr style="border-top: 10px solid #333; width:70%">
<br>

<?php
if (isset($_SESSION['success'])) {
    echo "<p style='color: red;'>{$_SESSION['success']}</p>";
    unset($_SESSION["success"]);
}
?>


<div class="my_infos"> 
    <div>
        <img href="../pic/<?php echo htmlspecialchars($response['photo']);?>">
    </div>

    <div class="infos">
        <p class="type" >Genre :</p>
        <p class="value"><?php echo htmlspecialchars($response['gender']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Prénom :</p>
        <p class="value"><?php echo htmlspecialchars($response['firstname']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Nom :</p>
        <p class="value"><?php echo htmlspecialchars($response['lastname']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Age :</p>
        <p class="value">
            <?php 
                $dateOfBirth = $response['birthday'];
            
                // Vérifier que la date de naissance n'est pas null et créer un objet DateTime
                if (!is_null($dateOfBirth)) {
                    $birthdate = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
                    if ($birthdate) {
                        // Obtenir la date actuelle
                        $currentDate = new DateTime();
                        // Calculer la différence entre la date actuelle et la date de naissance
                        $age = $currentDate->diff($birthdate)->y;
                        echo $age;
                        
                    } else {
                        echo "Format de date de naissance invalide pour l'utilisateur ID: " . $response['id'] . "<br>";
                    }
                } else {
                    echo "Date de naissance manquante pour l'utilisateur ID: " . $response['id'] . "<br>";
                }
            ?>
        </p>
    </div>
    <div class="infos">
        <p class="type" >Email :</p>
        <p class="value"><?php echo htmlspecialchars($response['email']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Numéro de téléphone :</p>
        <p class="value"><?php echo htmlspecialchars($response['phone']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Ville :</p>
        <p class="value"><?php echo htmlspecialchars($response['city']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Orientation :</p>
        <p class="value"><?php echo htmlspecialchars($response['orientation']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Race de l'animal :</p>
        <p class="value"><?php echo htmlspecialchars($response['dog_breed']); ?></p>
    </div>
    <div class="infos">
        <p class="type" >Bio :</p>
        <p class="value"><?php echo htmlspecialchars($response['bio']); ?></p>
    </div>

    <a href="edit_user_info.php">Modifier</a>
    
</div>
<br>

<div>
    <h3>Mes matchs</h3>
    <hr style="border-top: 10px solid #333; width:70%">
    <br>
    <?php
        // Requête SELECT pour récupérer les matchs
        $sql = "SELECT * FROM match WHERE (user1_id = ?) OR (user2_id = ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id'], $_SESSION['user_id']]);
        $users_match = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users_match as $match) {
            // Récupérer l'ID de l'autre utilisateur dans le match
            $other_user_id = ($match['user1_id'] == $_SESSION['user_id']) ? $match['user2_id'] : $match['user1_id'];

            // Requête pour récupérer les informations de l'autre utilisateur
            $other_user_request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
            $other_user_request->execute([$other_user_id]);
            $other_user = $other_user_request->fetch(PDO::FETCH_ASSOC);

            if ($other_user) {
                $birthdate = DateTime::createFromFormat('Y-m-d', $other_user['birthday']);
                $age = $birthdate ? (new DateTime())->diff($birthdate)->y : 'Inconnu';

                echo "<div class='card center'>
                    <h5>".$other_user['firstname']." ".$other_user['lastname']."</h5>
                    <h6>Age: ".$age." ans</h6>
                    <br>
                    <a href='../feature/messages.php?id=".$other_user['id']."' class='add-to-cart left-text' id='like'>Envoyer un message</a>
                    <a href='../feature/see_profile.php?id=".$other_user['id']."' class='right-text'>Voir +</a>
                </div>";
            }
        }
    ?>
</div>

<div>
    <h3>Mes bloqués</h3>
    <hr style="border-top: 10px solid #333; width:70%">
    <br>
    <?php
        // Requête SELECT pour récupérer les utilisateurs bloqués
        $sql = "SELECT * FROM blocked WHERE user1_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $users_blocked = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users_blocked as $blocked) {
            // Récupérer l'ID de l'utilisateur bloqué
            $blocked_user_id = $blocked['user2_id'];

            // Requête pour récupérer les informations de l'utilisateur bloqué
            $blocked_user_request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
            $blocked_user_request->execute([$blocked_user_id]);
            $blocked_user = $blocked_user_request->fetch(PDO::FETCH_ASSOC);

            if ($blocked_user) {
                $birthdate = DateTime::createFromFormat('Y-m-d', $blocked_user['birthday']);
                $age = $birthdate ? (new DateTime())->diff($birthdate)->y : 'Inconnu';

                echo "<div class='card center'>
                    <h5>".$blocked_user['firstname']." ".$blocked_user['lastname']."</h5>
                    <h6>Age: ".$age." ans</h6>
                    <br>
                    <a href='../feature/unblocked.php?id=".$blocked_user['id']."' class='right-text'>Débloquer</a>
                </div>";
            }
        }
    ?>
</div>


<?php include '../template/footer.php'; ?>
