<?php

//if(!isset($_SESSION['user_name'])){
//    header("Location: index.php");
//} 

//if (isset($_GET['logout'])){
    
    session_start();
    $_SESSION['user_name'] = null;
    session_destroy();
    header("Location: index.php");
    exit;



?>