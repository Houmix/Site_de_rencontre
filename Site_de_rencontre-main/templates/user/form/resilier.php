<?php 
session_start();

    $connexion = new PDO('sqlite:../../DB/my_database.db');
    $request = $connexion->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $request->execute($_SESSION["user_id"]);
    $response = $request->fetch();
    if($response) {
        //requete pour enregistrer l'utilisateur sans abonnement
        $sql = "UPDATE user SET subscription = '' WHERE id = ?";
        $req = $connexion->prepare($sql);
        $req->execute($_SESSION["user_id"]);
        $response = $req->fetchAll();
        if($response) {
            // Préparer la requête de suppression de l'abonnement de l'utilisateur
            $sql = "DELETE FROM user_subscription WHERE user_id = ?";
            $req = $connexion->prepare($sql);
            $req->execute($_SESSION["user_id"]);
            $response = $req->fetchAll();
            if($response) {
                $_SESSION["resiliation_succed"] = "Résiliation réussi";
                header("Location: ../user_space.php");
            } else {
                $_SESSION["resiliation_error"] = "Résiliation non enregistré dans la base de donnée u-s";
                header("Location: ../user_space.php");
            }
        } else {
            $_SESSION["resiliation_error2"] = "Résiliation non enregistré dans la base de donnée u";
            header("Location: ../user_space.php");
        }
    } else {
        $_SESSION["user_not_found"] = "Utilisateur non trouvé dans la base de donnée";
        header("Location: ../user_space.php");
    }
?>