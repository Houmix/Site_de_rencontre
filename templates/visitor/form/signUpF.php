<?php
// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $gender = htmlspecialchars($_POST["gender"]);

    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);

    $phone = htmlspecialchars($_POST["phone"]);
    $city = htmlspecialchars($_POST["city"]);

    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Crypter le mot de passe

    $orientation = htmlspecialchars($_POST["orientation"]);
    $bio = htmlspecialchars($_POST["bio"]);
    $birthday = htmlspecialchars($_POST["birthday"]);
    
    

    $connexion = new PDO('sqlite:../../DB/my_database.db');

    // Préparer la requête SQL pour sélectionner l'utilisateur par son email
    $requete = $connexion->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $requete->execute([$email]);

    // Récupérer le résultat de la requête
    $resultat = $requete->fetch();

    if ($resultat) {
        // Redirection vers le formulaire si e-mail déja utilisé par un utilisateur
        $_SESSION['erreur_email'] = "L'adresse email est déjà utilisée. Veuillez en choisir une autre.";
        header("Location: ../signUp.php");
        exit;
    } else {

        // Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la table `utilisateurs`
        $requete = $connexion->prepare("INSERT INTO utilisateurs (gender, firstname, lastname, email, password, phone, city, birthday, orientation, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $resultat = $requete->execute([$gender, $firstname, $lastname, $email, $password, $phone, $city, $birthday, $orientation, $bio]);

        if ($resultat) {

            // Envoyer email de confirmation
            $sujet = "Confirmation d'inscription.";
            $contenu = "Compte crée avec succès.";
            $headers = "Compte activé";
            if (mail($email, $sujet, $contenu, $headers)) {
                echo "Votre message a été envoyé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de l'envoi du message.";
            }
            // Erreur enregistrement dans la base de donnée
            $_SESSION['enregistrement_reussi'] = "Compte crée avec succès, connectez-vous.";
            header("Location: ../login.php");
            exit;
        } else {
            // Erreur enregistrement dans la base de donnée
            $_SESSION['erreur_enregistrement'] = "Un problème est survenu lors de la création de votre compte";
            header("Location: ../signUp.php");
            exit;
        }

    }
} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    $_SESSION['erreur_envoi'] = "Un problème est survenu lors de l'envoi du formualire";
    header("Location: ../signUp.php");
    exit;
}
?>