<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
  
$nombre = $_SESSION['nombre']; 
$medico = $_POST['medico']; 
$comentario = $_POST['textComent'];
$uniqueID = uniqid();


if (!$comentario == NULL){

    $regComent = consultasSQL::InsertSQL("comentarios", "uniqueID, nombre, medico, comentario", "'$uniqueID','$nombre', '$medico', '$comentario'");  
 
}else {
    echo "ño";
}

