<?php
session_start();
// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $gender = htmlspecialchars($_POST["gender"]);

    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);

    $phone = htmlspecialchars($_POST["phone"]);
    $city = htmlspecialchars($_POST["city"]);

    $orientation = htmlspecialchars($_POST["orientation"]);
    $bio = htmlspecialchars($_POST["bio"]);

    

    $connexion = new PDO('sqlite:../../DB/my_database.db');

    // Préparer la requête SQL pour sélectionner l'utilisateur par son email
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $requete->execute([$_SESSION["user_id"]]);

    // Récupérer le résultat de la requête
    $resultat = $requete->fetch();

    if ($resultat) {


        //Changer les infos avec les nouvelle
        // Préparer la requête de mise à jour
        $sql = "UPDATE user SET 
        gender = :gender,
        firstname = :firstname, 
        lastname = :lastname, 
        phone = :phone,
        city = :city,
        orientation = :orientatinon,
        bio = :bio
        WHERE id = :id";

        
        $stmt = $connexion->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam('gender', $gender);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam('city', $city);
        $stmt->bindParam('orientation', $orientation);
        $stmt->bindParam('bio', $bio);
        $stmt->bindParam(':id', $userId);

        // Exécuter la requête
        $stmt->execute();


        // Redirection vers le formulaire si e-mail déja utilisé par un utilisateur
        $_SESSION['success'] = "Mise à jour réussie";
        header("Location: ../user_space.php");
        exit;
    } else {
        // Erreur enregistrement dans la base de donnée
        $_SESSION['erreur_enregistrement'] = "Un problème est survenu lors du changement de vos infos";
        header("Location: ../edit_user_info.php");
        exit;
    }
} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    $_SESSION['erreur_envoi'] = "Un problème est survenu lors de l'envoi du formualire";
    header("Location: ../edit_user_info.php");
    exit;
}
?>