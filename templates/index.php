<?php include 'php/header.php'; ?>

<?php 
try {
    // Créer (ou ouvrir) une connexion à la base de données SQLite
    $pdo = new PDO('sqlite:php/DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SELECT pour récupérer tous les abonnements
    $sql = "SELECT * FROM subscription";
    $stmt = $pdo->query($sql);

    // Récupérer tous les enregistrements sous forme de tableau associatif
    $subcriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} //catch (PDOException $e) {
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
<?php include 'php/footer.php'; ?>