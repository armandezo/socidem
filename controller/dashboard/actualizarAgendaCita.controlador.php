<?php
session_start();
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
// header("Content-Type: application/json", true);
 
$cod_consulta= $_POST['cod_consulta'];
$cod_med= $_POST['cod_med'];
$id_cod_agenda = $_POST['id']; 
 
$verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$cod_med';");

while($datos_agenda_medica=mysqli_fetch_assoc($verAgendaMedica)){
    
    $objAgenda=$datos_agenda_medica['agenda'];
     
    $agenda_full = json_decode($objAgenda, true); 
     

    foreach ($agenda_full as $key => $entry) {
        
       
        if ($entry['id'] == $id_cod_agenda) {
            // $data[$key]['title'] = "TENNIS";
            $agenda_full[$key]['extendedProps']['status']="agendado";
            $fecha_inicio = $entry['start'];
            $fecha_end = $entry['end'];
            $agenda_full[$key]['extendedProps']['status'];
            $newJsonString = json_encode($agenda_full, JSON_UNESCAPED_UNICODE);
            
            consultasSQL::UpdateSQL("agenda", "fecha_start='$fecha_inicio' , fecha_end='$fecha_end' , estado='3' ", "cod_consulta='$cod_consulta'");

        }

    } 
}    
    
    consultasSQL::UpdateSQL("agenda_medica", "agenda='$newJsonString'", "cod_medico='$cod_med'");
  
    echo "Re Agendado";