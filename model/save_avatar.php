<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include 'consulSQL.php';
include 'sessiones.php';
 
$image_name = str_replace('.', '-avatar.', $_POST['image_name']); 

  
consultasSQL::UpdateSQL("perfil", "foto='$image_name'", "correo='$correo_'");

session_reset();  
$_SESSION["foto"] = $image_name;