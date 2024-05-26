<?php include '../template/header.php'; ?>
<?php 

if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
}

    // Créer (ou ouvrir) une connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SELECT pour récupérer tous les abonnements
    $sql = "SELECT * FROM subscription";
    $stmt = $pdo->query($sql);

    // Récupérer tous les enregistrements sous forme de tableau associatif
    $subcriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
//catch (PDOException $e) {
    //echo "Erreur lors de la récupération des enregistrements : " . $e->getMessage();
//}

?>
<div class="container" id="cards" style="height: min-content; padding: 100px 0;">
    <div class="center"><h1>Offres que nous proposons :</h1></div>
    <br><br>
    <div class="block">
        <?php 
            if ($subcriptions) {
                foreach ($subcriptions as $subcription) {
                    echo "<div class='card'>
                            <h5>Abonnement mensuel".htmlspecialchars($subsiption['name'])."</h5>
                            <br>
                            <p>Description : ".htmlspecialchars($subcription['description'])."</p>
                            <p>Prix : ".htmlspecialchars($subcription['price'])."</p>
                            <p>Durée : ".htmlspecialchars($subcription['duration'])." jours</p>
                            <p>Like : ".htmlspecialchars($subcription['numer_like'])."</p>
                        </div>";
                }
            }
            else {
                echo "<div class='card'>
                    <p>aucun abonnement à proposer</p>
                    </div>";
            }
        ?>
    </div>
    
</div>
<div>
    <h3>Mofifier votre abonnement</h3>
    <?php //Récupère l'abonnement de l'utilisateur depuis a session
        echo "<p>Votre abonnement actuel : ".$_SESSION["subscription_name"]."</p>";
    ?>
    <p>Votre abonnement actuel :</p>
    <p>Modifier :</p>
    <form action="form/change_subF.php" method="POST">
        <label>Choisir</label>
        <select id="subscription" name="subscription">
            <?php 
                if ($subcriptions) {
                    foreach ($subcriptions as $subcription) {
                        if ($subcription['name'] != $_SESSION["subscription_name"]) {
                            echo "<option value='" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                        } else {
                            echo "<option value='" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "' disabled>" . htmlspecialchars($subcription['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                    }
                } else {
                    echo "<p>aucun abonnement actif</p>";
                }
            ?>
        </select>
        <button type="submit">Changer Abonnement</button>
    </form>
    
</div>
<?php include '../template/footer.php'; ?>