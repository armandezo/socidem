<?php  
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
header("Content-Type: application/json", true);
date_default_timezone_set('America/Lima');

$id_cita = $_POST['id'];
 
// $id_cita = 'f567c3b44035d68d9f69b589cf113966';
   
       
    $verConferencia = ejecutarSQL::consultar("SELECT `agenda`.`cod_consulta`, `agenda`.`cita`, `agenda`.`fecha_hora`, `agenda`.`email_usuario`, `agenda`.`nombre_room`, `agenda`.`pass_room`, `agenda`.`paciente`, `agenda`.`estado` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$id_cita'");

    while($datos_conferencia=mysqli_fetch_assoc( $verConferencia)){
               
        $nombre_room_conferencia=$datos_conferencia['nombre_room']; 
        $pass_room_conferencia=$datos_conferencia['pass_room']; 
        $estado_conferencia=$datos_conferencia['estado']; 
        $fecha_hora=$datos_conferencia['fecha_hora']; 

        $paciente_conferencia=$datos_conferencia['paciente']; 
        $jsonPaciente = json_decode($paciente_conferencia, true); 

        $cita_conferencia=$datos_conferencia['cita']; 
        $jsonCita = json_decode($cita_conferencia, true); 

        $status_cita = $jsonCita['status'];

        $nombre_paciente_conferencia = $jsonPaciente['nombre_paciente'];
        $apellido_paciente_conferencia = $jsonPaciente['apellido_paciente'];
        $email_paciente_conferencia = $jsonPaciente['email_paciente'];
        $telefono_paciente_conferencia = $jsonPaciente['telefono_paciente'];
        $detalles_paciente_conferencia = $jsonPaciente['detalles_paciente'];

        
    }
        $hora_actual = date("h:i A");
        
        $nuevafecha_t = strtotime ( '+30 minutes' , strtotime ( $fecha_hora ) );
        $hora_actual_f = date("h:i A", $nuevafecha_t);

        $fecha1 = new DateTime($hora_actual);//fecha inicial
        $fecha2 = new DateTime($hora_actual_f);//fecha de cierre

        $intervalo = $fecha1->diff($fecha2);
        $timer =  $intervalo->format('%i');

        $segundos = $timer * 60 ;

            
            
        $output = array(
            'room' => $nombre_room_conferencia,
            'nombre' => $nombre_paciente_conferencia." ".$apellido_paciente_conferencia,
            'email' =>  $email_paciente_conferencia, 
            'telefono' =>  $telefono_paciente_conferencia,
            'detalles' =>  $detalles_paciente_conferencia,
            'pass' => $pass_room_conferencia,
            'estado_cita' => $estado_conferencia,
            'estado' => $cita_conferencia,
            'timer' =>  $segundos
        );

        echo json_encode( $output );
     
?> 