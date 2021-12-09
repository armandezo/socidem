<?php
session_start();
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; 


// header('Content-Type: application/json'); 

    $respuesta = array(
        'Payment' => $_GET['payment_id'],
        'Status' => $_GET['status'],
        'MerchantOrder' => $_GET['merchant_order_id']        
    ); 

    
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments/'.$respuesta['Payment']);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
   
   
   $headers = array();
   $headers[] = 'Authorization: Bearer TEST-1333418562298877-020706-8f12270a97bdd77d30bbc6afe10c909c-314858826';
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   
   $result = curl_exec($ch);

   if (curl_errno($ch)) {
       echo 'Error:' . curl_error($ch);
   }
//    var_dump($result);
   curl_close($ch);
   

$nombre_paciente_p = $_SESSION['nombre_']; 
$apellido_paciente_p = $_SESSION['apellido_']; 
$email_paciente_p = $_SESSION['email_']; 
$telefono_paciente_p = $_SESSION['telefono_']; 
$detalles_paciente_p = $_SESSION['detalles_']; 
$servicios_content_value_p = $_SESSION['servicios_content_value_']; 


$estado = 1;
$cod_id_json_cita = $_SESSION['valor'];
$cod_medico = $_SESSION['secur'];
$tipo_cita  = $_SESSION['tipo'];
$precio_consulta = $_SESSION['precio_final'];

$fecha_start =  date('Y-m-d', strtotime($_SESSION['fecha']) ); 
 
$fecha_hora =  $_SESSION['hora'];
$fecha_hora_rango =  date('G:i', strtotime('+'.$_SESSION['rango'].' minutes ', strtotime($_SESSION['hora']) ) );
 

$paciente_array = array(
    'nombre_paciente' => $nombre_paciente_p,
    'apellido_paciente' => $apellido_paciente_p,       
    'email_paciente' => $email_paciente_p,
    'telefono_paciente' => $telefono_paciente_p,
    'detalles_paciente' => $detalles_paciente_p,
    'servicios_content_value_p' => $servicios_content_value_p
); 

$paciente_obj = (json_encode($paciente_array, true));

$obj_json =(json_decode($result, true));

$cita_array = array(
    'pagoID' => $obj_json['id'],
    'status' => $obj_json['status'],
    'status_detail' => $obj_json['status_detail'],
    'identificacion_number' => $obj_json['card']['cardholder']['identification']['number'],
    'identificacion_type' => $obj_json['card']['cardholder']['identification']['type'],
    'identificacion_nombre' => $obj_json['card']['cardholder']['name'],
    'fecha_created' => $obj_json['card']['date_created'],
    'fecha_aproved' => $obj_json['date_approved'],
    'order_number' => $obj_json['order']['id'],
    'order_type' => $obj_json['order']['type']

); 

$cita_obj = (json_encode($cita_array, true));
$pago_estatus = $obj_json['status'];
 
$get_pago_id = md5($obj_json['id']);

$cod_consulta  =  md5(uniqid(rand(), true));

$nombre_room  =  md5(uniqid(rand(), true));
$pass_room  =  md5(uniqid(rand(), true));
 
 switch ($obj_json['status']) {
     case "approved":
    
    $varInsert = consultasSQL::InsertSQL("agenda", "id, cod_medico, cod_consulta, email_usuario, nombre_room, pass_room, pagoID, precio_consulta, fecha_start, fecha_hora, fecha_hora_end, cita, paciente, tipo_cita, pago_estado, estado", "'', '$cod_medico', '$cod_consulta', '$correo_', '$nombre_room ', '$pass_room ', '$get_pago_id', '$precio_consulta',  '$fecha_start', '$fecha_hora', '$fecha_hora_rango', '$cita_obj', '$paciente_obj', '$tipo_cita', '$pago_estatus', '$estado'"); 
   
    $estado_cita = "APROBADO";
     
    $nombre_paciente =  $nombre_paciente_p." ".$apellido_paciente_p; 
    $correo_paciente = $email_paciente_p;
    $url_cita = "https://medicos.stampiza2.com/lobby-".$cod_consulta;

    $med_name = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `perfil`.*, `perfil`.`correo`, `medicos`.`estado` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$cod_medico'");
    while($datos_medico=mysqli_fetch_assoc($med_name)){ 
        
    $medico_cita = $datos_medico['nombre_completo'];
    }


    $fecha_hora_final = $fecha_start." - ".$fecha_hora;




    $subject = "Estado de su Cita: ".$estado_cita;
        
    include 'plantillaCorreo.controler.php';
    $mail = new PHPMailer(true);
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host       = 'mail.stampiza2.com';                 
        $mail->SMTPAuth   = true;                                 
        $mail->Username = "medicos@stampiza2.com";  
        $mail->Password = "8p;D_eR2~7yz";                           
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
        $mail->Port       = 587;                                    

        //Recipients
        $mail->setFrom('medicos@stampiza2.com', 'Medicos En Directo ');
        $mail->addAddress($email_paciente_p, 'Paciente');      
            
        
        //Content
        $mail->isHTML(true);                                   
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = "Enviado desde Medicos en Directo.";

        $mail->send();
        echo 'El Correo fue enviado con exito';
    } catch (Exception $e) {
        echo "El Correo no fue enviado. Mailer Error: {$mail->ErrorInfo}";
    }

    break;
    case "pending":
        $varInsert = consultasSQL::InsertSQL("agenda", "id, cod_medico, cod_consulta, email_usuario, nombre_room, pass_room, pagoID, precio_consulta, fecha_start, fecha_hora, cita, paciente, tipo_cita, pago_estado, estado", "'', '$cod_medico', '$cod_consulta', '$correo_', '$nombre_room ', '$pass_room ', '$get_pago_id', '$precio_consulta',  '$fecha_start', '$fecha_hora', '$cita_obj', '$paciente_obj', '$tipo_cita', '$pago_estatus', '$estado'"); 
        
        $estado_cita = "PENDIENTE";
        
        $nombre_paciente =  $nombre_paciente_p." ".$apellido_paciente_p; 
        $correo_paciente = $email_paciente_p;
        $url_cita = "https://medicos.stampiza2.com/lobby-".$cod_consulta;

        $med_name = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `perfil`.*, `perfil`.`correo`, `medicos`.`estado` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$cod_medico'");
        while($datos_medico=mysqli_fetch_assoc($med_name)){ 
            
            $medico_cita = $datos_medico['nombre_completo'];
        }
        

        $fecha_hora_final = $fecha_start." - ".$fecha_hora;

        


            $subject = "Estado de su Cita: ".$estado_cita;
                
            include 'plantillaCorreo.controler.php';
            $mail = new PHPMailer(true);
            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                $mail->isSMTP();                                            
                $mail->Host       = 'mail.stampiza2.com';                 
                $mail->SMTPAuth   = true;                                 
                $mail->Username = "medicos@stampiza2.com";  
                $mail->Password = "8p;D_eR2~7yz";                           
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
                $mail->Port       = 587;                                    
        
                //Recipients
                $mail->setFrom('medicos@stampiza2.com', 'Medicos En Directo ');
                $mail->addAddress($email_paciente_p, 'Paciente');      
                      
                
            
                //Content
                $mail->isHTML(true);                                   
                $mail->Subject = $subject;
                $mail->Body    = $body;
                $mail->AltBody = "Enviado desde Medicos en Directo.";
            
                $mail->send();
                echo 'El Correo fue enviado con exito';
            } catch (Exception $e) {
                echo "El Correo no fue enviado. Mailer Error: {$mail->ErrorInfo}";
            }

    break;

    case "404":
        $varInsert = consultasSQL::InsertSQL("agenda", "id, cod_medico, cod_consulta, email_usuario, nombre_room, pass_room, pagoID, precio_consulta, fecha_start, fecha_hora, cita, paciente, tipo_cita, pago_estado, estado", "'', '$cod_medico', '$cod_consulta', '$correo_', '$nombre_room ', '$pass_room ', '$get_pago_id', '$precio_consulta',  '$fecha_start', '$fecha_hora', '$cita_obj', '$paciente_obj', '$tipo_cita', '$pago_estatus', '$estado'"); 
      
    break;

}





header('Location: ../../checkProcess-'.$get_pago_id);
exit;
   