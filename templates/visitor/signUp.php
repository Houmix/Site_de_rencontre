<?php include '../template/header.php'; 
if (isset($_SESSION['user_id'])) {
    header("Location: ../user/user_space.php");
    exit();
} ?>
<h2>Inscription</h2><br>

<div class="form">
    <?php
    if (isset($_SESSION['erreur_photo'])) {
        echo "<p style='color: red;'>{$_SESSION['erreur_photo']}</p>";
        unset($_SESSION['erreur_photo']); // Supprimer le message d'erreur de la session après l'avoir affiché
    }
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
        echo "<p style='color: green;'>{$_SESSION['enregistrement_reussi']}</p>";
        unset($_SESSION["enregistrement_reussi"]);
    }
    ?>
    <div class="form">
        <form action="form/signUpF.php" method="post" enctype="multipart/form-data">
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

            <label for="phone">Numéro de téléphone :</label><br>
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

            <label for="dog_breed">Animal :</label><br>
            <select id="dog_breed" name="dog_breed">
                <option value="Chien">Chien</option>
                <option value="Chat">Chat</option>
                <option value="Poisson">Poisson</option>
                <option value="Hamster">Hamster</option>
                <option value="Oiseau">Oiseau</option>
                <option value="Serpent">Serpent</option>
                <option value="Araignée">Araignée</option>
            </select><br>

            <label for="bio">Biographie</label><br>
            <textarea id="bio" name="bio"></textarea><br>

            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email"><br>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password"><br>

            <a href="login.php">Retour</a>
            <input type="submit" value="S'inscrire">
        </form>
    </div>
</div>

<?php include '../template/footer.php'; ?>