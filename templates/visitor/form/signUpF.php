<?php

if (isset($_SESSION['user_id'])) {
    header("Location: ../../user/user_space.php");
    exit();
}


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
    $dog_breed = htmlspecialchars($_POST["dog_breed"]);
    
    $emailClean = preg_replace('/[^a-zA-Z0-9]/', '_', $email);

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileNameCmps = explode(".", $_FILES['photo']['name']);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Nom de fichier basé sur l'email
        $newFileName = $emailClean . '.' . $fileExtension;

        // Répertoire de téléchargement
        $uploadFileDir = '../../pic/';
        $dest_path = $uploadFileDir . $newFileName;

        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $photo = $newFileName; // Nom du fichier sauvegardé
        } else {
            $_SESSION['erreur_photo'] = 'Il y a eu un problème avec le téléchargement du fichier.';
            header("Location: ../signUp.php");
            exit;
        }
    } else {
        $_SESSION['erreur_photo'] = 'Aucun fichier téléchargé ou erreur lors du téléchargement.';
        header("Location: ../signUp.php");
        exit;
    }

    $connexion = new PDO('sqlite:../../DB/my_database.db');

    // Préparer la requête SQL pour sélectionner l'utilisateur par son email
    $requete = $connexion->prepare("SELECT * FROM user WHERE email = ?");
    $requete->execute([$email]);

    // Récupérer le résultat de la requête
    $resultat = $requete->fetch();

    if ($resultat) {
        // Redirection vers le formulaire si e-mail déjà utilisé par un utilisateur
        $_SESSION['erreur_email'] = "L'adresse email est déjà utilisée. Veuillez en choisir une autre.";
        header("Location: ../signUp.php");
        exit;
    } else {
        // Préparer et exécuter la requête SQL pour insérer l'utilisateur dans la table `user`
        $requete = $connexion->prepare("INSERT INTO user (gender, firstname, lastname, email, password, phone, city, birthday, orientation, bio, dog_breed, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $resultat = $requete->execute([$gender, $firstname, $lastname, $email, $password, $phone, $city, $birthday, $orientation, $bio, $dog_breed, $photo]);

        if ($resultat) {
            // Envoyer email de confirmation
            $sujet = "Confirmation d'inscription.";
            $contenu = "Compte créé avec succès.";
            $headers = "Compte activé";
            if (mail($email, $sujet, $contenu, $headers)) {
                echo "Votre message a été envoyé avec succès.";
            } else {
                echo "Une erreur s'est produite lors de l'envoi du message.";
            }
            // Succès enregistrement dans la base de données
            $_SESSION['enregistrement_reussi'] = "Compte créé avec succès, connectez-vous.";
            header("Location: ../login.php");
            exit;
        } else {
            // Erreur enregistrement dans la base de données
            $_SESSION['erreur_enregistrement'] = "Un problème est survenu lors de la création de votre compte";
            header("Location: ../signUp.php");
            exit;
        }
    }
} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    $_SESSION['erreur_envoi'] = "Un problème est survenu lors de l'envoi du formulaire";
    header("Location: ../signUp.php");
    exit;
}

?>