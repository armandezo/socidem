<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php'; 
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=referidos_externos.xls");

$consult = ejecutarSQL::consultar("SELECT `referidos_externos`.*, `referidos_externos`.`status` FROM `referidos_externos` WHERE `referidos_externos`.`status` = '1'");
$count = 0;

$searchByFromdate = $_GET['fecha'];
// 
  
$fecha_lunes =  date('Y-m-d', strtotime($searchByFromdate." monday this week")); 
$fecha_domingo = date('Y-m-d', strtotime($searchByFromdate." sunday this week")); 


 
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
    <caption> <strong > NOMINA DESDE EL LUNES ('.$fecha_lunes.') HASTA EL DOMINGO ('.$fecha_domingo.') </strong> </caption>
        <tr class="categoria">
            <th> ID </th>
            <th> CODIGO  </th>   
            <th> RAZON  </th> 
            <th> DOCUMENTO </th>
            <th> CORREO </th>     
            <th> CCI </th>  
            
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $codigo = $datos_consult['codigo'];
    $razon = $datos_consult['razon'];
    $documento = $datos_consult['documento'];
    $correo = $datos_consult['correo']; 
    $cci = "' ".$datos_consult['cci'];
  
   
  $cons_total_ref = ejecutarSQL::consultar("SELECT `pagos_membresias`.`estado`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`monto_reducido_token`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`fecha`, `pagos_membresias`.`token_medico` FROM `pagos_membresias` WHERE `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$codigo' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo' ");

  $consult_num_membresias = mysqli_num_rows($cons_total_ref);
  
  $total_pago = $consult_num_membresias * 250;
   
    echo ' <tr class="sub_categoria">
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$codigo.'  </td> 
    <td> '.$razon .' </td>
    <td> '.$documento.' </td>
    <td> '.$correo.' </td>
    <td> '.$cci.' </td>
    </tr>
    <tr class="">
        <th COLSPAN=6 style="background:#f0892b; color: white;">
            <strong > RESUMEN DE USO </strong>  
        </th>
       
    </tr> 
     
    <th COLSPAN=2>Nombre Med.</th>
    <th >Codigo Medico</th>  
    <th >Porcentaje</th> 
    <th >Descuento</th>
    <th >Total * Ref</th>
    
    ';
    $cons_ref_detalle = ejecutarSQL::consultar("SELECT `pagos_membresias`.*, `pagos_membresias`.`token_referido`, `pagos_membresias`.`estado`, `pagos_membresias`.`fecha`, `pagos_membresias`.`token_medico`, `perfil`.`correo`, `medicos`.`nombre_completo` FROM `pagos_membresias`, `perfil`, `medicos` WHERE `pagos_membresias`.`token_referido` = '$codigo' AND `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo' AND `pagos_membresias`.`token_medico` = `perfil`.`codigo_referido` AND `perfil`.`correo` = `medicos`.`correo`");
   

    $monto_descuento = 0;

   while( $referidos_detalle =mysqli_fetch_assoc($cons_ref_detalle)){  
       
        $nombre_completo = $referidos_detalle['nombre_completo']; 
        $token_referido = $referidos_detalle['token_medico'];  
        $porcentaje = '20'; 
        $precio_por_ref = 'S/. 250'; 
        $monto_reducido_token = $referidos_detalle['monto_reducido_token']; 
    
            echo ' 
            <tr> 
                <td COLSPAN=2>'.$nombre_completo.'</td>
                <td >'.$token_referido.'</td>  
                <td>'.$porcentaje.'% </td>
                <td>S/. '.$monto_reducido_token.'</td>
                <td >'.$precio_por_ref.' </td>
            </tr>
            ';
       
        $monto_descuento += $monto_reducido_token;
        
         
   }
   
 

    echo '
    <tr  > 
    <td COLSPAN=2 style="background:white!important;"></td>  
    </tr>
    <tr  > 
    <td COLSPAN=2 style="background:#3483c5; color:white; font-weight: 700;"> Resumen de pago:</td>  
    </tr>
    <tr  > 
    <td COLSPAN=2  "><strong class=""> Descuento:</strong>  S/ '.$monto_descuento.'</td>  
    </tr>  
    <tr  > 
    <td COLSPAN=2  "><strong class=""> Subtotal Referido:</strong> S/. '.$total_pago.'</td>  
    </tr>  
    <tr  > 
    <td COLSPAN=2 style="background:white!important;"></td>  
    </tr>  
    ';
}
       

echo '
</table>
';


 