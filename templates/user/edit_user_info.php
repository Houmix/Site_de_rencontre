<!-- index.php -->
<?php include '../template/header.php'; 
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../visitor/login.php");
        exit();
    }?>
<h2>Modification de mes infos</h2><br>

            
<div class="form">
    <?php
    

if (isset($_SESSION['erreur_envoi'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_envoi']}</p>";
    unset($_SESSION["erreur_envoi"]);
}
if (isset($_SESSION['erreur_enregistrement'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_enregistrement']}</p>";
    unset($_SESSION["erreur_enregistrement"]);
}
if (isset($_SESSION['erreur_photo'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_photo']}</p>";
    unset($_SESSION["erreur_photo"]);
}


?>
</div>

<div class="form">
    <form action="form/edit_user_infoF.php" method="post">
        
        <label for="photo">Charger une photo :</label>
        <input type="file" name="photo"><br>

        <label for="gender">Genre :</label>
        <select id="gender" name="gender">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autre">Autre</option>

        </select>

        <label for="firstname">Prénom :</label><br>
        <input type="text" id="firstname" name="firstname" required value=""><br>

        <label for="lastname">Nom :</label><br>
        <input type="text" id="lastname" name="lastname" required value=""><br>

        <label for="phone">Numéro de telephone :</label>
        <input type="number" id="phone" name="phone" required value="">

        <label for="city">Ville :</label>
        <input type="text" id="city" name="city" required>

        <label for="orientation">Orientation :</label><br>
        <select id="orientation" name="orientation" required>
            <option value="heterosexuel">Hétérosexuel(le)</option>
            <option value="homosexuel">Homosexuel(le)</option>
            <option value="bisexuel">Bisexuel(le)</option>
            <option value="pansexuel">Pansexuel(le)</option>
            <option value="asexuel">Asexuel(le)</option>
            <option value="autre">Autre</option>
        </select><br>

        <label for="bio">Biographie</label><br>
        <input type="textarea" id="bio" name="bio"><br>

        <label for="dog_breed">Animal :</label><br>
        <select id="dog_breed" name="dog_breed" required>
            <option value="Chien">Chien</option>
            <option value="Chat">Chat</option>
            <option value="Poisson">Poisson</option>
            <option value="Hamstere">Hamstere</option>
            <option value="Oiseau">Oiseau</option>
            <option value="Serpent">Serpent</option>
            <option value="Araigné">Araigné</option></select><br>
        <a href="user_space.php">Retour</a>
        <input type="submit" value="Enregistrer">

    </form>
        
</div>


<?php include '../template/footer.php'; ?>