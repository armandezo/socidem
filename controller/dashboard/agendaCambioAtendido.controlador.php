<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
  
 
$codigoAgenda = $_POST['id']; 

consultasSQL::UpdateSQL("agenda", "estado='2' ", "cod_consulta='$codigoAgenda'");

echo "exito";
 

