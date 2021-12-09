<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$nombre = $_POST['nombre'];
  
$password = md5($_POST['password']);

if ($password == "") {
   
   consultasSQL::UpdateSQL("pacientes", "nombre='$nombre'", "correo='$correo_'");

   session_reset();  
   $_SESSION["nombre"] = $nombre; 

}else {
      
   consultasSQL::UpdateSQL("pacientes", " pass='$password', nombre='$nombre' ", "correo='$correo_'");

   session_reset();  
   $_SESSION["nombre"] = $nombre; 
}


echo ' <script> window.location = "../../perfilPac";   Swal.fire("Actualizado con exito", "", "success") </script>';
           
 
         
         