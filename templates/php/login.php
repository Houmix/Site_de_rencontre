<?php
// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    // Vérifier les informations de connexion
    // Rechercher dans la base de donnée l'utilisateur en question puis verifier le mdp
    $username_valide = "utilisateur";
    $password_valide = "motdepasse";

    if ($username == $username_valide && $password == $password_valide) {
        // Connexion réussie, rediriger vers une page de succès
        header("Location: ../home.php");
        exit;
    } else {
        // Identifiants incorrects, afficher un message d'erreur
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    header("Location: ../login.php");
    exit;
}
?>
