<?php
session_start(); 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
date_default_timezone_set('America/Lima');
setlocale(LC_TIME, 'es_ES');
setlocale(LC_TIME, 'spanish'); 
header("Content-Type: application/json", true);

    $id_ref_med = $_POST['id_ref'];
    //
    $type_med = $_POST['type']; 
  //  $id_ref_med = '885de4290058cd230e907b9ecb0da276';
    unset($_SESSION['indices_carga']);
    unset($_SESSION['valor_carga']);
  

$verAgendaMed = ejecutarSQL::consultar("SELECT `agenda_medica`.*, `exepciones`.*, `agenda_medica`.`cod_medico`, `agenda_medica`.`cod_medico` FROM `agenda_medica` , `exepciones` WHERE `agenda_medica`.`cod_medico` = '$id_ref_med' AND `agenda_medica`.`cod_medico` = `exepciones`.`cod_med`  AND `agenda_medica`.`estado` = '1' ");

while($datos_agenda_medica =mysqli_fetch_assoc($verAgendaMed)){ 

        $objAgenda = json_decode($datos_agenda_medica['agenda'], true);
        $objExepciones = json_decode($datos_agenda_medica['exepciones'], true);
       
        
} 

        if(empty($objAgenda) == 1 ){

          $fecha_base = date('d-m-Y');
          $nuevafecha_z = strtotime($fecha_base);
          $nuevafecha_y = strtotime('+1 day', $nuevafecha_z);
          $nuevafecha = date('d/m/Y', $nuevafecha_y); 

          $cita_array = array(
          'fecha_adelantada' => $nuevafecha,
          'agenda' => '[]',
          'indices' => '[]'
          
          ); 
  
          $cita_obj = (json_encode($cita_array, true));
  
          echo  $cita_obj;

        }else {


   
  
        $hoy = date('j-m-y');
        $despues='31-12-21'; 

        $d1 = DateTime::createFromFormat('j-m-y', $hoy);
        $d2 = DateTime::createFromFormat('j-m-y', $despues);

        $interval = $d1->diff($d2);
        $total_dias = $interval->format('%a days')+ 1;

        $fecha_base = date('d-m-Y');
        $nuevafecha_z = strtotime($fecha_base);
        $day = -1; 


        $verAgendaReservada = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_medico`
        FROM `agenda`
        WHERE `agenda`.`cod_medico` = '$id_ref_med' ");

        $num_row_agenda = mysqli_num_rows($verAgendaReservada);

        while($datos_agenda_reserva =mysqli_fetch_assoc($verAgendaReservada)){
           
          $fecha_reserva_format = date('d/m/Y', strtotime($datos_agenda_reserva['fecha_start'])); 

          $info_reserva[] = array(
            'fecha_reserva' => $fecha_reserva_format,
            'hora_reserva' => $datos_agenda_reserva['fecha_hora']

          );
        }

         
        function searchForId($dia, $objAgenda, $fecha) {
          $cont = 0;
          

          foreach ($objAgenda as $key => $val) {
            
            $id_ref_med = $_POST['id_ref'];
              if ($val['dia'] === $dia) { 
                $cont = $cont + 1;

                $agenda_array = array( 
                  'id' => $cont,
                  'token' => $id_ref_med,
                  'agenda' => '',
                  'name' =>  $val['name'],
                  'title' =>  $val['name'],
                  'startHour' =>  $val['startHour'],
                  'endHour' =>  $val['endHour'],
                  'time' =>  $val['time'],
                  'dia' => $val['dia'],
                  'startDate' => $fecha,
                  'customClass' => 'blueClass',  
                  'estado' => $val['estado'],
                  'tipo' => $val['tipo']
                ); 
    
                $_SESSION["indices_carga"][] = $val['name'];
                $_SESSION["valor_carga"][] = $agenda_array;
              }
            
          }
        
        } 

        for ($i=0; $i < $total_dias; $i++) { 
            
            $day++;

            $nuevafecha_y = strtotime( $day.' day', $nuevafecha_z);
            $fecha_filtrada = date( 'd/m/Y', $nuevafecha_y);
            $dia_con_letras = utf8_encode( ucwords( strftime("%A", $nuevafecha_y)));
            $cont = 0;      
            // , $info_reserva
            $lista[] = searchForId($dia_con_letras, $objAgenda, $fecha_filtrada);  
        }   


 
        
    

      
        $cita_obj_3 = $_SESSION["valor_carga"];
        
        $contador = 0; 

        
        
        foreach ($cita_obj_3 as $key => $value) {
          
          $contador = $contador + 1;
          $cita_obj_3[$key]['id']= $contador;   

          if($num_row_agenda >= 1 ){
            $conta_reserva = count($info_reserva);
          
            for ($i=0; $i < $conta_reserva ; $i++) { 
  
              if($cita_obj_3[$key]['startDate'] == $info_reserva[$i]['fecha_reserva'] && $cita_obj_3[$key]['name'] == $info_reserva[$i]['hora_reserva'] ){
  
                $cita_obj_3[$key]['estado']= "agendado";  
        
              }
              
              
            } 
          }
          

        }   

       

        if(empty($objExepciones) == 1 ){

        }else { 
          foreach ($objExepciones as $key2 => $value1) {
            
            $info_exepcion[] = array(
              'fecha_exepcion' => $value1['startDate'],
              'horas_exepcion' => $value1['exepciones'],
              'tipo_agenda' => $value1['tipo']
            );
            
            
          }   
          
          

          foreach ($cita_obj_3 as $key => $value) {
            
            $contador = $contador + 1;
            $cita_obj_3[$key]['id']= $contador;   

            $conta_reserva = count($info_exepcion);
            
           
            
            for ($i=0; $i < $conta_reserva ; $i++) { 

              if($info_exepcion[$i]['tipo_agenda'] == "Mixto"){

                $tipo_agenda_cons = " || Presencial || Online";

              }else {
                $tipo_agenda_cons = " == $info_exepcion[$i]['tipo_agenda']";
              }
            
              if($cita_obj_3[$key]['startDate'] == $info_exepcion[$i]['fecha_exepcion'] && $cita_obj_3[$key]['tipo'] . $tipo_agenda_cons){
                
                $conta_exepcion = count($info_exepcion[$i]['horas_exepcion']); 
                // var_dump($conta_exepcion);
                  for ($f=0; $f < $conta_exepcion; $f++) { 
                   
                        if($cita_obj_3[$key]['startHour'] >= $info_exepcion[$i]['horas_exepcion'][$f]['startHour'] && $cita_obj_3[$key]['startHour'] <= $info_exepcion[$i]['horas_exepcion'][$f]['endHour'] ){ 
                            
                          if($cita_obj_3[$key]['tipo'] == $info_exepcion[$i]['tipo_agenda'] || $info_exepcion[$i]['tipo_agenda'] == "Mixto"){
                            $cita_obj_3[$key]['estado'] = "exepcion";
                          }
 
                           
                        }

                  } 
              
              }
              
              
            } 

          }   
       
        }
        $newJsonString = $cita_obj_3;  
       
        $indices = $_SESSION["indices_carga"];
        $resultado = array_unique($indices);
    
        foreach ($resultado as $key ) {
            $indices_unico[] = $key; 
        } 

        $fecha_base = date('d-m-Y');
        $nuevafecha_z = strtotime($fecha_base);
        $nuevafecha_y = strtotime('+1 day', $nuevafecha_z);
        $nuevafecha = date('d/m/Y', $nuevafecha_y);

        sort($indices_unico, SORT_STRING);  

        $cita_array = array(
        'fecha_adelantada' => $nuevafecha,
        'agenda' => $newJsonString,
        'indices' => $indices_unico
        
        ); 

        $cita_obj = (json_encode($cita_array, true));

        echo  $cita_obj;
 
          
      }