<?php include '../template/header.php'; ?>

<?php 

$connexion = new PDO('sqlite:../DB/my_database.db');
$request = $connexion->prepare('SELECT * FROM user WHERE id = ?');
$request->execute([$_SESSION["user_id"]]);
$response = $request->fetch();

$subscription = $connexion->prepare("SELECT * FROM subscription WHERE name = ?");
$subscription->execute($response['subscription']);
$response_subscription = $subscription->fetch();

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<title>Mon espace</title>
<link rel="stylesheet" href="css/my_space.css"></link>

<h1 class="title">Mon abonnement</h1>
<hr style="border-top: 10px solid #333; width:70%">

<!-- Presentation de l'abonnement obtenue grace a une requete -->




<h1 class="title">Mon Profil</h1>
<hr style="border-top: 10px solid #333; width:70%">
<?php //Changement des infos n'a pas donné d'erreur 
if (isset($_SESSION['success'])) {
    echo "<p style='color: red;'>{$_SESSION['success']}</p>";
    unset($_SESSION["success"]);
}
?>
<div class="my_infos"> 

    <div class="infos">
        <p class="type" >Genre :</p>
        <p class="value"><?php echo $response['gender']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Prenom :</p>
        <p class="value"><?php echo $response['firstname']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Nom :</p>
        <p class="value"><?php echo $response['lastname']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Age :</p>
        <p class="value">
            <?php 
                // Crée un objet DateTime à partir de la date de naissance
                $birthdate = new DateTime($dateOfBirth);
                // Obtenir la date actuelle
                $currentDate = new DateTime();
                // Calculer la différence entre la date actuelle et la date de naissance
                $age = $currentDate->diff($birthdate)->y;
                echo $age; 
            ?>
        </p>
    </div>
    <div class="infos">
        <p class="type" >Email :</p>
        <p class="value"><?php echo $response['email']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Numéro de téléphone :</p>
        <p class="value"><?php echo $response['phone']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Ville :</p>
        <p class="value"><?php echo $response['city']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Orientation :</p>
        <p class="value"><?php echo $response['orientation']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Bio :</p>
        <p class="value"><?php echo $response['bio']; ?></p>
    </div>

    <a href="edit_user_info.php" >Modifier</a>
    
</div>

<div>
    <h3>Mon abonnement</h3>
    <?php
        if (isset($_SESSION['resiliation_succed'])) {
            echo "<p style='color: red;'>{$_SESSION['resiliation_succed']}</p>";
            unset($_SESSION['resiliation_succed']); // Supprimer le message d'erreur de la session après l'avoir affiché
        }
        if (isset($_SESSION['resiliation_error'])) {
            echo "<p style='color: red;'>{$_SESSION['resiliation_error']}</p>";
            unset($_SESSION['resiliation_error']); // Supprimer le message d'erreur de la session après l'avoir affiché
        }
        if (isset($_SESSION['resiliation_error2'])) {
            echo "<p style='color: red;'>{$_SESSION['resiliation_error2']}</p>";
            unset($_SESSION['resiliation_error2']); // Supprimer le message d'erreur de la session après l'avoir affiché
        }
        if (isset($_SESSION['user_not_found'])) {
            echo "<p style='color: red;'>{$_SESSION['user_not_found']}</p>";
            unset($_SESSION['user_not_found']); // Supprimer le message d'erreur de la session après l'avoir affiché
        }
        if ($response2) {
            $subscription_detail = $connexion->prepare("SELECT * FROM user_subscription WHERE user_id = ?");
            $subscription_detail->execute($response["id"]);
            $response_subscription_detail->fetch();
            $_SESSION["subscription_name"]= $response_subscription["name"];
            

            echo "<p>Vous avez l'abonnement ".$response_subscription["name"]."</p>
            <p>Il se termine le ".$response_subscription_detail["end"]."</p>
            <p><a href='php/resilier.php' onclick='return confirm('Êtes-vous sûr de vouloir supprimer résiler ?')';>Résilier</a> <a href='change_subscription.php'>Modifier<a>";
            
            
        } else {
            echo "<p>Vous n'avez aucun abonnement en cours</p>";
            echo "<p><a href='subscribe.php'>S'abonner<a></p>";
        }
    ?>
</div>

<div>
    <h3>Mes matchs</h3>
</div>





<?php include '../template/footer.php'; ?>