<!-- index.php -->
<?php include 'php/header.php'; ?>
            
<div class="form">
    <h2>Inscription</h2>
<form action="inscription.php" method="post">
    <label for="username">Nom d'utilisateur :</label><br>
    <input type="text" id="username" name="username" required><br>
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>
    
    <a href="{% url 'Login' %}">Retour</a>
    <input type="submit" value="S'inscrire">

    </form>
    
</div>


<?php include 'php/footer.php'; ?>