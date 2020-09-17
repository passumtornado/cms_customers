<?php 
session_start();
    
$_SESSION['username']= null;
$_SESSION['cID']= null;
session_destroy();

 header("location: index.php");

?>