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
$consult = ejecutarSQL::consultar("SELECT cod_medico, COUNT(*) AS cantidad_citas, SUM(precio_consulta) AS monto_citas FROM agenda WHERE pago_estado = 'approved' AND fecha_start BETWEEN '$elemento1' AND '$elemento2' GROUP BY cod_medico");
 
   
 
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
            <th> NOMBRE MEDICO </th>    
            <th> NUMERO DE CITAS </th>  
            <th> SUBTOTAL DE CITAS </th>             
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $cod_medico = $datos_consult['cod_medico']; 
    
    $BuscaMedico = ejecutarSQL::consultar("SELECT `medicos`.`correo`, `medicos`.`nombre_completo`, `perfil`.`correo`, `perfil`.`codigo_referido` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$cod_medico'");
    
    while($datos_nombre_med=mysqli_fetch_assoc($BuscaMedico)){ 

        $nombre_medico_const = $datos_nombre_med['nombre_completo'];

    }
    
    $cantidad_citas = $datos_consult['cantidad_citas'];
    $monto_citas = $datos_consult['monto_citas'];
     
    $nombre_medico = $nombre_medico_const;

  

    echo ' <tr class="sub_categoria">
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$nombre_medico.'  </td>  
    <td># '.$cantidad_citas.' </td> 
    <td>S/. '.$monto_citas.' </td> 
    ';
    
}
       

  echo '
  </table>
  ';


 