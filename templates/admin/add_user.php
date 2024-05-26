<?php include '../template/header.php';$title="Admin - Créer utilisateur";
$custom_css = "../css/user.css"; 
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
} else {
    //Connexion base de donnée
    $pdo = new PDO('sqlite:../DB/my_database.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Enregistrement de la requête sql
    $request = $pdo->prepare('SELECT * FROM user WHERE id = ?');
    //Execution de la requête
    $request->execute([$_SESSION["user_id"]]);
    //Créer un tableau avec les reponses
    $response = $request->fetchAll(PDO::FETCH_ASSOC);
    
    if ($response) {
        // Accéder à la première ligne du tableau $response
        $firstRow = $response[0];
        // Vérifier si l'utilisateur est administrateur
        if (!$firstRow["is_admin"]) {
            header("Location: ../user/user_space.php");
            exit();
        }
    } else {
        echo "Utilisateur non trouvé.";
        
    }
}

?>


    <h1>Créer un utilisateur</h1>
    <div class="form">
        <form action="add_userF.php" method="POST">
            <label>Genre:</label>
            <select name="gender" required>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
                <option value="other">Autre</option>
            </select>
            
            <label>Prénom:</label>
            <input type="text" name="firstname" required>
            
            <label>Nom:</label>
            <input type="text" name="lastname" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Mot de passe:</label>
            <input type="password" name="password" required>
            
            <label>Téléphone:</label>
            <input type="text" name="phone" required>
            
            <label>Ville:</label>
            <input type="text" name="city" required>
            
            <label>Date de naissance:</label>
            <input type="date" name="birthday" required>
            
            <label for="orientation">Orientation :</label><br>
            <select id="orientation" name="orientation" required>
                <option value="heterosexuel">Hétérosexuel(le)</option>
                <option value="homosexuel">Homosexuel(le)</option>
                <option value="bisexuel">Bisexuel(le)</option>
                <option value="pansexuel">Pansexuel(le)</option>
                <option value="asexuel">Asexuel(le)</option>
                <option value="autre">Autre</option>
            </select>
            <label for="dog_breed">Animal :</label><br>
            <select id="dog_breed" name="dog_breed" required>
                <option value="Chien">Chien</option>
                <option value="Chat">Chat</option>
                <option value="Poisson">Poisson</option>
                <option value="Hamstere">Hamstere</option>
                <option value="Oiseau">Oiseau</option>
                <option value="Serpent">Serpent</option>
                <option value="Araigné">Araigné</option>
            </select>
                
            <label>Bio:</label>
            <textarea name="bio"></textarea>
            
            <input type="submit" value="Créer">
        </form>

    </div>
    
    
    <?php include '../template/footer.php'; ?>
