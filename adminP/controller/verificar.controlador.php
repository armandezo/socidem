<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

$tipo = $_POST['tipo'];
$cod = $_POST['cod'];

 

$verMed = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `perfil`.`correo`, `medicos`.`id`
FROM `perfil`
	, `medicos`
WHERE `perfil`.`codigo_referido` = '$cod' AND `perfil`.`correo` = `medicos`.`correo`");

while($datos_med =mysqli_fetch_assoc($verMed)){
         
    $id_med=$datos_med['id']; 
    consultasSQL::UpdateSQL("medicos", "estado='$tipo' ", "id='$id_med'");
} 
 
