<!-- index.php -->
<?php include 'php/header.php'; ?>
            
            <div class="form">
                <form action="login.php" method="post">
                    <label for="username">Nom d'utilisateur :</label><br>
                    <input type="text" id="username" name="username" required><br>
                    <label for="password">Mot de passe :</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                
        
                    <a href="forgotten_password.php">Mot de passe oublié ?</a>
                    <br>
        
                    <a href="signUp.php">Créer un compte</a>
                    <input type="submit" value="Se connecter">
        
                </form>
                
            </div>

<?php include 'php/footer.php'; ?>