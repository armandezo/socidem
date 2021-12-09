<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
date_default_timezone_set('America/Lima');
header("Content-Type: application/json", true);

  $id_ref_med = $_POST['id_ref'];
  $type_med = $_POST['type']; 
  $token = $codigo_referido_;
  


  $cont = 0;
 
  $verAgendaMed = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_medico`, `agenda`.`estado`
  FROM `agenda`
  WHERE `agenda`.`cod_medico` = '$id_ref_med' AND `agenda`.`estado` = '1'");


  
while($datos_agenda_medica =mysqli_fetch_assoc($verAgendaMed)){
  
  $datos_agenda_medica['fecha_start'];
  
  $nuevafecha_sdsd = strtotime($datos_agenda_medica['fecha_start']);
  $nuevafecha_new = date('d/m/Y', $nuevafecha_sdsd);

  $datos_agenda_medica['fecha_hora'];

 

  switch ($datos_agenda_medica['estado']) {
      case 1:
      $estado = "libre";
          break;
      
  } 
  $cont = $cont + 1; 
      $agenda_array = array( 
          'id' => $cont,
          'token' => $token,
          'agenda' => $datos_agenda_medica['cod_consulta'],
          'name' =>  $datos_agenda_medica['fecha_hora'],
          'title' =>  $datos_agenda_medica['fecha_hora'],
          'startDate' => $nuevafecha_new,
          'customClass' => 'blueClass',  
          'estado' => $estado,
          'tipo' => $datos_agenda_medica['tipo_cita'], 
      ); 
  
      $results[] = $agenda_array;
      
      $indices[] = $datos_agenda_medica['fecha_hora']; 
     
}

       
      $fecha_base = date('d-m-Y');
      $nuevafecha_z = strtotime($fecha_base);
      $nuevafecha_y = strtotime('+1 day', $nuevafecha_z);
      $nuevafecha = date('d/m/Y', $nuevafecha_y);

      $resultado = array_unique($indices);
    
      foreach ($resultado as $key ) {
          $indices_unico[] = $key; 
      } 

      sort($indices_unico, SORT_STRING); 


      $cita_array = array( 
      'fecha_adelantada' => $nuevafecha,
      'agenda' => $results,
      'indices' => $indices_unico
      
      ); 

      $cita_obj = (json_encode($cita_array, true));

       echo  $cita_obj;



