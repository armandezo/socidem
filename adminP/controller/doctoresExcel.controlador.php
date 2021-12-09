<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php'; 
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1");
header("Content-Disposition: attachment; filename=nomina.xls");
// AND `medicos`.`estado` = '1'
$consult = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `medicos`.`correo`, `medicos`.`periodo_membresia`, `medicos`.`membresia`, `medicos`.`estado`, `perfil`.`telefono`, `perfil`.`codigo_referido`, `medico_bank`.`cci` FROM `medicos`, `perfil`, `medico_bank` WHERE `medicos`.`correo` = `perfil`.`correo` AND `medicos`.`membresia` = 'Profesional'  AND `perfil`.`codigo_referido` = `medico_bank`.`token_medico` ");
$count = 0;


$fecha_mes_ceros = date("m");
$fecha_busqueda = $fecha_mes_ceros."/".date("Y");

$fecha_year = date("Y");

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha_mes = $meses[date('n')-1];

$fecha_lunes =  date('Y-m-d', strtotime('-1 week last monday'));

$fecha_domingo = date('Y-m-d', strtotime('-1 week next sunday'));
 


 
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
            <th> NOMBRE MEDICO </th> 
            <th> CORREO </th>   
            <th> TELEFONO </th>   
            <th> CCI </th>  
            
        </tr>
';
 
while( $datos_consult =mysqli_fetch_assoc($consult)){ 
    $count++;

    $nombre_medico = $datos_consult['nombre_completo'];
    $membresia_medico = $datos_consult['membresia'];
    $periodo_membresia = $datos_consult['periodo_membresia'];
    $telefono_medico = $datos_consult['telefono'];
    $correo_medico = $datos_consult['correo'];
    $cci_medico = "' ".$datos_consult['cci'];

    $cod_ref = $datos_consult['codigo_referido'];
    $monto_total = 0;
    $consult_agenda = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_medico` FROM `agenda` WHERE `agenda`.`cod_medico` = '$cod_ref'");
  
    $consult_agenda_detalle = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_medico` FROM `agenda` WHERE `agenda`.`cod_medico` = '$cod_ref'");

    while( $datos_consult_agenda =mysqli_fetch_assoc($consult_agenda)){  

        $fecha_lunes_pasado = strtotime(date('Y-m-d', strtotime('-1 week last monday')));

        $fecha_domingo_siguiente = strtotime(date('Y-m-d', strtotime('-1 week next sunday')));
        
        $fecha_compare = strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $datos_consult_agenda['fecha_start']))));
        
       
        
        // $fecha_activa = ; 
        // $fecha_start = substr($fecha_activa, 3);

        if($fecha_compare >= $fecha_lunes_pasado && $fecha_compare <= $fecha_domingo_siguiente){
        // if($fecha_start == $fecha_busqueda){
            
            $objAgenda = json_decode($datos_consult_agenda['cita'], true);

            foreach( $objAgenda as $key => $val){ 

                if($key == "status"){

                    if($val == "approved"){  
                       $monto_total += $datos_consult_agenda['precio_consulta']; 
                       
                    }
                     
                } 

               
            } 

        }else {
            $monto_total = 0;
        }

        

    }

    echo ' <tr class="sub_categoria">
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$nombre_medico.'  </td> 
    <td> '.$correo_medico .' </td>
    <td> '.$telefono_medico.' </td>
    <td> '.$cci_medico.' </td>
   
    </tr>
    <tr class="">
        <th COLSPAN=5 style="background:#e84646; color: white;">
            <strong > RESUMEN DE CITAS </strong>  
        </th>
        
    </tr>
   
    
    <th COLSPAN=2 style="background:#c7c7c7;">Nombre Pac.</th>
    <th style="background:#c7c7c7;">Resumen.</th>
    <th style="background:#c7c7c7;">Tipo</th>
    <th style="background:#c7c7c7;">Precio Unit</th>
';

   while( $datos_consult_agenda_detalle =mysqli_fetch_assoc($consult_agenda_detalle)){  


    $fecha_lunes_pasado_detalle = strtotime(date('Y-m-d', strtotime('-1 week last monday')));

    $fecha_domingo_siguiente_detalle = strtotime(date('Y-m-d', strtotime('-1 week next sunday')));
    
    $fecha_compare_detalle = strtotime(date('Y-m-d', strtotime(str_replace('/', '-', $datos_consult_agenda_detalle['fecha_start']))));


    if($fecha_compare_detalle >= $fecha_lunes_pasado_detalle && $fecha_compare_detalle <= $fecha_domingo_siguiente_detalle){
        
        $objAgenda = json_decode($datos_consult_agenda_detalle['cita'], true);
        $objPaciente = json_decode($datos_consult_agenda_detalle['paciente'], true);

        foreach( $objAgenda as $key => $val){ 

            if($key == "status"){

                if($val == "approved"){  
                    foreach( $objPaciente as $key2 => $val2){ 
                        if($key2 == "nombre_paciente"){ $nombre_paciente = $val2; }
                        if($key2 == "apellido_paciente"){ $apellido_paciente = $val2; }
                    }
                    echo '
                    <tr style="background:#c7c7c7;">
                    
                    <td COLSPAN=2>'.$nombre_paciente.' '.$apellido_paciente.'</td>
                    <td>'.$datos_consult_agenda_detalle['fecha_start'].' | '.$datos_consult_agenda_detalle['fecha_hora'].' - '.$datos_consult_agenda_detalle['fecha_hora_end'].'</td>
                    <td>'.$datos_consult_agenda_detalle['tipo_cita'].'</td>
                    <td>S/. '.$datos_consult_agenda_detalle['precio_consulta'].'</td>
                
                    </tr>
                    
                    
                    ';
                   
                   
                }
                 
            } 

           
        } 
       
    }else {
        
    } 

} 
    echo ' 
    <tr class="">
        <th COLSPAN=5 style="background:#f0892b; color: white;">
            <strong > RESUMEN DE REFERIDOS </strong>  
        </th>
       
    </tr> 
     
    <th COLSPAN=2>Nombre Med.</th>
    <th >Codigo</th>
    <th >Porcentaje</th>
    <th >Monto Unit</th>
     
    ';
    $cons_ref_detalle = ejecutarSQL::consultar("SELECT `pagos_membresias`.`estado`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`monto_reducido_token`, `pagos_membresias`.`token_referido`, `codigos_promo`.`porcentaje`, `pagos_membresias`.`fecha`, `pagos_membresias`.`token_medico`, `perfil`.`correo`, `medicos`.`nombre_completo`
    FROM `pagos_membresias`
        , `codigos_promo`
        , `perfil`
        , `medicos`
    WHERE `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$cod_ref' AND `pagos_membresias`.`token_referido` = `codigos_promo`.`codigo` AND `pagos_membresias`.`token_medico` = `perfil`.`codigo_referido` AND `perfil`.`correo` = `medicos`.`correo` AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");
   
   while( $referidos_detalle =mysqli_fetch_assoc($cons_ref_detalle)){  
       
        $nombre_completo = $referidos_detalle['nombre_completo']; 
        $token_referido = $referidos_detalle['token_referido'];  
        $porcentaje = $referidos_detalle['porcentaje']; 
        $monto_reducido_token = $referidos_detalle['monto_reducido_token']; 
   

        $fecha_lunes_pasado = strtotime(date('Y-m-d', strtotime('-1 week last monday')));

        $fecha_domingo_siguiente = strtotime(date('Y-m-d', strtotime('-1 week next sunday')));
        
        $fecha_compare = strtotime($referidos_detalle['fecha']);
        
       
        if($fecha_compare >= $fecha_lunes_pasado && $fecha_compare <= $fecha_domingo_siguiente){
            echo ' 
            <tr> 
                <td COLSPAN=2>'.$nombre_completo.'</td>
                <td>'.$token_referido.'</td>
                <td>'.$porcentaje.'%</td>
                <td>S/. '.$monto_reducido_token.'</td>
            </tr>
            ';
             
        }  
        
        
         
   }
   

    $cons_total_ref = ejecutarSQL::consultar("SELECT
        `pagos_membresias`.`estado`,
        `pagos_membresias`.`token_referido`, 
        `pagos_membresias`.`monto_reducido_token`,
        `pagos_membresias`.`token_referido`,
        `pagos_membresias`.`fecha`,
        `pagos_membresias`.`token_medico`,
        SUM(monto_reducido_token) AS total
    FROM
        `pagos_membresias`
    WHERE
        `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$cod_ref' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");

    while( $referidos_total =mysqli_fetch_assoc($cons_total_ref)){   
        $total_ref = $referidos_total['total'];
        
    }
    
    if($total_ref == NULL)
    {
        $total_ref = 0.00;
    }

    echo '
    <tr  > 
    <td COLSPAN=2 style="background:white!important;"></td>  
    </tr>
    <tr  > 
    <td COLSPAN=2 style="background:#3483c5; color:white; font-weight: 700;"> Resumen de pago:</td>  
    </tr>
    <tr  > 
    <td COLSPAN=2  "><strong class="">Citas:</strong>  S/ '.$monto_total.'</td>  
    </tr>
    <tr  > 
    <td COLSPAN=2  "> <strong class="">Referidos:</strong>  S/ '.$total_ref.' </td>  
    </tr>
    <tr  > 
    <td COLSPAN=2  "><strong class=""> Subtotal:</strong>  S/ '.($monto_total + $total_ref).'</td>  
    </tr>  
    <tr  > 
    <td COLSPAN=2 style="background:white!important;"></td>  
    </tr>  
    ';
}
       

echo '
</table>
';


 