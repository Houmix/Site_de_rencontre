<?php include '../template/header.php'; ?>
<?php
try {
    $userId = $_GET['id'];

    // Connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SELECT pour récupérer tous les utilisateurs
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $response = $stmt->fetch(PDO::FETCH_ASSOC);





} catch (Exception $e) {
    echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}

?>

<link rel="stylesheet" href="../css/user_space.css"></link>

<div class="my_infos"> 
    <div class="center">
        <img src="../pic/<?php echo $response['photo']; ?>" width="100px" height="100px">
    </div>
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
                $dateOfBirth = $response['birthday'];
            
                // Vérifier que la date de naissance n'est pas null et créer un objet DateTime
                if (!is_null($dateOfBirth)) {
                    $birthdate = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
                    if ($birthdate) {
                        // Obtenir la date actuelle
                        $currentDate = new DateTime();
                        // Calculer la différence entre la date actuelle et la date de naissance
                        $age = $currentDate->diff($birthdate)->y;
                        echo "L'âge de l'utilisateur est: " . $age . " ans.<br>";
                    } else {
                        echo "Format de date de naissance invalide pour l'utilisateur ID: " . $user['id'] . "<br>";
                    }
                } else {
                    echo "Date de naissance manquante pour l'utilisateur ID: " . $user['id'] . "<br>";
                }
                echo $age; 
            ?>
        </p>
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
        <p class="type" >Race de l'animal :</p>
        <p class="value"><?php echo $response['dog_breed']; ?></p>
    </div>
    <div class="infos">
        <p class="type" >Bio :</p>
        <p class="value"><?php echo $response['bio']; ?></p>
    </div>

    <a href="../user/home.php">Retour</a>
    <a href='../feature/like.php?id=<?php echo $response['id']; ?>' class='add-to-cart left-text' id='like'>Liker</a>
    

</div>