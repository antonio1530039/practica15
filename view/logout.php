<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

unset($_SESSION['login']);
unset($_SESSION['user_info']);

session_destroy();

header("location:index.php");
?>

