<?php 
 
$perfil = $_SESSION["perfil"];
 
if(!isset($perfil)){
    header("Location: inicio"); 
}
 
 ?>