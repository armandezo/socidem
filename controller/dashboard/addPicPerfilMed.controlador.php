<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
$tipo_picture = $_POST['tipo_pic'];
echo ' 
<form action="controller/dashboard/createPic.controlador.php" class="dropzone analisis_lab"  >  
          <input type="hidden" value="'.$tipo_picture.'"  name="tipo_pic" >
</form>
'; 

