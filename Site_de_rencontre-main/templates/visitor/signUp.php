<!-- index.php -->
<?php include '../template/header.php'; ?>
<h2>Inscription</h2><br>

            
<div class="form">
    <?php
if (isset($_SESSION['erreur_email'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_email']}</p>";
    unset($_SESSION['erreur_email']); // Supprimer le message d'erreur de la session après l'avoir affiché
}

if (isset($_SESSION['erreur_envoi'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_envoi']}</p>";
    unset($_SESSION["erreur_envoi"]);
}
if (isset($_SESSION['erreur_enregistrement'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_enregistrement']}</p>";
    unset($_SESSION["erreur_enregistrement"]);
}

if (isset($_SESSION['enregistrement_reussi'])) {
    echo "<p style='color: red;'>{$_SESSION['enregistrement_reussi']}</p>";
    unset($_SESSION["enregistrement_reussi"]);
}
?>
<div class="form">


    <form action="form/signUpF.php" method="post">
        <label for="photo">Charger une photo :</label>
        <input type="file" name="photo"><br>

        <label for="gender">Genre :</label><br>
        <select id="gender" name="gender">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autre">Autre</option>

        </select><br>
        
        <label for="firstname">Prénom :</label><br>
        <input type="text" id="firstname" name="firstname"><br>

        <label for="lastname">Nom :</label><br>
        <input type="text" id="lastname" name="lastname"><br>

        <label for="phone">Numéro de telephone :</label><br>
        <input type="number" id="phone" name="phone"><br>

        <label for="city">Ville :</label><br>
        <input type="text" id="city" name="city"><br>

        <label for="birthday">Date de naissance :</label><br>
        <input type="date" id="birthday" name="birthday"><br>

        <label for="orientation">Orientation :</label><br>
        <select id="orientation" name="orientation">
            <option value="heterosexuel">Hétérosexuel(le)</option>
            <option value="homosexuel">Homosexuel(le)</option>
            <option value="bisexuel">Bisexuel(le)</option>
            <option value="pansexuel">Pansexuel(le)</option>
            <option value="asexuel">Asexuel(le)</option>
            <option value="autre">Autre</option>
        </select><br>

        <label for="dog_breed">Race de l'animal :</label><br>
        <select id="dog_breed" name="dog_breed">
            <option value="Akita">Akita</option>
            <option value="Afghan Hound">Afghan Hound</option>
            <option value="Alaskan Klee Kai">Alaskan Klee Kai</option>
            <option value="American Hairless Terrier">American Hairless Terrier</option>
            <option value="American Foxhounds">American Foxhounds</option>
        </select><br>

        <label for="bio">Biographie</label><br>
        <input type="textarea" id="bio" name="bio"><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email"><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password"><br>

        

        
    <!-- 

        Ajoutez autant de cases à cocher que nécessaire

        <label for="hobbies">Centre d'interet</label>
        <fieldset>
            <legend>Centre d'interet :</legend>
            <input type="checkbox" id="preference1" name="preferences[]" value="preference1">
            <label for="preference1">Préférence 1</label><br>
            <input type="checkbox" id="preference2" name="preferences[]" value="preference2">
            <label for="preference2">Préférence 2</label><br>
            <input type="checkbox" id="preference3" name="preferences[]" value="preference3">
            <label for="preference3">Préférence 3</label><br>
            <input type="checkbox" id="preference4" name="preferences[]" value="preference4">
            <label for="preference3">Préférence 4</label><br>
            <input type="checkbox" id="preference5" name="preferences[]" value="preference5">
            <label for="preference3">Préférence 5</label><br>
            <input type="checkbox" id="preference6" name="preferences[]" value="preference6">
            <label for="preference3">Préférence 6</label><br>
            
        </fieldset>
        <br>-->
        
        <a href="login.php">Retour</a>
        <input type="submit" value="S'inscrire">

    </form>
    
</div>


<?php include '../template/footer.php'; ?>