<?php 
    session_start();
    session_destroy();
    header("Location: ../../visitor/index.php");

?>