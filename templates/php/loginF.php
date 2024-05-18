<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Récupérer les données du formulaire
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Vérifier les informations de connexion
    // Rechercher dans la base de donnée l'utilisateur en question puis verifier le mdp

    $connexion = new PDO('sqlite:DB/my_database.db');
    
    // Préparer la requête SQL pour sélectionner l'utilisateur par son email
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);

    // Récupérer le résultat de la requête
    $resultat = $requete->fetch();
    

    if ($resultat) {
        
        // Vérifier si le mot de passe saisi correspond au mot de passe stocké
        if (password_verify($password, $resultat['password'])) {
            
            // Si les mots de passe correspondent, l'authentification est réussie
            $_SESSION["user_id"] = $resultat["id"];
            header("Location: ../signUp.php");
            exit;
        } else {
            header("Location: ../home.php");
            exit;
        }
    } else {
        
        $_SESSION["wrong_passord"] = "Adresse e-mail ou mot de passe eronné.";
        header("Location: ../index.php");
        exit;
    }

} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    header("Location: ../login.php");
    exit;
}


?>
