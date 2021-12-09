<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
//   header('Content-Type: application/json', true); 
// $_POST['id'];
$id = $_POST['id'];
$token = $codigo_referido_;

$verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$token'");

while($datos_agenda_medica=mysqli_fetch_assoc($verAgendaMedica)){

    $objAgenda=$datos_agenda_medica['agenda'];
    
    $agenda_full = json_decode($objAgenda, true); 
    

    foreach ($agenda_full as $key => $entry) { 

        if ($entry['id'] == $id) { 

           unset($agenda_full[$key]); 
            
        } 

       
        
    } 
    // $newJsonString = array_values($agenda_full);
            
   $valor = json_encode( $agenda_full );
   
   consultasSQL::UpdateSQL("agenda_medica", "agenda='$valor'", "cod_medico='$token'");
  
}   