<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1 ");
header("Content-Disposition: attachment; filename=citas.xls");

$consult = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`pago_estado` FROM `agenda` WHERE `agenda`.`pago_estado` = 'approved' ORDER BY `agenda`.`fecha_start` ASC;");
$count = 0;
   
echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <caption> <strong > LISTA DE CITAS  </strong> </caption>
        <tr>
            <th> ID </th>
            <th> NOMBRE MEDICO </th> 
            <th> NOMBRE PACIENTE </th> 
            <th> FECHA </th> 
            <th> HORA INICIO </th> 
            <th> HORA FINAL </th> 
            <th> MONTO </th> 
            <th> ESTADO </th>      
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $cod_medico = $datos_consult['cod_medico'];  
    $fecha_start = $datos_consult['fecha_start'];
    $precio_consulta = $datos_consult['precio_consulta'];
    $fecha_hora = $datos_consult['fecha_hora'];
    $fecha_hora_end = $datos_consult['fecha_hora_end'];
    $pago_estado = $datos_consult['pago_estado'];
    
    $objPaciente = json_decode($datos_consult['paciente'], true);


    $consult_medico = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `perfil`.`correo`, `medicos`.`nombre_completo` FROM `perfil` , `medicos` WHERE `perfil`.`codigo_referido` = '$cod_medico' AND `perfil`.`correo` = `medicos`.`correo` ");

    while( $datos_consult_medico =mysqli_fetch_assoc($consult_medico)){  

        $nombre_completo = $datos_consult_medico['nombre_completo'];  
    
    }

    foreach( $objPaciente as $key => $val){ 

        if($key == "nombre_paciente"){ $nombre_paciente = $val; } 

        if($key == "apellido_paciente"){ $apellido_paciente = $val; } 

        $nombre_paciente_completo = $nombre_paciente." ".$apellido_paciente;
    } 
 
    echo ' <tr>
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;">'.$nombre_completo.'</td> 
    <td style="text-transform: capitalize;"> '.$nombre_paciente_completo.'   </td> 
    <td> '.$fecha_start .' </td>
    <td> '.$fecha_hora.' </td>  
    <td> '.$fecha_hora_end.' </td> 
    <td>S/. '.$precio_consulta.' </td>   
    <td> '. $pago_estado.' </td>  
    </tr> 
    ';

}
 
echo '
</table>
';