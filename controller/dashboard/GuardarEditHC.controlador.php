<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$fecha_actual = $_POST['fecha_actual'];
$texto_HC = $_POST['texto_HC'];
$cod_correo = $_POST['cod_correo'];
$id_obj = $_POST['id_obj'];


$verHistorialMed = ejecutarSQL::consultar("SELECT `historial_medico`.*, `historial_medico`.`correo` FROM `historial_medico` WHERE `historial_medico`.`correo` = '$cod_correo';");

while($datos_historia_medica=mysqli_fetch_assoc($verHistorialMed)){

    $objHC=$datos_historia_medica['historia_clinica'];
    
    $historia_med = json_decode($objHC, true); 
    

    foreach ($historia_med as $key => $entry) { 
        

        if ($entry['id'] == $id_obj) {
             
            $historia_med[$key]['texto']= $texto_HC;
            $historia_med[$key]['texto'];
             
            $newJsonString = json_encode($historia_med, JSON_UNESCAPED_UNICODE);

        }

    } 
          
     consultasSQL::UpdateSQL("historial_medico", "historia_clinica='$newJsonString'", "correo='$cod_correo'");

}     
 