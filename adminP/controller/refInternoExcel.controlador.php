<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1 ");
header("Content-Disposition: attachment; filename=referidos_internos.xls");

$consult = ejecutarSQL::consultar("SELECT `codigos_promo`.*, `codigos_promo`.`tipo` FROM `codigos_promo` WHERE `codigos_promo`.`tipo` != 'porcentaje';");
$count = 0;
   
echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <caption> <strong > LISTA DE CODIGOS INTERNOS  </strong> </caption>
        <tr>
            <th> ID </th>
            <th> CODIGO </th> 
            <th> CANTIDAD </th>   
            <th> PORCENTAJE </th> 
            <th> ESTADO </th>    
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $codigo = $datos_consult['codigo']; 
    $cantidad = $datos_consult['cantidad'];
    $porcentaje = $datos_consult['porcentaje']; 
    $status = $datos_consult['status'];
    
    if($status == 1){
        $estado = "Usado";
    }else {
        $estado = "Libre";
    }
 
    echo ' <tr>
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$codigo.'  </td> 
    <td> '.$cantidad .' </td>
    <td> '.$porcentaje.' </td> 
    <td> '.$estado.' </td>   
    </tr> 
    ';

}
 
echo '
</table>
';