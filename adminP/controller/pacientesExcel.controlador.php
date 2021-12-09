<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1 ");
header("Content-Disposition: attachment; filename=pacientes.xls");

$consult = ejecutarSQL::consultar("SELECT `pacientes`.* FROM `pacientes`;");
$count = 0;
   
echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <caption> <strong > LISTA DE PACIENTES  </strong> </caption>
        <tr>
            <th> ID </th>
            <th> NOMBRE PACIENTE </th> 
            <th> CORREO </th>   
            <th> TELEFONO </th>    
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $nombre_paciente = $datos_consult['nombre']; 
    $telefono_paciente = $datos_consult['telefono'];
    $correo_paciente = $datos_consult['correo']; 
 
    echo ' <tr>
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$nombre_paciente.'  </td> 
    <td> '.$correo_paciente .' </td>
    <td> '.$telefono_paciente.' </td>  
    </tr> 
    ';

}
 
echo '
</table>
';