<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ../../user/user_space.php");
    exit();
}
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

    $connexion = new PDO('sqlite:../../DB/my_database.db');
    
    // Préparer la requête SQL pour sélectionner l'utilisateur par son email
    $requete = $connexion->prepare("SELECT * FROM user WHERE email = ?");
    $requete->execute([$email]);

    // Récupérer le résultat de la requête
    $resultat = $requete->fetch();
    

    if ($resultat) {
        
        // Vérifier si le mot de passe saisi correspond au mot de passe stocké
        if (password_verify($password, $resultat['password'])) {

            if ($resultat["blocked"]) {
                $_SESSION["blocked"] = "Compte bloqué";
                header("Location: ../login.php");
            }
            $_SESSION["dog_breed"] = $resultat["dog_breed"];
            $_SESSION["orientation"] = $resultat["orientation"];
            // Si les mots de passe correspondent, l'authentification est réussie
            $_SESSION["user_id"] = $resultat["id"];
            header("Location: ../../user/home.php");
            exit;
        } else {
            $_SESSION["wrong_passord"] = "Adresse e-mail ou mot de passe eronné.";
            header("Location: ../login.php");
            exit;
        }
    } else {
        
        $_SESSION["wrong_passord"] = "Adresse e-mail ou mot de passe eronné.";
        header("Location: ../login.php");
        exit;
    }

} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    header("Location: ../login.php");
    exit;
}


?>
