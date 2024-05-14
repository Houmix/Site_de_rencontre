
<!DOCTYPE html>
<html>
    <head>
        

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- Icône pour les navigateurs -->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- Icône pour les appareils Apple -->
        <link rel="apple-touch-icon" sizes="180x180" href="pic/favicon/apple-touch-icon.png">
        <!-- Icône pour les navigateurs Chrome sur Android -->
        <link rel="icon" type="image/png" sizes="192x192" href="pic/favicon/android-chrome-192x192.png">
        <!-- Icône pour les navigateurs Safari sur iOS -->
        <link rel="apple-touch-icon" sizes="152x152" href="pic/favicon/apple-touch-icon.png">
        <!-- Icône pour les navigateurs Windows -->
        <meta name="msapplication-TileImage" content="favicon-32x32.png">
        <meta name="msapplication-TileColor" content="#ffffff">
        <title>Site de rencontre</title>

        
        <link rel="stylesheet" href="css/styles.css">      

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="icon" type="image/vnd.icon" href="pic/favicon.ico">
        
    </head>


    <body>
        
        <nav>
            <div class="containerNav">
                <div class="left image2" style="display:flex;">
                    <p>ici</p>
                </div>
    
                <div class="center">
                    <a href="#"><img src="pic/logo/logocompletSF.png" alt="Logo" width="auto" height="80px"></a>
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
                            <li id="nav"><a href="#">Accueil</a></li>
                            <li id="nav"><a href="offres.php">Offres</a></li>
                            <li id="nav"><a href="contact.html">Contact</a></li>
                            <li id="nav"><a href="#">Mon espace</a></li>
            
                        </ul>
                
                    </div>
                </div>
            </div>
        </nav>
        <div class="center">
            <p style="font-size: small;">&#x2714; 14 jours offerts</p>
        </div>

        <main>
                <div class="container" id="banner" style="height: 40vh; padding: 40px;">
                    
                    <div class="center" style="z-index: 1;"><h1>Gros titre</h1></div>
                    <br>
                    <br>
                    <div class="center" style="z-index: 1;"><a href="#" id="buy">Découvrir/S'abonner</a><a href="#cards">En savoir +</a></div>
                </div>

                <div class="container" id="cards" style="height: min-content; padding: 100px 0;">
                    <div class="center"><h1>Titre</h1></div>
                    <br><br>
                    <div class="block">
                        <div class="card">
                            <h5>Argsl</h5>
                            <br>
                            <p>text arg</p>
                        </div>
                        <div class="card">
                            <h5>Argsl</h5>
                            <br>
                            <p>text arg</p>
                        </div>
                        <div class="card">
                            <h5>Argsl</h5>
                            <br>
                            <p>text arg</p>
                        </div>
                        <div class="card">
                            <h5>Argsl</h5>
                            <br>
                            <p>text arg</p>
                        </div>
                    </div>
                    
                </div>
                <div class="container">
                    <div class="block">
                        
                            <div class="card">
                                <p>presentation</p>
                            </div>
                            <div class="card">
                                <p>presentation</p>
                            </div>
                            <div class="card">
                                <p>presentation</p>
                            </div>
                    </div>
                    
                        
                    </div>
                </div>
        </main>
           
        <footer>
            <div class="container">
                <div class="center"><img src="pic/logo/logocompletSF.png" alt="Logo" width="auto" height="80px"></div>
                <div class="center">
                    <a href="#" id="footer">Acceuil</a>
                    &nbsp;
                    <a href="#" id="footer">A porpos de nous</a>
                    &nbsp;
                    <a href="#" id="footer">Nos produits</a>
                    &nbsp;
                    <a href="#" id="footer">Nous contacter</a>
                </div>
                <br>
                <div class="containerF network_pc">
                    <div class="left-text">Copyright &copy; 2024 XXXXX Tous droits réservés.</div>
                    <div class="right-text">
                        <a class="right" href="#"><img src="pic/social_media/logo-insta-SF.png" width="35px" height="35px"></a>&nbsp;<a href="#"><img src="pic/social_media/logo-tiktok-SF.png" width="35px" height="35px"></a>&nbsp;<a href="#"><img src="pic/social_media/logo-x-SF.png" width="35px" height="31px"></a>
                    </div>
                </div>
                
                
            </div>
                    

        </footer>

        <script src="{% static 'js/sidenav.js' %}"></script>
        
    </body>
        
</html>