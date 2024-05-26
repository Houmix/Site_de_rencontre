
<!DOCTYPE html>
<html>
    <head>
        

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">


        

        
        <?php  session_start(); ?>


        <title>Pet Match</title>

        
        <link rel="stylesheet" href="../css/style.css">    
        <link rel="stylesheet" href="../css/form.css">      
        <?php if (isset($custom_css)): ?>
            <link rel="stylesheet" type="text/css" href="<?= htmlspecialchars($custom_css) ?>">
        <?php endif; ?>


        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Pet Match</title>
        <?php endif; ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="icon" type="image/vnd.icon" href="pic/favicon.ico">
        
    </head>


    <body>
        
        <nav>
            <div class="containerNav">
                <div class="left image2" style="display:flex;">
                <?php
                    if (isset($_SESSION["user_id"])) {
                        echo "<p><a href='../feature/messages.php'><img src='../pic/messagerie.png' width='50px' height='50px'></a></p>";
                        
                    }
                ?>
                
                    
                </div>
    
                <div class="center">
                <?php
                    if (isset($_SESSION["user_id"])) {
                        echo "<a href='../user/home.php'><img src='../pic/logoSF.png' alt='Logo' width='auto' height='80px'></a>";
                    } else {
                        echo "<a href='../visitor/index.php'><img src='../pic/logoSF.png' alt='Logo' width='auto' height='80px'></a>";
                    }
                ?>
                   
                </div>
                <div class="right">
                    <a href="#" id="openBtn">
                        <span class="burger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                        </span>
                    </a>
                    <div id="mySidenav" class="sidenav">
                        <a id="closeBtn" href="#" class="close">×</a>
                        <ul>
                        <?php
                           
                            // Vérifier si l'utilisateur est connecté
                            
                            if (isset($_SESSION["user_id"])) {
                                // Afficher les liens spécifiques aux utilisateurs connectés
                                
                               echo "<li id='nav'><a href='../user/home.php'>Accueil</a></li>
                                    <li id='nav'><a href='../template/contact.php'>Contact</a></li>
                                    <li id='nav'><a href='../user/user_space.php'>Mon espace</a></li>
                                    <li id='nav'><a href='../user/form/logOut.php'>Déconnexion</a></li>";
                                
                            } else {
                                // Afficher les liens spécifiques aux utilisateurs non connectés
                                echo "<li id='nav'><a href='../visitor/index.php'>Accueil</a></li>
                                    <li id='nav'><a href='../template/contact.php'>Contact</a></li>
                                    <li id='nav'><a href='../visitor/login.php'>Connexion/Inscription</a></li>";
                                
                            }
                        ?>
                        </ul>
                
                    </div>
                </div>
            </div>
        </nav>
        <!--<div class="center">
            <p style="font-size: small;">&#x2714; 14 jours offerts</p>
        </div>-->

        <main>