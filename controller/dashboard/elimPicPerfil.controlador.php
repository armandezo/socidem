<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php'; 


$picture =  $_POST['pictures'];
 
$type_pic = $_POST['type_pic'];
 
 
$verPerfil = ejecutarSQL::consultar("SELECT `perfil`.*, `perfil`.`correo`
FROM `perfil`
WHERE `perfil`.`correo` = '$correo_';");
 

while($datos_elim_pic=mysqli_fetch_assoc($verPerfil)){

    $objPicPerfil=$datos_elim_pic[$type_pic];
    
    $PicPerfil_full = json_decode($objPicPerfil, true); 
    

    foreach ($PicPerfil_full as $key => $entry) { 

        if ($entry['pictures'] == $picture) { 

           unset($PicPerfil_full[$key]); 
           unlink("../../views/assets/images/perfil/".$picture);  
        } 

       
        
    } 
    
    
    $insertar_data = json_encode($PicPerfil_full, JSON_UNESCAPED_UNICODE);
     
    consultasSQL::UpdateSQL("perfil", "$type_pic='$insertar_data'", "correo='$correo_'");
  
}   