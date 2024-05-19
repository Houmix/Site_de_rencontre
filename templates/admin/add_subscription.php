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
    <h1>Créer un abonnement</h1>
    <form action="add_subscriptionF.php" method="POST">
        <label>Nom:</label>
        <input type="text" name="name" required>
        
        <label>Description:</label>
        <textarea name="description" required></textarea>
        
        <label>Prix:</label>
        <input type="number" step="0.01" name="price" required>
        
        <label>Durée (en jours):</label>
        <input type="number" name="duration" required>
        
        <label>Nombre de likes limité:</label>
        <select name="limited_like" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select>
        
        <label>Nombre de likes:</label>
        <input type="number" name="number_like">
        
        <input type="submit" value="Créer">
    </form>
</body>
</html>
