<?php
session_start();
// Vérifier si des données ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    // Adresse e-mail de réception
    $destinataire = "XXXXX@XXXXXX.com";

    // Sujet du message
    $sujet = "Nouveau message de contact de $nom";

    // Contenu du message
    $contenu = "Nom: $nom\n";
    $contenu .= "Email: $email\n";
    $contenu .= "Message:\n$message";

    // En-têtes du mail
    $headers = "From: $nom <$email>";

    // Envoyer le message par e-mail
    if (mail($destinataire, $sujet, $contenu, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi du message.";
    }
} else {
    // Redirection vers le formulaire si les données n'ont pas été soumises par POST
    header("Location: contact.php");
    exit;
}
?>
