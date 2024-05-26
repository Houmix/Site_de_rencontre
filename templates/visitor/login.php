<!-- index.php -->
<?php include '../template/header.php'; ?>

<?php
if (isset($_SESSION['user_id'])) {
    header("Location: ../user/user_space.php");
    exit();
}
if (isset($_SESSION['enregistrement_reussi'])) {
    echo "<p style='color: red;'>{$_SESSION['enregistrement_reussi']}</p>";
    unset($_SESSION["enregistrement_reussi"]);// Supprimer le message d'erreur de la session après l'avoir affiché
}
if (isset($_SESSION['wrong_passord'])) {
    echo "<p style='color: red;'>{$_SESSION['wrong_passord']}</p>";
    unset($_SESSION['wrong_passord']); // Supprimer le message d'erreur de la session après l'avoir affiché
}
if (isset($_SESSION['blocked'])) {
    echo "<p style='color: red;'>{$_SESSION['blocked']}</p>";
    unset($_SESSION['blocked']); // Supprimer le message d'erreur de la session après l'avoir affiché
}
?>

            
            <div class="form">
                <form action="form/loginF.php" method="post">
                    <label for="email">Nom d'utilisateur :</label><br>
                    <input type="email" id="email" name="email" required><br>
                    <label for="password">Mot de passe :</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                
        
                    

        
                    <a href="signUp.php">Créer un compte</a>
                    <input type="submit" value="Se connecter">
        
                </form>
                
            </div>

<?php include '../template/footer.php'; ?>