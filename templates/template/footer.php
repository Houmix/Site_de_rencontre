</main>
           
        <footer>
            <div class="container">
                <div class="center"><img src="../pic/logoSF.png" alt="Logo" width="auto" height="80px"></div>
                <div class="center">
                    <?php 
                        if (isset($_SESSION["user_id"])) {
                           echo "<a href='../user/home.php'>Accueil</a>";
                            
                        } else {
                            
                            echo "<a href='../user/index.php'>Accueil</a>";
                            
                        }
                    ?>
                    &nbsp;
                    <a href="../template/about_us.php" id="footer">A porpos de nous</a>
                    &nbsp;
                    <a href="../template/policy.php" id="footer">Nos politiques</a>
                    &nbsp;
                    <?php 
                    
                        if (!isset($_SESSION["user_id"])) {
                            echo "<a href='../template/offer.php' id='footer'>Nos offres</a>";
                             
                        }
                    ?>
                    &nbsp;
                    <a href="../template/contact.php" id="footer">Nous contacter</a>
                </div>
                <br>
                <div class="containerF network_pc">
                    <div class="left-text">Copyright &copy; 2024 PET MATCH Tous droits réservés.</div>
                    <div class="right-text">
                        <a class="right" href="#"><img src="../social_media/logo-insta-SF.png" width="35px" height="35px"></a>&nbsp;<a href="#"><img src="../social_media/logo-tiktok-SF.png" width="35px" height="35px"></a>&nbsp;<a href="#"><img src="../social_media/logo-x-SF.png" width="35px" height="31px"></a>
                    </div>
                </div>
                
                
            </div>
                    

        </footer>

        <script src="../js/sidenav.js"></script>
        
    </body>
        
</html>

