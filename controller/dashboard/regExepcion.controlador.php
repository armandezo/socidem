<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
header("Content-Type: application/json", true);

$token = $codigo_referido_;
$fecha_exep = $_POST['fecha_exep']; 

$startHour = $_POST['startHour']; 
$startHour_por_comas = implode(",", $startHour);

$endHour = $_POST['endHour']; 
$endHour_por_comas = implode(",", $endHour);

$servicios = $_POST['check_serv'];  
 
    if(!$startHour=="" && !$endHour=="" && !$servicios==""){
        
        $count_serv = count($servicios);

        if($count_serv >= 2){
            $valor_servicio = "Mixto";
        }else {
            $valor_servicio = $servicios[0];
        } 

        $verAgendaMedica = ejecutarSQL::consultar("SELECT `exepciones`.`exepciones`, `exepciones`.`cod_med`, `exepciones`.`estado` FROM `exepciones` WHERE `exepciones`.`cod_med` = '$token'");

        while($datos_agenda_medica=mysqli_fetch_assoc($verAgendaMedica)){
        
            $objAgenda=$datos_agenda_medica['exepciones'];
            
            $agenda_full = json_decode($objAgenda, true); 
             
            

            foreach ($agenda_full as $key1 => $entry) { 
        
                if ($entry['startDate'] == $fecha_exep) { 

                    unset($agenda_full[$key1]);  
                    
                }  
               
                
            } 
 
            $count = count($startHour);

            for ($i=0; $i < $count ; $i++) { 

                $arreglo_startHour[] = array(
                    'startHour' => $startHour[$i],
                    'endHour' => $endHour[$i]
                );
            }

            $arreglo_horas[] = array(
                'token' =>  $token, 
                'startDate' =>  $fecha_exep,
                'tipo' =>  $valor_servicio,
                'exepciones' => $arreglo_startHour
            );   

         

              $resultado =  array_merge($agenda_full, $arreglo_horas); 
              $insertar_data = json_encode($resultado, JSON_UNESCAPED_UNICODE);
             
             
               consultasSQL::UpdateSQL("exepciones", "exepciones='$insertar_data'", "cod_med='$token'");
               $estado_ope= "exito";
        }            

    }else {
        $estado_ope= "vacio";
    }


 
    $exepciones_array = array(  
        'estado' =>  $estado_ope  
    ); 
  
        $cita_obj = (json_encode($exepciones_array, true));
  
         echo  $cita_obj;