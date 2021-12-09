<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 

$tipoCita = $_POST['tipo_cita'];
$codigoRef = $codigo_referido_;
            
$med_cons = ejecutarSQL::consultar("SELECT `perfil`.`correo`, `perfil`.`codigo_referido`, `perfil`.`precio_consulta`, `perfil`.`precio_online`, `medicos`.`estado` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$codigoRef'");


while($datos_servicios=mysqli_fetch_assoc($med_cons)){

    $precio_online=$datos_servicios['precio_online'];
    
    $precio_consulta=$datos_servicios['precio_consulta'];
    
} 


    if($tipoCita == "online"){
        $precio_cita = $precio_online;
    }else {
        $precio_cita = $precio_consulta;
    }

    echo "Precio: S/ ".$precio_cita;