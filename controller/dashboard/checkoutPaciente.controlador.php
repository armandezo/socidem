<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
$nombre_paciente = $_POST['nombre_paciente'];
$apellido_paciente = $_POST['apellido_paciente'];
$email_paciente = $_POST['email_paciente'];
$telefono_paciente = $_POST['telefono_paciente'];
$detalles_paciente = $_POST['detalles_paciente'];
$servicios_content_value = $_POST['servicios_content_value'];


session_reset(); 

$_SESSION['nombre_'] = $nombre_paciente; 
$_SESSION['apellido_'] = $apellido_paciente; 
$_SESSION['email_'] = $email_paciente; 
$_SESSION['telefono_'] = $telefono_paciente; 
$_SESSION['detalles_'] = $detalles_paciente; 
$_SESSION['servicios_content_value_'] = $servicios_content_value; 

?>