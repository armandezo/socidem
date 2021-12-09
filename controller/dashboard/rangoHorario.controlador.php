<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
$hora = $_POST['hora']; 
$rango = $_POST['rango'];

$nuevafecha_init = strtotime ($rango.' minutes', strtotime($hora));
$hora_filtrada = date("H:i", $nuevafecha_init); 


echo $hora_filtrada;