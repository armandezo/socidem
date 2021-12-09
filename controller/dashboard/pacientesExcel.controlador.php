<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php'; 
include '../../model/sessiones.php'; 
include '../../model/data.php'; 
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1 ");
header("Content-Disposition: attachment; filename=pacientes.xls");
  
  $count = 0;
   
echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <caption> <strong > LISTA DE PACIENTES  </strong> </caption>
        <tr>
            <th> ID </th>
            <th> NOMBRE PACIENTE </th> 
            <th> INSCRIPCION </th> 
            <th> CORREO </th>   
            <th> TELEFONO </th>    
            <th> TOTAL CITAS </th> 
        </tr>
';
while($datos_pacientes_med =mysqli_fetch_assoc($listPacientesMed)){

    $cod_medico =$datos_pacientes_med['cod_medico'];  
    $email_usuario = $datos_pacientes_med['email_usuario'];  

    $consult = ejecutarSQL::consultar("SELECT `pacientes`.* FROM `pacientes` WHERE `pacientes`.`correo` = '$email_usuario' ");
  
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $nombre_paciente = $datos_consult['nombre']; 
    $telefono_paciente = $datos_consult['telefono'];
    $correo_paciente = $datos_consult['correo']; 
    $inscripcion = $datos_consult['inscripcion']; 
 
    $consCitas = ejecutarSQL::consultar("SELECT `agenda`.`email_usuario` FROM `agenda` WHERE `agenda`.`email_usuario` = '$correo_paciente'");
                                                        
    $numCitas = mysqli_num_rows($consCitas);

    echo ' <tr>
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$nombre_paciente.'  </td> 
    <td> '.$inscripcion.' </td> 
    <td> '.$correo_paciente .' </td>
    <td> '.$telefono_paciente.' </td>  
    <td> '.$numCitas.' </td> 
    </tr> 
    ';

}}
 
echo '
</table>
';