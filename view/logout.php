<?php
//se verifica que si la sesion no esta iniciada
if(!isset($_SESSION)) 
{ 
	//se inicia la sesion
    session_start(); 
} 

unset($_SESSION['login']);
unset($_SESSION['user_info']);

//destruir sesion
session_destroy();

header("location:index.php");
?>

