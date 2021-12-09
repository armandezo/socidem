<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$token = $codigo_referido_;

echo "ok";
 

// $verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$token'");

//         while ($datos_agenda_medica = mysqli_fetch_assoc($verAgendaMedica)) {

//             $objAgenda = $datos_agenda_medica['agenda'];

//             $agenda_full = json_decode($objAgenda, true);
        
//             foreach ($agenda_full as $key => $entry) {
 
//                 if ($entry['dia'] == $dia_reset) {

//                         unset($agenda_full[$key]);
                   
//                 }
//             }

            
//         }
 
//          $insertar_data = json_encode($agenda_full, JSON_UNESCAPED_UNICODE);

//          consultasSQL::UpdateSQL("agenda_medica", "agenda='$insertar_data'", "cod_medico='$token'");
