<?php 
session_start(); 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
require_once '../vendor/autoload.php';
require_once '../model/credencialesReg.php';
use PHPMailer\PHPMailer\PHPMailer;
use Twilio\Rest\Client;
 
if (isset($_GET['code'])){
    
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    
  
    $name_test =  $google_account_info->name;
    $nombre = $name_test;
    $correo =  $google_account_info->email;
    $tel = "----";
    $pass =  md5($correo);
    

}else {

   

    $nombre = $_POST['nombre-reg'];
    $correo = $_POST['correo-reg'];
    $tel = $_POST['tel-reg'];
    $pass = md5($_POST['pass-reg']);
    
      

} 
$rol= "2";
$estado= 1;
date_default_timezone_set('America/Lima');
setlocale(LC_TIME, 'es_ES.UTF-8');
setlocale(LC_TIME, 'spanish');       
$last_login = date('l jS F Y h:i:s A');

if (!$correo == "" && !$pass == "" &&  !$nombre == ""  && !$tel == "" && !$rol == "" && !$last_login == "") {
     
    $BuscaAfil = ejecutarSQL::consultar("select * from pacientes where correo='$correo' ");
   
    $AfilC = mysqli_num_rows($BuscaAfil);
         
        if ($AfilC > 0 ) {
            echo '<script> alert("Este correo ya esta registrado"); 	window.location = "registro"; </script>';
        } else {
            // $code = generate_string(md5(time()), 8);
            $code = generate_string(md5(time()), 8);
            $ingreso = date('Y-m-d');

            
            $regAfil = consultasSQL::InsertSQL("pacientes", "correo, pass, nombre, telefono, rol, token_confirm, mail_confirm, last_login, inscripcion, estado", "'$correo', '$pass', '$nombre', '$tel', '$rol', '$code', 0, '$last_login', '$ingreso', '$estado' "); 
           
            //! CODIGO PARA ENVIAR SMSS TWILIO
            // if (!isset($_GET['code'])){  
            //     $client = new Client($account_sid, $auth_token);
            //     $client->messages->create('+51'.$tel,
            //     array(
            //         'from' => $twilio_number,
            //         'body' => 'Codigo de Verificacion: '.$code.' '
            //     )
            //     );
              
            // } 
            $correo_md5 = md5($correo);
            $regHistorial = consultasSQL::InsertSQL("historial_medico", "correo, historia_clinica, analisis_lab, img_digitales, recetas_med", "'$correo_md5', '[]', '[]', '[]', '[]' "); 

            if (isset($_GET['code'])){  

                $verAfil = ejecutarSQL::consultar("SELECT `pacientes`.*, `pacientes`.`correo`, `pacientes`.`pass` FROM `pacientes` WHERE `pacientes`.`correo` = '$correo' AND `pacientes`.`pass` = '$pass';");

                while($datos_usuario=mysqli_fetch_assoc($verAfil)){
                    $id_usuario=$datos_usuario['id'];
                    $nombre=$datos_usuario['nombre'];
                    $correo=$datos_usuario['correo'];
                    $rol=$datos_usuario['rol'];
                    $telefono=$datos_usuario['telefono'];
                    $estado=$datos_usuario['estado']; 
                    $last_login=$datos_usuario['last_login'];

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION['id'] = $id_usuario;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['correo'] = $correo;
                    $_SESSION["rol"] = $rol;
                    $_SESSION['telefono'] = $telefono;
                    $_SESSION['estado'] = $estado;
                    $_SESSION['last_login'] = $last_login;
                } 

                if(isset($_SESSION['fecha'])){
                    echo '<script> 	window.location = "../checkout"; </script>';
                }else {
                    echo '<script> 	window.location = "../inicio"; </script>';
                }
                   
            }else {

                
                // $valor_codigo = $url_base."controller/mail_confirm.controlador.php?code=".$code;
                
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
                //     $mail->addAddress($correo, 'Externo');      


                //     //Content
                //     $mail->isHTML(true);                                   
                //     $mail->Subject = "Confirmacion de mail ";
                //     $mail->Body    = $body;
                //     $mail->AltBody = "Enviado desde Medicos en Directo.";

                //     $mail->send();
                    
                // } catch (Exception $e) {
                     

                // } 
                $_SESSION['codigo_validacion'] = $code;
                echo '<script> 	Swal.fire("REGISTRO EXITOSO", "", "info");  setTimeout(function() { window.location = "verificarP"; }, 1500); </script>';
                

            }
            
        }
    } else {
    echo '<script> alert("Campos Vacios"); 	window.location = "registro"; </script>';
}