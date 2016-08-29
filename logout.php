<?php

//if(!isset($_SESSION['user_name'])){
//    header("Location: index.php");
//} 

if (isset($_GET['logout'])){
    $_SESSION['user_name'] = null;
    
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}


?>