<?php
session_start();
 
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
require '../utilidades_calendario/utils.php';
$valor_token = $_GET['token_med'];
 

if (!isset($_GET['start']) || !isset($_GET['end'])) {
    die("Please provide a date range.");
  }
  
  $range_start = parseDateTime($_GET['start']);
  $range_end = parseDateTime($_GET['end']);
   
  $time_zone = null;
  if (isset($_GET['timeZone'])) {
    $time_zone = new DateTimeZone($_GET['timeZone']);
  }
   
  

  $verAgenda = ejecutarSQL::consultar("SELECT `agenda_medica`.*, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$valor_token' AND `agenda_medica`.`estado` = '1';");
     
  while($datos_agenda=mysqli_fetch_assoc($verAgenda)){
                 
      $agenda=$datos_agenda['agenda'];
     
  
  } 

  
  $input_arrays = json_decode($agenda, true);
  
   
  $output_arrays = array();
  foreach ($input_arrays as $array) {
  
   
    $event = new Event($array, $time_zone);
  
   
    if ($event->isWithinDayRange($range_start, $range_end)) {
      $output_arrays[] = $event->toArray();
    }
  }
  
  echo json_encode($output_arrays);



 

// 





// $input_arrays = json_decode($agenda, true);
// echo json_encode($input_arrays);  

?>