<?php
session_start();
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';



$id_cita = $_POST['valor'];
$codigo_referido = $_POST['secur'];
$tipo = $_POST['tipo'];

$dateObj = DateTime::createFromFormat('d/m/Y', $_POST['fecha']); 
$fecha = $dateObj->format('Y-m-d'); 

$hora = $_POST['hora'];
$rango = $_POST['rango'];


$verPr = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `perfil`.`precio_consulta`, `perfil`.`precio_online` FROM `perfil` WHERE `perfil`.`codigo_referido` = '$codigo_referido' ");

while($d=mysqli_fetch_assoc($verPr)){ 
    $precio_consulta=$d['precio_consulta'];
    $precio_online=$d['precio_online'];
} 
session_reset();  

$_SESSION['valor'] = $id_cita;
$_SESSION['secur'] = $codigo_referido;
$_SESSION['tipo'] = $tipo;
$_SESSION['fecha'] = $fecha;
$_SESSION['hora'] = $hora;
$_SESSION['rango'] = $rango;

if ($tipo == 'online'){
    $_SESSION['precio_final'] = $precio_online;
}else {
    $_SESSION['precio_final'] = $precio_consulta;
}




 