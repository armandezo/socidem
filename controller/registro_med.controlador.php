<?php  
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';  
require_once '../vendor/autoload.php';
date_default_timezone_set('America/Lima');
setlocale(LC_ALL,"es_ES"); 
setlocale(LC_TIME, 'spanish'); 
use PHPMailer\PHPMailer\PHPMailer;
use Twilio\Rest\Client;

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
   

    $nombre_doc = $_POST['nombre_doc'];
    $ciudad_doc = $_POST['ciudad_doc'];
    $telefono_doc = $_POST['telefono_doc'];
    $tipo_colegiado_doc = $_POST['coleg_type'];
    $num_colegiado_doc = $_POST['num_colegiado_doc'];
    $correo_doc = $_POST['email_doc'];
    $especialidad_doc = $_POST['especialidad'];
    $pass_doc = md5($_POST['pass_doc']);
    $cod_referido = generate_string($correo_doc.$nombre_doc.$pass_doc, 8);
    $rol_doc = "1";
    $foto_doc = "1.jpg";
    $estado_doc = 0;
    $time = time();
    $fecha = (($time+date('Z'))%86400 < 43200 ? 'AM' : 'PM');
    $last_login_doc_f = strftime('%A %d de %B del %Y %I:%M:%S');
    $last_login_doc = $last_login_doc_f." ".$fecha;
  

if (!$correo_doc == "" && !$pass_doc == "" &&  !$nombre_doc == "" &&  !$ciudad_doc == "" &&  !$num_colegiado_doc == "" && !$tipo_colegiado_doc == "" &&  !$telefono_doc == "" &&  !$foto_doc == ""  && !$especialidad_doc == "" && !$rol_doc == "" && !$last_login_doc == ""  && !$cod_referido == "") {
     
    $BuscaAfil = ejecutarSQL::consultar("SELECT `medicos`.*, `medicos`.`correo`
    FROM `medicos`
    WHERE `medicos`.`correo` = '$correo_doc' ");
   
    $AfilC = mysqli_num_rows($BuscaAfil);
          
        if ($AfilC > 0 ) {
            echo '<script> alert("Este correo ya esta registrado"); 	window.location = "registroDoc"; </script>';
        }
         
        else {
            $code = generate_string(md5(time()), 8);
            $pass_asistance = md5($cod_referido);

            //! SE CAMBIO EL VALOR 0 QUE ES EL DEFAULT POR 1 TANTO PARA SMS CONFIRM Y MAIL CONFIRM LOS ULTIMOS VALORES 1 1
            $regAfil = consultasSQL::InsertSQL("medicos", "nombre_completo, correo, pass, last_login, rol, estado, membresia, periodo_membresia, token_confirm, mail_confirm", "'$nombre_doc', '$correo_doc', '$pass_doc', '$last_login_doc', '$rol_doc', '$estado_doc', 'Gratuito', 0, '$code', 0"); 
            //! HACIENDO QUE PASE LA VALIDACION DE SMS DE TWILIO
            
            $regPerfil = consultasSQL::InsertSQL("perfil", "correo, foto, telefono, tipo_colegiado_doc, num_colegiatura, especialidad, servicios, titulo, universidad, años, ubicacion, sobre_mi, nombre_clinica, direccion_clinica, codigo_referido", "'$correo_doc', '$foto_doc', '$telefono_doc', '$tipo_colegiado_doc', '$num_colegiado_doc', '$especialidad_doc', '', '', '', '', '$ciudad_doc', '', '', '', '$cod_referido'"); 
            $regCodigosPromo = consultasSQL::InsertSQL("codigos_promo", "codigo, tipo, cantidad, porcentaje, status", "'$cod_referido', 'medico', 0, 20, 0"); 
            $regAgenda = consultasSQL::InsertSQL("agenda_medica", "cod_medico, agenda, estado", "'$cod_referido', '[]', '1'"); 
            $regExepciones = consultasSQL::InsertSQL("exepciones", "cod_med, exepciones, estado", "'$cod_referido', '[]', '1'"); 
            $regAsistente = consultasSQL::InsertSQL("secretarias", "cod_med, usuario, pass", "'$cod_referido', '$cod_referido', '$pass_asistance'"); 
            
            
            $valor_codigo = $url_base."controller/mail_med_confirm.controlador.php?code=".$code;
            //! CODIGO SMS
            // $client = new Client($account_sid, $auth_token);
            // $client->messages->create('+51'.$telefono_doc.'',
            // array(
            //     'from' => $twilio_number,
            //     'body' => 'Codigo de Verificacion: '.$code.' '
            // )
            // );
            
            if (isset($_GET['code'])){ 
                echo '<script> 	window.location = "../perfilMed"; </script>';
            }else { 

            // include 'plantillaCorreo.php';
            
            // $mail = new PHPMailer(true);
            
            // try {
                    
            //     $mail->isSMTP();                                            
            //     $mail->Host       = 'mail.insitesoluciones.com';                 
            //     $mail->SMTPAuth   = true;                                 
            //     $mail->Username = "medicos_no_reply@insitesoluciones.com";  
            //     $mail->Password = ")u6ukzT@kioQ";                         
            //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            //     $mail->Port       = 587;                                    

            //     //Recipients
            //     $mail->setFrom('medicos_no_reply@insitesoluciones.com', 'Medicos En Directo ');
            //     $mail->addAddress($correo_doc, 'Externo');      


            //     //Content
            //     $mail->isHTML(true);                                   
            //     $mail->Subject = "Confirmacion de mail ";
            //     $mail->Body    = $body;
            //     $mail->AltBody = "Enviado desde Medicos en Directo.";

            //     $mail->send();
                
            // } catch (Exception $e) {
               
            // }
            $_SESSION['codigo_validacion'] = $code;
            echo '<script> 	Swal.fire("REGISTRO EXITOSO", "", "info");  setTimeout(function() { window.location = "verificarM"; }, 1500); </script>';
           
            }
            
        }
    } else {
    echo '<script> Swal.fire("CAMPOS VACIOS", "", "info"); </script>';
}