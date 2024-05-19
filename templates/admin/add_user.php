<?php include '../template/header.php' ?>

<style>
        form {
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 8px;
        }
    </style>
    <h1>Créer un utilisateur</h1>
    
    <form action="add_userF.php" method="POST">
        <label>Genre:</label>
        <select name="gender" required>
            <option value="male">Homme</option>
            <option value="female">Femme</option>
            <option value="other">Autre</option>
        </select>
        
        <label>Prénom:</label>
        <input type="text" name="firstname" required>
        
        <label>Nom:</label>
        <input type="text" name="lastname" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Mot de passe:</label>
        <input type="password" name="password" required>
        
        <label>Téléphone:</label>
        <input type="text" name="phone" required>
        
        <label>Ville:</label>
        <input type="text" name="city" required>
        
        <label>Date de naissance:</label>
        <input type="date" name="birthday" required>
        
        <label for="orientation">Orientation :</label><br>
        <select id="orientation" name="orientation" required>
            <option value="heterosexuel">Hétérosexuel(le)</option>
            <option value="homosexuel">Homosexuel(le)</option>
            <option value="bisexuel">Bisexuel(le)</option>
            <option value="pansexuel">Pansexuel(le)</option>
            <option value="asexuel">Asexuel(le)</option>
            <option value="autre">Autre</option>
        </select>
        
        <label>Bio:</label>
        <textarea name="bio"></textarea>
        
        <input type="submit" value="Créer">
    </form>
</body>
</html>