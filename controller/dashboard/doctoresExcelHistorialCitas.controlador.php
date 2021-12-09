<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=historial_citas.xls");

 

$elemento1 = $_GET['elemento1'];
$elemento2 = $_GET['elemento2'];  
$count= 0;
$consult = ejecutarSQL::consultar("SELECT email_usuario, COUNT(*) AS cantidad_citas, SUM(precio_consulta) as monto_citas, pacientes.correo, pacientes.nombre, pacientes.telefono FROM agenda, pacientes WHERE cod_medico = '$codigo_referido_' AND pago_estado = 'approved' AND fecha_start BETWEEN '$elemento1' AND '$elemento2' AND email_usuario = pacientes.correo GROUP BY email_usuario");
 
   
 
echo '
<style >
.categoria {
    background: #1b5a90; 
    color: white;
}

.sub_categoria {
    background: #3483c5;
    color: white;
    font-weight: 600;
}

</style>
';


echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" style="background: #c7c7c7;">
    <caption> <strong > HISTORIAL DESDE ('.$elemento1.') HASTA ('.$elemento2.') </strong> </caption>
        <tr class="categoria">
            <th> ID </th>
            <th> NOMBRE PACIENTE </th> 
            <th> CORREO </th>   
            <th> TELEFONO </th>   
            <th> NUMERO DE CITAS </th>  
            <th> SUBTOTAL DE CITAS </th>             
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $email_paciente = $datos_consult['email_usuario'];
    $cantidad_citas = $datos_consult['cantidad_citas'];
    $monto_citas = $datos_consult['monto_citas'];
    $telefono_paciente = $datos_consult['telefono'];
    $nombre_paciente= $datos_consult['nombre'];

  

    echo ' <tr class="sub_categoria">
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$nombre_paciente.'  </td> 
    <td> '.$email_paciente .' </td>
    <td> '.$telefono_paciente.' </td>
    <td># '.$cantidad_citas.' </td> 
    <td>S/. '.$monto_citas.' </td> 
    ';
    
}
       

  echo '
  </table>
  ';


 