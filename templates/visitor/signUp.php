<!-- index.php -->
<?php include '../template/header.php'; ?>
<h2>Inscription</h2><br>

            
<div class="form">
    <?php
    session_start();
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
<form action="form/signUpF.php" method="post">

    <label for="gender">Genre :</label><br>
    <select id="gender" name="gender">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
        <option value="Autre">Autre</option>

    </select><br>
    
    <label for="firstname">Prénom :</label><br>
    <input type="text" id="firstname" name="firstname" required><br>

    <label for="lastname">Nom :</label><br>
    <input type="text" id="lastname" name="lastname" required><br>

    <label for="phone">Numéro de telephone :</label><br>
    <input type="number" id="phone" name="phone" required><br>

    <label for="city">Ville :</label><br>
    <input type="text" id="city" name="city" required><br>

    <label for="birthday">Date de naissance :</label><br>
    <input type="date" id="birthday" name="birthday" required><br>

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

    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br>

    

    
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