<?php 

$session_admin = $_SESSION["iniciarSesion"];
 
if($session_admin == "estable"){
    header("Location: adminDash-inicio",  TRUE, 301);  
    exit();
} 
 
 ?>