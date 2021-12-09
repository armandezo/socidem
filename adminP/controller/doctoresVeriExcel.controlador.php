<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
header("Content-Type: application/vnd.ms-excel; charset=ISO-8859-1 ");
header("Content-Disposition: attachment; filename=med_prof_verificado.xls");

$consult = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `medicos`.`correo`, `medicos`.`estado`, `medicos`.`periodo_membresia`, `medicos`.`membresia`, `perfil`.`telefono`, `perfil`.`codigo_referido`, `medico_bank`.`cci` FROM `medicos`, `perfil`, `medico_bank` WHERE `medicos`.`correo` = `perfil`.`correo` AND `medicos`.`membresia` = 'Profesional' AND `medicos`.`estado` = '1' AND `perfil`.`codigo_referido` = `medico_bank`.`token_medico`");
$count = 0;


$fecha_mes_ceros = date("m");
$fecha_busqueda = $fecha_mes_ceros."/".date("Y");

$fecha_year = date("Y");

$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha_mes = $meses[date('n')-1];




echo '
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1">
    <caption> <strong > LISTA DE MEDICOS CON MEMBRESIA PROFESIONAL VERIFICADA </strong> </caption>
        <tr>
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

    while( $datos_consult_agenda =mysqli_fetch_assoc($consult_agenda)){  

        $fecha_activa = $datos_consult_agenda['fecha_start']; 
        $fecha_start = substr($fecha_activa, 3);
    
        if($fecha_start == $fecha_busqueda){
            
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

    echo ' <tr>
    <td>'.$count.' </td>
    <td style="text-transform: capitalize;"> '.$nombre_medico.'  </td> 
    <td> '.$correo_medico .' </td>
    <td> '.$telefono_medico.' </td>
    <td> '.$cci_medico.' </td>
    
    
    </tr>

    ';
       
     }
       

echo '
</table>
';