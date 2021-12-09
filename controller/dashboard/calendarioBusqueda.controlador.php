<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
date_default_timezone_set('America/Lima');
header("Content-Type: application/json", true);

  $id_ref_med = $_POST['id_ref'];
   //$id_ref_med = 'e37324a7bd39264d5f997c3ccd5fc1e0';
 

$verAgendaMed = ejecutarSQL::consultar("SELECT `agenda_medica`.`cod_medico`, `agenda_medica`.`agenda`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$id_ref_med' AND `agenda_medica`.`estado` = '1';");

while($datos_agenda_medica =mysqli_fetch_assoc($verAgendaMed)){
    
    $objAgenda = json_decode($datos_agenda_medica['agenda'], true);
 
    $results = array();

    $fecha_hoy = date('d/m/Y');
    
    foreach( $objAgenda as $key=> $val){ 

        $date_inicio = date_create_from_format('d/m/Y', $val['startDate']);

        $fecha_z = date('Y/m/j');
        $nuevafecha_z = strtotime ( '-1 day' , strtotime ( $fecha_z ) );

        $date_fin = date_create_from_format('d/m/Y', date('d/m/Y', $nuevafecha_z)); 

        $hora_inicio = date_create_from_format('g:i A', $val['title']);
        $hora_fin = date_create_from_format('g:i A', date("g:i A")); 
        // // AND $hora_inicio >= $hora_fin

 
        $agenda_array = array( 
            'id' => $val['id'],
            'token' => $val['token'],
            'agenda' => $val['agenda'],
            'name' => $val['name'],
            'startDate' => $val['startDate'],
            'customClass' => $val['customClass'],
            'title' => $val['title'],
            'url' => $val['url'],
            'estado' => $val['estado'],
            'tipo' => $val['tipo'],
            'precio' => $val['precio']
        ); 
        //  if( $date_inicio >= $date_fin ) {
 
            
 
        
        // }else {
        //     $agenda_array = array(
        //         'id' => '',
        //         'token' => '',
        //         'name' => '',
        //         'startDate' => '',
        //         'customClass' => '',
        //         'title' => '',
        //         'url' => '',
        //         'estado' => '',
        //         'tipo' => '',
        //         'precio' => ''
        //     );
        // }
        $results[] = $agenda_array;
        // var_dump($agenda_array);
    }
        
        $indices = ['05:00 AM', '05:30 AM', '06:00 AM', '06:30 AM', '07:00 AM', '07:30 AM', '08:00 AM', '08:30 AM', '09:00 AM', '09:30 AM', '10:00 AM', '10:30 AM', '11:00 AM', '11:30 AM',  '12:00 PM', '12:30 PM',  '01:00 PM', '01:30 PM',  '02:00 PM', '02:30 PM',  '03:00 PM', '03:30 PM',  '04:00 PM', '04:30 PM',  '05:00 PM', '05:30 PM',  '06:00 PM', '06:30 PM',  '07:00 PM', '07:30 PM',  '08:00 PM', '08:30 PM',  '09:00 PM', '09:30 PM',  '10:00 PM', '10:30 PM',  '11:00 PM', '11:30 PM' ]; 
        // 
        $fecha_base = date('d-m-Y');
        $nuevafecha_z = strtotime($fecha_base);
        $nuevafecha_y = strtotime('+1 day', $nuevafecha_z);
        $nuevafecha = date('d/m/Y', $nuevafecha_y);

        $cita_array = array(
        'fecha_adelantada' => $nuevafecha,
        'agenda' => $results,
        'indices' => $indices
        
        ); 

        $cita_obj = (json_encode($cita_array, true));

       echo  $cita_obj;
       

         
}