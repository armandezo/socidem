<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
require_once '../vendor/autoload.php';
require_once '../model/credencialesLog.php';
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
//   require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

// $correo = $_POST['correo-forgot'];
$correo = 'haba.dev.oficial@gmail.com';

 

// $verMed = ejecutarSQL::consultar("SELECT `medicos`.`correo`
// FROM `medicos`
// WHERE `medicos`.`correo` = '$correo'");

// $verPaciente = ejecutarSQL::consultar("SELECT `pacientes`.`correo`
// FROM `pacientes`
// WHERE `pacientes`.`correo` = '$correo'");

// $countMed = mysqli_num_rows($verMed);
// $countPac = mysqli_num_rows($verPaciente);

$valor_codigo = generate_string(md5(time()), 8);

// if ($countMed == 1) { 

    $new_pass = md5($valor_codigo);
    consultasSQL::UpdateSQL("medicos", "correo='$correo', pass='$new_pass' ", "correo='$correo'");
  
    $mail = new PHPMailer(true);

    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = "mail.medicosendirecto.com"; // sets GMAIL as the SMTP server
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->Username = "senders@medicosendirecto.com"; // GMAIL username
    $mail->Password = "CMJvaYaXpfPr"; // GMAIL password
    // $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    // $mail->Port = 465; // set the SMTP port for the GMAIL server
    // $mail->Username = "villafast.oficial@gmail.com"; // GMAIL username
    // $mail->Password = "@081090Callejero"; // GMAIL password

    //Typical mail data
    $mail->AddAddress($correo, 'asdasda');
    $mail->SetFrom("senders@medicosendirecto.com", 'medicos en directo');
    $mail->Subject = "My Subject";
    $mail->Body = "Mail contents";
    
    try{
        $mail->Send();
        echo "Success!";
    } catch(Exception $e){
        //Something went bad
        echo "Fail - " . $mail->ErrorInfo;
    }

    // include 'plantillaCorreoFP.php';

    // $mail = new PHPMailer(true);

    // try {
    //     $mail->isSMTP();
    //     $mail->Host = 'smtp.gmail.com';
    //     $mail->SMTPAuth = true;
    //     $mail->Username = "lycantroponatural@gmail.com";
    //     $mail->Password = "081090Callejero";
    //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    //     $mail->Port = 465;

    //     //Recipients
    //     $mail->setFrom('lycantroponatural@gmail.com', 'Medicos En Directo');
    //     $mail->addAddress($correo, 'Externo');

    //     //Content
    //     $mail->isHTML(true);
    //     $mail->Subject = "Confirmacion de mail ";
    //     $mail->Body = $body;
    //     $mail->AltBody = "Enviado desde Medicos en Directo.";

    //     $mail->send();

    // } catch (Exception $e) {
    //     echo "Ocurrio un error: {$mail->ErrorInfo}";
    // }
    // echo '<script> 	window.location = "../loginMed"; </script>';

// } elseif ($countPac == 1) {

//     $new_pass = md5($valor_codigo);

//     consultasSQL::UpdateSQL("pacientes", "correo='$correo', pass='$new_pass' ", "correo='$correo'");

//     include 'plantillaCorreoFP.php';

//     $mail = new PHPMailer(true);

//     try {
//         $mail->isSMTP();
//         $mail->Host = 'mail.medicosendirecto.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = "senders@medicosendirecto.com";
//         $mail->Password = "CMJvaYaXpfPr";
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port = 587;

//         //Recipients
//         $mail->setFrom('senders@medicosendirecto.com', 'Medicos En Directo ');
//         $mail->addAddress($correo, 'Externo');

//         //Content
//         $mail->isHTML(true);
//         $mail->Subject = "Confirmacion de mail ";
//         $mail->Body = $body;
//         $mail->AltBody = "Enviado desde Medicos en Directo.";

//         $mail->send();

//     } catch (Exception $e) {
//         echo "Ocurrio un error: {$mail->ErrorInfo}";
//     }  
// }else {
//     // echo "<script> alert('Correo Invalido') </script>";
//     // echo "<script> window.location = '../passForgot'; </script>";
// }

// // echo "<script> window.location = '../resetPassMessage'; </script>";

