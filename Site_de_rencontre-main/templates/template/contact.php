
<?php include 'header.php'; ?>
    <div class="form">
        <form action="form/contactF.php" method="post">
            <label for="nom">Nom :</label><br>
            <input type="text" id="nom" name="nom" required><br>
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required><br>
            <label for="message">Message :</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br><br>
            <input type="submit" value="Envoyer">
        </form>
    </div>
<?php include 'footer.php'; ?>