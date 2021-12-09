<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
 
$id_cod_medico = $_POST['cod_med'];
$id_cod_consulta = $_POST['cod_consulta'];
 
$verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$id_cod_medico';");

while($datos_agenda_medica=mysqli_fetch_assoc($verAgendaMedica)){
    
    $objAgenda=$datos_agenda_medica['agenda'];
    
     
    $agenda_full = json_decode($objAgenda, true); 
     
    
    
}    
 
 
     foreach ($agenda_full as $key => $value) {
         
    $fecha_start = $value['start'];
    $fecha_end = $value['end'];
        
    $fechaEntera = strtotime($fecha_start);
    $fecha_anual_format = date("d-m-Y", $fechaEntera);
    $fecha_init = strtotime($fecha_start);
    $fecha_fin = strtotime($fecha_end);

    $init = date("g:ia", $fecha_init);
    $end = date("g:ia", $fecha_fin);
        


        if($value['extendedProps']['status'] == "libre") {

            echo'<tr>

            <th>'.$value['id'].'</th>
            <th>'.$value['title'].'</th>
            <th>( '.$fecha_anual_format.' )  -  ( '.$init." - ".$end.' )</th>
            <th>'.$value['extendedProps']['status'].'</th>
            <td class="text-left">
            <div class="table-action">

            <a href="javascript:" onclick="actualizarAgenda(&apos;'.$id_cod_medico.'&apos; ,&apos;'.$id_cod_consulta.'&apos; , &apos;'.$value['id'].'&apos;)" class="btn btn-sm bg-primary-light">
              Re Asignar</a>

            </div>
            </td>
            </tr>';

        }

      
    
    } 
 