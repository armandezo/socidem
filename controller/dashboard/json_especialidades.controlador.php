<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
header('Content-type: application/json');

$BuscaElementos = ejecutarSQL::consultar("SELECT * FROM `especialidades`");
 

 while($datos_historia_citas=mysqli_fetch_assoc($BuscaElementos)){
  
     $nombre[] = $datos_historia_citas['nombre'];
     $id[] = $datos_historia_citas['id'];
 
 }
 
 $historial_array = array(
 'nombre' => $nombre,
 'id' => $id
 ); 
 
 $historial_obj = (json_encode($historial_array, true));
 
 echo  $historial_obj;