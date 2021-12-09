<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$cod_agenda = $_POST['cod_cita'];
$fecha = $_POST['fecha'];
$hora_init = $_POST['hora_init'];
$time = $_POST['time'];
$type = $_POST['type']; 

//format fecha
$dateObj = DateTime::createFromFormat('d/m/Y', $fecha); 
$fecha_format = $dateObj->format('Y-m-d'); 

//format hora
$nuevaHora_init = strtotime($hora_init);
$nuevaHora_format = strtotime('+' . $time . ' minutes', $nuevaHora_init);
$hora_end = date('H:i', $nuevaHora_format);

  
 consultasSQL::UpdateSQL("agenda", "fecha_start='$fecha_format', fecha_hora='$hora_init', fecha_hora_end='$hora_end', tipo_cita='$type' ", "cod_consulta='$cod_agenda'");
 