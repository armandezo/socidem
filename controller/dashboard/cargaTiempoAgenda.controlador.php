<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$token = $codigo_referido_;
  
$verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$token';");

while($datos_agenda_medica=mysqli_fetch_assoc($verAgendaMedica)){
    
    $objAgenda=$datos_agenda_medica['agenda']; 
    $agenda_full = json_decode($objAgenda, true);  


    foreach ($agenda_full as $key => $entry) {

        
         switch ($entry['tipo']) {
             case 'Presencial':
                $hora_presencial = $entry['time'];
                 break;
                 case 'Online':
                $hora_online = $entry['time'];
                    break;
             
         }
            

      
 
    }
    $busca_horario = array(
        'horaonline' =>  $hora_online,
        'horapresencial' =>  $hora_presencial 
    );
 
    echo json_encode($busca_horario) ;
    
}