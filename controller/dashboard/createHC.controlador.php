<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$fecha_actual = $_POST['fecha_actual'];
$texto_HC = $_POST['texto_HC'];
$cod_correo = $_POST['cod_correo'];


$verHistorialMed = ejecutarSQL::consultar("SELECT `historial_medico`.*, `historial_medico`.`correo` FROM `historial_medico` WHERE `historial_medico`.`correo` = '$cod_correo';");

while($datos_historia_medica=mysqli_fetch_assoc($verHistorialMed)){

    $objHC=$datos_historia_medica['historia_clinica'];
    
    $historia_med = json_decode($objHC, true); 
    

    foreach ($historia_med as $key => $entry) { 
        
    } 
                $nuevo_ID = $entry['id'] + 1;
                
                $nueva_agenda[] = array(
                    'id' =>  $nuevo_ID,
                    'fecha' =>  $fecha_actual,
                    'texto' =>  $texto_HC 
                ); 

        
 
        $resultado =  array_merge($historia_med, $nueva_agenda);
        $insertar_data = json_encode($resultado, JSON_UNESCAPED_UNICODE);
    
        
        consultasSQL::UpdateSQL("historial_medico", "historia_clinica='$insertar_data'", "correo='$cod_correo'");
           
}     
 