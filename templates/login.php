<!-- index.php -->
<?php include 'php/header.php'; ?>

<?php
session_start();
if (isset($_SESSION['enregistrement_reussi'])) {
    echo "<p style='color: red;'>{$_SESSION['enregistrement_reussi']}</p>";
    unset($_SESSION["enregistrement_reussi"]);// Supprimer le message d'erreur de la session après l'avoir affiché
}
if (isset($_SESSION['wrong_passord'])) {
    echo "<p style='color: red;'>{$_SESSION['wrong_passord']}</p>";
    unset($_SESSION['wrong_passord']); // Supprimer le message d'erreur de la session après l'avoir affiché
}
?>
            
            <div class="form">
                <form action="php/loginF.php" method="post">
                    <label for="email">Nom d'utilisateur :</label><br>
                    <input type="email" id="email" name="email" required><br>
                    <label for="password">Mot de passe :</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                
        
                    <a href="forgotten_password.php">Mot de passe oublié ?</a>
                    <br>
        
                    <a href="signUp.php">Créer un compte</a>
                    <input type="submit" value="Se connecter">
        
                </form>
                
            </div>

<?php include 'php/footer.php'; ?>