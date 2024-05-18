<!-- index.php -->
<?php include '../template/header.php'; ?>
<h2>Modification de mes infos</h2><br>

            
<div class="form">
    <?php
    session_start();

if (isset($_SESSION['erreur_envoi'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_envoi']}</p>";
    unset($_SESSION["erreur_envoi"]);
}
if (isset($_SESSION['erreur_enregistrement'])) {
    echo "<p style='color: red;'>{$_SESSION['erreur_enregistrement']}</p>";
    unset($_SESSION["erreur_enregistrement"]);
}


?>
<form action="form/edit_user_infoF.php" method="post">

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

    <a href="user_space.php">Retour</a>
    <input type="submit" value="Enregistrer">

    </form>
    
</div>


<?php include '../template/footer.php'; ?>