<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1 ");
header("Content-Disposition: attachment; filename=referidos_externos.xls");

$consult = ejecutarSQL::consultar("SELECT `referidos_externos`.*, `referidos_externos`.`status` FROM `referidos_externos` WHERE `referidos_externos`.`status` = '1';");
$count = 0;
   
echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <caption> <strong > LISTA DE CODIGOS EXTERNOS  </strong> </caption>
        <tr>
            <th> ID </th>
            <th> TIPO </th> 
            <th> DOCUMENTO </th> 
            <th> CODIGO </th>   
            <th> CORREO </th> 
            <th> RAZON </th> 
            <th> CCI </th>  
            <th> ESTADO </th>    
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;
    $tipo = $datos_consult['tipo']; 
    $documento = $datos_consult['documento']; 
    $codigo = $datos_consult['codigo']; 
    $correo = $datos_consult['correo']; 
    $razon = $datos_consult['razon']; 
    $cci = "' ".$datos_consult['cci'];  
    $status = $datos_consult['status'];
    
    if($status == 1){
        $estado = "Activo";
    }else {
        $estado = "No Activo";
    }
 
    echo ' <tr>
    <td>'.$count.' </td>
    <td> '.$tipo .' </td>
    <td> '.$documento .' </td>
    <td> '.$codigo .' </td>
    <td> '.$correo .' </td>
    <td style="text-transform: capitalize;"> '.$razon .' </td>
    <td> '.$cci .' </td> 
    <td> '.$estado.' </td>   
    </tr> 
    ';

}
 
echo '
</table>
';