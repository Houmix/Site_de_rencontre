<?php include '../template/header.php'; ?>

<?php 

    // Créer (ou ouvrir) une connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SELECT pour récupérer tous les abonnements
    $sql = "SELECT * FROM subscription";
    $stmt = $pdo->query($sql);

    // Récupérer tous les enregistrements sous forme de tableau associatif
    $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
//catch (PDOException $e) {
    //echo "Erreur lors de la récupération des enregistrements : " . $e->getMessage();
//}

?>

<div class="container" id="banner" style="height: 40vh; padding: 40px;">
    
    <div class="center" style="z-index: 1;"><h1>Site de rencontre</h1></div>
    <br>
    <br>
    <div class="center" style="z-index: 1;"><a href="#" id="buy">Tester/S'abonner</a><a href="#cards">En savoir +</a></div>
</div>

<div class="container" id="cards" style="height: min-content; padding: 100px 0;">
    <div class="center"><h1>Titre</h1></div>
    <br><br>
    <div class="block">
        <?php 
            if ($subscriptions) {
                foreach ($subscriptions as $subscription) {
                    echo "<div class='card'>
                            <h5>Abonnement mensuel".htmlspecialchars($subscription['name'])."</h5>
                            <br>
                            <p>Description : ".htmlspecialchars($subscription['description'])."</p>
                            <p>Prix : ".htmlspecialchars($subscription['price'])."</p>
                            <p>Durée : ".htmlspecialchars($subscription['duration'])." jours</p>
                            <p>Like : ".$subscription['number_like']."</p>
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
<div class="container">
    <div class="block">
        
            <div class="card">
                <p>presentation</p>
            </div>
            <div class="card">
                <p>presentation</p>
            </div>
            <div class="card">
                <p>presentation</p>
            </div>
    </div>
    
        
    </div>
</div>
<?php include '../template/footer.php'; ?>