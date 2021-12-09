<?php 

$session_admin = $_SESSION["iniciarSesion"];
 
if($session_admin != "estable"){
    header("Location: adminDash-login",  TRUE, 301);  
    exit();
} 
 
 ?>