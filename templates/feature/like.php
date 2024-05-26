<?php include '../template/header.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: ../visitor/login.php");
    exit();
}
try {
    // Connexion à la base de données SQLite
    $pdo = new PDO('sqlite:../DB/my_database.db');
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM like WHERE user_id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["user_id"]]);
    $like = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT * FROM user_subscription WHERE user_id = ? ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION["user_id"]]);
    $sub = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sub) {
        $_SESSION["no_subscription"] = "Vous n'avez d'abonnement actif, gérer votre abonnement <a href='subscribe.php'>ici</a>";
            header("Lociation: ../user/home.php");
            exit;
    }

    if ($like) {
        //verifier son nombre de like avant de valider le like
        if ($like["number_like"] > 0) {
            $target_userId = $_GET['id'];
    

            // Requête SELECT pour inserer un match
            $sql = "INSERT INTO pre_match (user1_id,user2_id) VALUE ?, ? ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$_SESSION["user_id"],$target_userId]);
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($response) {
                $remaining_like = $like["number_like"] - 1;
                // Requête SELECT pour inserer un match
                $sql = "INSERT INTO like (user_id,number_like) VALUE ?, ? ";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$_SESSION["user_id"],$remaining_like]);
                $response = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($response) {

                    //chercher si c'est un match ou non
                    $sql = "SELECT COUNT(*) FROM pre_match WHERE user_id1 = ? AND user_id2 = ?";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$target_userId, $_SESSION["user_id"]]);
                    $match = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($match) {
                        // Requête SELECT pour inserer un match
                        $sql = "INSERT INTO match (user1_id,user2_id) VALUE ?, ? ";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$_SESSION["user_id"],$target_userId]);
                        //$response = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        $sql = "DELETE FROM pre_match WHERE (user_id1 = ? AND user_id2 = ?) OR (user_id1 = ? AND user_id2 = ?)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$target_userId, $_SESSION["user_id"], $_SESSION["user_id"], $target_userId]);
                        //$response = $stmt->fetch(PDO::FETCH_ASSOC);
                    }

                    // Enregistrement du like et des likes réussi dans la base de donnée
                    $_SESSION['like_valide'] = "Like validé";
                    header("Location: ../user/home.php");
                } else {
                    // Enregistrement non réussi des nombres la base de donnée
                    $_SESSION['erreur_like_update'] = "Like non mise a jour validé";
                    header("Location: ../user/home.php");
                }
                exit();
            } else {
                $_SESSION["erreur_like"] = "Like non validé";
                header("Location: ../user/home.php");
                exit();
            }
        } else {
            $_SESSION["not_enough_like"] = "Vous n'avez plus de like disponible, changez votre abonnement <a href='change_subscription.php'>ici</a>";
            header("Lociation: ../user/home.php");
            exit;
        }
    } else {
        $_SESSION["erreur_sql_like"] = "Nombre de like introuvable";
        header("Location: ../user/home.php");
        exit();
    }
    




    





} catch (Exception $e) {
    echo "Erreur lors de la récupération des utilisateurs : " . $e->getMessage();
}

?>