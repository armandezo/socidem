<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php'; 
require '../vendor/autoload.php';

$valor_tipo = $_POST['tipo_doc']; 
$valor_documento = $_POST['documento'];
$valor_email = $_POST['email'];
$valor_razon = $_POST['razon'];
$valor_cci = $_POST['cci']; 
  
$verReferido = ejecutarSQL::consultar("SELECT `referidos_externos`.*, `referidos_externos`.`documento` FROM `referidos_externos` WHERE `referidos_externos`.`documento` = '$valor_documento';");

$count = mysqli_num_rows($verReferido);
 
if($count == 0){ 

    $valor_codigo = generate_string($valor_documento, 8); 

    $varInsert = consultasSQL::InsertSQL("referidos_externos", 
                                        "tipo,
                                        documento, 
                                        codigo,
                                        correo, 
                                        razon, 
                                        cci, 
                                        status", 
                                        "'$valor_tipo', 
                                        '$valor_documento', 
                                        '$valor_codigo', 
                                        '$valor_email', 
                                        '$valor_razon', 
                                        '$valor_cci ', '1'"); 


    $varInsert = consultasSQL::InsertSQL("codigos_promo", 
    "codigo, 
    tipo,
    cantidad, 
    porcentaje,  
    status,
    usado,
    caducidad    
    ", 
    "'$valor_codigo', 
    'externo', 
    '0', 
    '20',
    '0',
    '0',
    NULL
    "); 

    $subject = "Codigo de Referido: Medicos en Directo";
        
	include 'plantillaCorreo.php';
	$mail = new PHPMailer(true);
	try {
		                    
		$mail->isSMTP();                                            
		$mail->Host       = 'mail.insitesoluciones.com';                 
		$mail->SMTPAuth   = true;                                 
		$mail->Username = "medico@insitesoluciones.com";  
        $mail->Password = "IFUMRjx;go8L";                          
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
		$mail->Port       = 587;                                    
	
		//Recipients
		$mail->setFrom('medico@insitesoluciones.com', 'Medicos En Directo ');
		$mail->addAddress($valor_email, 'Externo');      
		 
	 
		//Content
		$mail->isHTML(true);                                   
		$mail->Subject = $subject;
		$mail->Body    = $body;
		$mail->AltBody = "Enviado desde Medicos en Directo.";
	
		$mail->send();
        echo "Registro Exitoso";
	} catch (Exception $e) {
		echo "El Correo no fue enviado. Error interno";
	}
    
   
}else {
    echo "Disculpe estos datos ya se encuentran registrados";
}



?>